<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $classes = SchoolClass::with('teacher')
            ->when($search, function ($query, $search) {
                $query->where('class_name', 'like', "%{$search}%")
                      ->orWhere('academic_year', 'like', "%{$search}%")
                      ->orWhereHas('teacher', function ($q) use ($search) {
                          $q->where('full_name', 'like', "%{$search}%");
                      });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

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
        $class = SchoolClass::findOrFail($id);
        $teachers = Teacher::all();

        return view('class.edit', compact('class', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name'          => 'required|string|max:255',
            'academic_year'       => 'required|string|max:20',
            'homeroom_teacher_id' => 'nullable|exists:tbl_teachers,teacher_id',
        ]);

        $class = SchoolClass::findOrFail($id);

        $class->update([
            'class_name'          => $request->class_name,
            'academic_year'       => $request->academic_year,
            'homeroom_teacher_id' => $request->homeroom_teacher_id,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }

        $class = SchoolClass::findOrFail($id);
        $class->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Class archived successfully!');
    }
}
