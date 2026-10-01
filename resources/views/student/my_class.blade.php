@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-3">Class {{ $student->schoolClass->class_name ?? '' }}</h4>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold text-primary mb-2"><i class="bi bi-info-circle me-1"></i> Class Information</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Homeroom Teacher</small>
                    <span class="fw-semibold">
                        {{ $student->schoolClass->homeroomTeacher->full_name ?? $student->schoolClass->teacher->full_name ?? 'Not Assigned' }}
                    </span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Academic Year</small>
                    <span class="fw-semibold">{{ $student->schoolClass->academic_year ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-people me-1"></i> Classmates List</h6>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>NO</th>
                            <th>STUDENT ID (NIS)</th>
                            <th>STUDENT NAME</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($classmates as $index => $mate)
                        <tr class="{{ $mate->id === $student->id ? 'table-primary' : '' }}">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mate->nis }}</td>
                            <td>
                                {{ $mate->full_name }}
                                @if($mate->id === $student->id)
                                    <span class="badge bg-primary ms-1">Me</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No classmates found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
