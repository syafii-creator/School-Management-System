@extends('layouts.app')

@section('content')
<!-- Welcome Banner -->
<div class="card border-0 shadow-sm rounded-4 bg-primary text-white mb-4">
    <div class="card-body p-4 d-flex align-items-center justify-content-between">
        <div>
            <h4 class="fw-bold mb-1">Welcome Back, {{ $student->full_name ?? auth()->user()->username }}!</h4>
            <p class="mb-0 text-white-50">Here is your academic overview and profile summary.</p>
        </div>
        <div class="d-none d-md-block fs-1 opacity-50">
            <i class="bi bi-person-workspace"></i>
        </div>
    </div>
</div>

<!-- Student Stats Summary -->
<div class="row g-3 mb-4">
    <!-- My Class -->
    <div class="col-md-4">
        <div class="card card-stat bg-white p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold small d-block mb-1">MY CLASS</span>
                    <h4 class="fw-bold text-dark mb-0">{{ $student->class->class_name ?? 'Not Assigned' }}</h4>
                </div>
                <div class="icon-box bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-door-open-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Homeroom Teacher -->
    <div class="col-md-4">
        <div class="card card-stat bg-white p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold small d-block mb-1">HOMEROOM TEACHER</span>
                    <h5 class="fw-bold text-dark mb-0">{{ $student->class->teacher->full_name ?? 'N/A' }}</h5>
                </div>
                <div class="icon-box bg-success bg-opacity-10 text-success">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Subjects -->
    <div class="col-md-4">
        <div class="card card-stat bg-white p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted fw-semibold small d-block mb-1">TOTAL SUBJECTS</span>
                    <h3 class="fw-bold text-dark mb-0">{{ $subjects->count() }}</h3>
                </div>
                <div class="icon-box bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Table: Available Subjects -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            <div class="card-header bg-white py-3 px-4 border-bottom-0">
                <h6 class="fw-bold text-dark mb-0">Enrolled Subjects</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase">
                        <tr>
                            <th class="ps-4">Code</th>
                            <th>Subject Name</th>
                            <th>Credits / Hours</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subjects as $subject)
                        <tr>
                            <td class="ps-4 text-secondary fw-medium">{{ $subject->subject_code }}</td>
                            <td class="fw-bold text-dark">{{ $subject->subject_name }}</td>
                            <td><span class="badge bg-light text-dark border px-2 py-1">{{ $subject->credits }} Hours</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-muted">No subjects registered yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Profile Details Card -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
            <h6 class="fw-bold text-dark mb-3">Student Profile Information</h6>
            <ul class="list-group list-group-flush small">
                <li class="list-group-item d-flex justify-content-between px-0 py-2 border-0">
                    <span class="text-muted">Student ID (NIS)</span>
                    <span class="fw-bold text-dark">{{ $student->nis ?? '-' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between px-0 py-2 border-0">
                    <span class="text-muted">Full Name</span>
                    <span class="fw-bold text-dark">{{ $student->full_name ?? '-' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between px-0 py-2 border-0">
                    <span class="text-muted">Email</span>
                    <span class="fw-bold text-dark">{{ auth()->user()->email }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between px-0 py-2 border-0">
                    <span class="text-muted">Date of Birth</span>
                    <span class="fw-bold text-dark">{{ $student->date_of_birth ?? '-' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between px-0 py-2 border-0">
                    <span class="text-muted">Status</span>
                    <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill">Active Student</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
