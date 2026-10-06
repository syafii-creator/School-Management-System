<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $teachers = Teacher::with('subject')
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhereHas('subject', function ($subQuery) use ($search) {
                      $subQuery->where('subject_name', 'like', "%{$search}%");
                  });
            });
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('teachers.index', compact('teachers'));
}

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $subjects = Subject::all();
        return view('teachers.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        // 1. Validasi Input
        $request->validate([
            'nip'          => 'required|unique:tbl_teachers,nip',
            'full_name'    => 'required|string|max:255',
            'email'        => 'required|email|unique:tbl_users,email',
            'subject_id'   => 'required',
            'phone_number' => 'nullable|string',
        ]);

        // 2. Otomatis buatkan Akun User
        $user = User::create([
            'username' => strtolower(Str::slug($request->full_name, '_')),
            'email'    => $request->email,
            'password' => Hash::make('password123'), // Password Default
            'role'     => 'teacher',
        ]);

        // 3. Simpan Data Guru (Input phone_number disimpan ke kolom phone)
        Teacher::create([
            'nip'        => $request->nip,
            'full_name'  => $request->full_name,
            'subject_id' => $request->subject_id,
            'phone'      => $request->phone_number, // <-- PERBAIKAN DI SINI
            'user_id'    => $user->user_id ?? $user->id,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Guru dan Akun Login berhasil dibuat!');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $teacher = Teacher::findOrFail($id);
        $subjects = Subject::all();
        return view('teachers.edit', compact('teacher', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'nip'          => 'required|unique:tbl_teachers,nip,' . $id . ',teacher_id',
            'full_name'    => 'required|string|max:255',
            'subject_id'   => 'required',
            'phone_number' => 'nullable|string',
        ]);

        $teacher->update([
            'nip'        => $request->nip,
            'full_name'  => $request->full_name,
            'subject_id' => $request->subject_id,
            'phone'      => $request->phone_number, // <-- PERBAIKAN DI SINI
        ]);

        return redirect()->route('teachers.index')->with('success', 'Data Guru berhasil diperbarui!');
    }

   public function destroy($id)
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Akses ditolak.');
    }

    $teacher = Teacher::findOrFail($id);
    $userId = $teacher->user_id;

    // 1. Archive data guru terlebih dahulu
    $teacher->delete();

    // 2. Archive akun user yang terhubung (jika ada)
    if ($userId) {
        User::destroy($userId);
    }

    return redirect()->route('teachers.index')
        ->with('success', 'Teacher and associated login account archived successfully!');
}
}
