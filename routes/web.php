<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolSettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentPortalController;

// 1. Route untuk Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// 2. Route Setelah Login (Autentikasi)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Data Sekolah
    Route::get('/school', [SchoolSettingController::class, 'index'])->name('school.index');
    Route::put('/school/{id}', [SchoolSettingController::class, 'update'])->name('school.update');

    // --- AKSES KHUSUS STUDENT (Profil & Kelas Saya) ---
    Route::get('/my-profile', [StudentPortalController::class, 'profile'])->name('student.profile');
    Route::get('/my-class', [StudentPortalController::class, 'myClass'])->name('student.my-class');

    // --- AKSES LIHAT DATA (Admin & Teacher) ---
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');

    // --- KHUSUS ADMIN (Akses Penuh CRUD) ---
    Route::middleware('role:admin')->group(function () {
        // CRUD Students
        Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/students', [StudentController::class, 'store'])->name('students.store');
        Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

        // CRUD Teachers
        Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

        // CRUD Classes
        Route::get('/classes/create', [ClassController::class, 'create'])->name('classes.create');
        Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
        Route::get('/classes/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
        Route::put('/classes/{id}', [ClassController::class, 'update'])->name('classes.update');
        Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');

        // CRUD Subjects
        Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
        Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
        Route::get('/subjects/{id}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
        Route::put('/subjects/{id}', [SubjectController::class, 'update'])->name('subjects.update');
        Route::delete('/subjects/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
    });
});
