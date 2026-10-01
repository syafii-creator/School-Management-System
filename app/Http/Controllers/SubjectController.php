<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        return view('subjects.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'subject_code' => 'required|string|max:50|unique:tbl_subjects,subject_code',
            'subject_name' => 'required|string|max:255',
            'credits'      => 'required|integer|min:1',
        ]);

        Subject::create([
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
            'slug'         => Str::slug($request->subject_name),
            'credits'      => $request->credits,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject added successfully!');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $subject = Subject::where('subject_id', $id)
            ->orWhere('slug', $id)
            ->firstOrFail();

        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $subject = Subject::where('subject_id', $id)
            ->orWhere('slug', $id)
            ->firstOrFail();

        $request->validate([
            'subject_code' => 'required|string|max:50|unique:tbl_subjects,subject_code,' . $subject->subject_id . ',subject_id',
            'subject_name' => 'required|string|max:255',
            'credits'      => 'required|integer|min:1',
        ]);

        $subject->update([
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
            'slug'         => Str::slug($request->subject_name),
            'credits'      => $request->credits,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        // Cari data berdasarkan subject_id atau slug
        $subject = Subject::where('subject_id', $id)
            ->orWhere('slug', $id)
            ->first();

        if ($subject) {
            // Karena Model menggunakan SoftDeletes, perintah delete() ini
            // TIDAK menghapus data dari DB, melainkan mengarsipkan (mengisi deleted_at)
            $subject->delete();

            return redirect()->route('subjects.index')->with('success', 'Subject archived successfully!');
        }

        return redirect()->route('subjects.index')->with('error', 'Subject not found!');
    }
}
