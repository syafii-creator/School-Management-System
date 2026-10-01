<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentPortalController extends Controller
{
    // Menampilkan Profil Pribadi Siswa
    public function profile()
    {
        // Mengambil data siswa berdasarkan akun user yang sedang login
        $student = Student::with(['schoolClass', 'user'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('student.profile', compact('student'));
    }

    // Menampilkan Data Kelas & Teman Sekelas
    public function myClass()
    {
        $student = Student::with(['schoolClass.homeroomTeacher', 'schoolClass.teacher'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Mengambil daftar teman sekelas (jika siswa sudah punya kelas)
        $classmates = $student->class_id
            ? Student::where('class_id', $student->class_id)->get()
            : collect();

        return view('student.my_class', compact('student', 'classmates'));
    }
}
