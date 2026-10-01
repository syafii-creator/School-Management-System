@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-3">My Profile</h4>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-3" style="width: 60px; height: 60px;">
                    {{ strtoupper(substr($student->full_name, 0, 1)) }}
                </div>
                <div>
                    <h5 class="fw-bold mb-0">{{ $student->full_name }}</h5>
                    <span class="text-muted">Student ID (NIS): {{ $student->nis }}</span>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="text-muted small">Account Email</label>
                    <div class="fw-semibold">{{ $student->user->email ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small">Current Class</label>
                    <div class="fw-semibold">{{ $student->schoolClass->class_name ?? '-' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small">Date of Birth</label>
                    <div class="fw-semibold">{{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d F Y') : '-' }}</div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small">Academic Year</label>
                    <div class="fw-semibold">{{ $student->schoolClass->academic_year ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
