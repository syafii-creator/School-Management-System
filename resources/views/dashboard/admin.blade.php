@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">System Overview</h4>
        <p class="text-muted small mb-0">Monitor primary academic metrics in real-time.</p>
    </div>
</div>

<!-- 5 Modul Kartu Statistik -->
<div class="row g-3 mb-4">
    <!-- Users -->
    <div class="col-md-4 col-lg">
        <div class="card card-stat bg-white p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold small d-block mb-1">USERS</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $totalUsers }}</h3>
                </div>
                <div class="icon-box bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Students -->
    <div class="col-md-4 col-lg">
        <div class="card card-stat bg-white p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold small d-block mb-1">STUDENTS</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $totalStudents }}</h3>
                </div>
                <div class="icon-box bg-info bg-opacity-10 text-info">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Teachers -->
    <div class="col-md-4 col-lg">
        <div class="card card-stat bg-white p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold small d-block mb-1">TEACHERS</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $totalTeachers }}</h3>
                </div>
                <div class="icon-box bg-success bg-opacity-10 text-success">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Classes -->
    <div class="col-md-4 col-lg">
        <div class="card card-stat bg-white p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold small d-block mb-1">CLASSES</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $totalClasses }}</h3>
                </div>
                <div class="icon-box bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-door-open-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Subjects -->
    <div class="col-md-4 col-lg">
        <div class="card card-stat bg-white p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold small d-block mb-1">SUBJECTS</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $totalSubjects }}</h3>
                </div>
                <div class="icon-box bg-danger bg-opacity-10 text-danger">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Data Siswa Terbaru -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom-0">
        <h6 class="fw-bold text-dark mb-0">Recent Students</h6>
        <a href="{{ route('students.index') }}" class="btn btn-sm btn-light text-primary fw-semibold rounded-pill px-3">View All</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4">ID / NIS</th>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentStudents as $student)
                <tr>
                    <td class="ps-4 text-secondary fw-medium">{{ $student->nis }}</td>
                    <td class="fw-bold text-dark">{{ $student->full_name }}</td>
                    <td><span class="badge bg-light text-dark border px-2 py-1">{{ $student->class->class_name ?? 'Unassigned' }}</span></td>
                    <td>
                        <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill">Active</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">No student records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
