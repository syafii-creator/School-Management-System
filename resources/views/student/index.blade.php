@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Student Data</li>
@endsection

@section('content')
<!-- Alert Success Notification -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Alert Error Notification -->
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Header & Toolbar Search -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">Student Data</h4>
        <p class="text-muted small mb-0">Manage student profiles and class assignments.</p>
    </div>

    <div class="d-flex flex-wrap align-items-center gap-2">
        <!-- Form Search -->
        <form action="{{ route('students.index') }}" method="GET" class="d-flex gap-2">
            <div class="input-group">
                <input type="text"
                       name="search"
                       class="form-control bg-white border-0 shadow-sm ps-3"
                       placeholder="Search student, NISN, class..."
                       value="{{ request('search') }}"
                       style="min-width: 220px;">
                <button type="submit" class="btn btn-primary fw-bold shadow-sm px-3">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
            @if(request('search'))
                <a href="{{ route('students.index') }}" class="btn btn-light border shadow-sm" title="Reset Search">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </form>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('students.create') }}" class="btn btn-primary fw-bold px-3 py-2 rounded-3 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Student
            </a>
        @endif
    </div>
</div>

<!-- Student Table Card -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4" style="width: 60px;">NO</th>
                    <th>NISN</th>
                    <th>FULL NAME</th>
                    <th>CLASS</th>
                    <th class="text-center">DATE OF BIRTH</th>
                    <th class="text-center">CREATED DATE</th>
                    @if(auth()->user()->role === 'admin')
                        <th class="text-end pe-4">ACTION</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($students as $index => $student)
                <tr>
                    <td class="ps-4 text-secondary fw-medium">{{ $students->firstItem() + $index }}</td>

                    <!-- NISN / NIS -->
                    <td class="text-secondary fw-medium">
                        {{ $student->nisn ?? $student->nis ?? '-' }}
                    </td>

                    <!-- Full Name -->
                    <td class="fw-bold text-dark">
                        {{ $student->full_name ?? $student->name }}
                    </td>

                    <!-- Class -->
                    <td>
                        <span class="badge bg-light text-dark border px-2 py-1">
                            {{ $student->schoolClass->class_name ?? $student->class->class_name ?? 'Unassigned' }}
                        </span>
                    </td>

                    <!-- Date of Birth -->
                    <td class="text-center text-secondary small fw-medium">
                        @if(!empty($student->date_of_birth))
                            {{ \Carbon\Carbon::parse($student->date_of_birth)->locale('id')->translatedFormat('j M Y') }}
                        @else
                            -
                        @endif
                    </td>

                    <!-- Created Date -->
                    <td class="text-center text-muted small">
                        {{ \Carbon\Carbon::parse($student->created_at)->locale('id')->translatedFormat('j M Y') }}
                    </td>

                    @if(auth()->user()->role === 'admin')
                        <td class="text-end pe-4">
                            <a href="{{ route('students.edit', $student->student_id ?? $student->id) }}" class="btn btn-sm btn-warning text-dark fw-semibold px-3 me-1">
                                Edit
                            </a>
                            <form action="{{ route('students.destroy', $student->student_id ?? $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to archive this student?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger fw-semibold px-3">
                                    Delete
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ auth()->user()->role === 'admin' ? '7' : '6' }}" class="text-center py-4 text-muted">
                        @if(request('search'))
                            No student records found matching "{{ request('search') }}".
                        @else
                            No student records found.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Footer -->
    @if($students->total() > 0)
    <div class="card-footer bg-white border-top-0 py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <small class="text-muted">
            Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} of {{ $students->total() }} entries
        </small>
        <div>
            {{ $students->links() }}
        </div>
    </div>
    @endif
</div>
@endsection

