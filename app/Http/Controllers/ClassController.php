<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::with('teacher')->get();
        return view('class.index', compact('classes'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $teachers = Teacher::all();
        return view('class.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'class_name'          => 'required|string|max:255',
            'homeroom_teacher_id' => 'nullable|exists:tbl_teachers,teacher_id',
            'academic_year'       => 'required|string|max:20',
        ]);

        SchoolClass::create([
            'class_name'          => $request->class_name,
            'homeroom_teacher_id' => $request->homeroom_teacher_id,
            'academic_year'       => $request->academic_year,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class added successfully!');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $class = SchoolClass::findOrFail($id);
        $teachers = Teacher::all();

        return view('class.edit', compact('class', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $class = SchoolClass::findOrFail($id);

        $request->validate([
            'class_name'          => 'required|string|max:255',
            'homeroom_teacher_id' => 'nullable|exists:tbl_teachers,teacher_id',
            'academic_year'       => 'required|string|max:20',
        ]);

        $class->update([
            'class_name'          => $request->class_name,
            'homeroom_teacher_id' => $request->homeroom_teacher_id,
            'academic_year'       => $request->academic_year,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $class = SchoolClass::findOrFail($id);
        $class->delete(); // Mengisi kolom 'archived' secara otomatis via SoftDeletes

        return redirect()->route('classes.index')
            ->with('success', 'Class archived successfully!');
    }
}
