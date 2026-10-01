<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('schoolClass')->get();
        return view('student.index', compact('students'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $classes = SchoolClass::all();
        return view('student.create', compact('classes')); // Perbaikan: students.create -> student.create
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        // 1. Validasi Input
        $request->validate([
            'nis'           => 'required|unique:tbl_students,nis',
            'full_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:tbl_users,email',
            'class_id'      => 'required',
            'date_of_birth' => 'required|date',
        ]);

        // 2. Otomatis buatkan Akun User
        $user = User::create([
            'username' => strtolower(Str::slug($request->full_name, '_')),
            'email'    => $request->email,
            'password' => Hash::make('password123'), // Password Default
            'role'     => 'student',
        ]);

        // 3. Simpan Data Siswa
        Student::create([
            'nis'           => $request->nis,
            'full_name'     => $request->full_name,
            'class_id'      => $request->class_id,
            'date_of_birth' => $request->date_of_birth,
            'user_id'       => $user->user_id ?? $user->id,
        ]);

        return redirect()->route('students.index')->with('success', 'Siswa dan Akun Login berhasil dibuat!');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $student = Student::findOrFail($id);
        $classes = SchoolClass::all();
        return view('student.edit', compact('student', 'classes')); // Perbaikan: students.edit -> student.edit
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $student = Student::findOrFail($id);

        $request->validate([
            'nis'           => 'required|unique:tbl_students,nis,' . $id . ',student_id',
            'full_name'     => 'required|string|max:255',
            'class_id'      => 'required',
            'date_of_birth' => 'required|date',
        ]);

        $student->update([
            'nis'           => $request->nis,
            'full_name'     => $request->full_name,
            'class_id'      => $request->class_id,
            'date_of_birth' => $request->date_of_birth,
        ]);

        return redirect()->route('students.index')->with('success', 'Data Siswa berhasil diperbarui!');
    }

   public function destroy($id)
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Akses ditolak.');
    }

    $student = Student::findOrFail($id);
    $userId = $student->user_id;

    // 1. Archive data siswa dulu
    $student->delete();

    // 2. Archive data akun user jika ada
    if ($userId) {
        User::destroy($userId);
    }

    return redirect()->route('students.index')
        ->with('success', 'Student and associated login account archived successfully!');
}
}
