<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\SchoolClass;
use App\Models\Subject;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // 1. Tampilan Dashboard Khusus Student
        if ($user->role === 'student') {
            $student = Student::with(['class.teacher'])->where('user_id', $user->user_id)->first();
            $subjects = Subject::all();

            return view('dashboard.student', compact('student', 'subjects'));
        }

        // 2. Tampilan Dashboard Khusus Teacher
        if ($user->role === 'teacher') {
            $teacher = Teacher::with('subject')->where('user_id', $user->user_id)->first();
            $myClasses = SchoolClass::where('homeroom_teacher_id', $teacher->teacher_id ?? null)->get();
            $totalStudents = Student::count();

            return view('dashboard.teacher', compact('teacher', 'myClasses', 'totalStudents'));
        }

        // 3. Tampilan Dashboard Admin (Default)
        $totalUsers     = User::count();
        $totalStudents  = Student::count();
        $totalTeachers  = Teacher::count();
        $totalClasses   = SchoolClass::count();
        $totalSubjects  = Subject::count();
        $recentStudents = Student::with('class')->latest()->take(5)->get();

        return view('dashboard.admin', compact(
            'totalUsers',
            'totalStudents',
            'totalTeachers',
            'totalClasses',
            'totalSubjects',
            'recentStudents'
        ));
    }
}
