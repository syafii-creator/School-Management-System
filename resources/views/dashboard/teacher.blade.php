@extends('layouts.app')

@section('content')
<!-- Welcome Banner -->
<div class="card border-0 shadow-sm rounded-4 bg-success text-white mb-4">
    <div class="card-body p-4 d-flex align-items-center justify-content-between">
        <div>
            <h4 class="fw-bold mb-1">Welcome Back, {{ $teacher->full_name ?? auth()->user()->username }}!</h4>
            <p class="mb-0 text-white-50">Here is your teaching panel and class management overview.</p>
        </div>
        <div class="d-none d-md-block fs-1 opacity-50">
            <i class="bi bi-person-badge-fill"></i>
        </div>
    </div>
</div>

<!-- Teacher Summary Widgets -->
<div class="row g-3 mb-4">
    <!-- Subject Taught -->
    <div class="col-md-4">
        <div class="card card-stat bg-white p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold small d-block mb-1">SUBJECT TAUGHT</span>
                    <h5 class="fw-bold text-dark mb-0">{{ $teacher->subject->subject_name ?? 'N/A' }}</h5>
                </div>
                <div class="icon-box bg-success bg-opacity-10 text-success">
                    <i class="bi bi-journal-check"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Managed Classes -->
    <div class="col-md-4">
        <div class="card card-stat bg-white p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold small d-block mb-1">HOMEROOM CLASSES</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $myClasses->count() }}</h3>
                </div>
                <div class="icon-box bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-door-open-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Students in School -->
    <div class="col-md-4">
        <div class="card card-stat bg-white p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold small d-block mb-1">TOTAL STUDENTS</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $totalStudents }}</h3>
                </div>
                <div class="icon-box bg-info bg-opacity-10 text-info">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Managed Classes Table -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
    <div class="card-header bg-white py-3 px-4 border-bottom-0">
        <h6 class="fw-bold text-dark mb-0">Assigned Homeroom Classes</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4">Class Name</th>
                    <th>Academic Year</th>
                    <th>Students Count</th>
                </tr>
            </thead>
            <tbody>
                @forelse($myClasses as $class)
                <tr>
                    <td class="ps-4 fw-bold text-dark">{{ $class->class_name }}</td>
                    <td><span class="badge bg-light text-dark border px-2 py-1">{{ $class->academic_year }}</span></td>
                    <td>{{ $class->students_count ?? $class->students()->count() }} Students</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">You are not currently assigned as homeroom teacher to any class.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
