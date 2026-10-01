@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Class Data</li>
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

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">Class Data</h4>
        <p class="text-muted small mb-0">Manage school classes and assigned homeroom teachers.</p>
    </div>
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('classes.create') }}" class="btn btn-primary fw-bold px-3 py-2 rounded-3">
            <i class="bi bi-plus-lg me-1"></i> Add Class
        </a>
    @endif
</div>

<!-- Class Table Card -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4" style="width: 60px;">NO</th>
                    <th>CLASS NAME</th>
                    <th>HOMEROOM TEACHER</th>
                    <th>ACADEMIC YEAR</th>
                    <th class="text-center">CREATED DATE</th>
                    @if(auth()->user()->role === 'admin')
                        <th class="text-end pe-4">ACTION</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($classes as $index => $class)
                <tr>
                    <td class="ps-4 text-secondary fw-medium">{{ $index + 1 }}</td>
                    <td class="fw-bold text-dark">{{ $class->class_name }}</td>
                    <td>
                        <span class="badge bg-light text-dark border px-2 py-1">
                            {{ $class->teacher->full_name ?? $class->teacher->name ?? 'Unassigned' }}
                        </span>
                    </td>
                    <td class="text-secondary fw-medium">{{ $class->academic_year }}</td>

                    <!-- Format Tanggal Indonesia Sesuai Brief (Contoh: 1 Feb 2024) -->
                    <td class="text-center text-muted small">
                        {{ \Carbon\Carbon::parse($class->created_at)->locale('id')->translatedFormat('j M Y') }}
                    </td>

                    @if(auth()->user()->role === 'admin')
                        <td class="text-end pe-4">
                            <a href="{{ route('classes.edit', $class->class_id ?? $class->id) }}" class="btn btn-sm btn-warning text-dark fw-semibold px-3 me-1">
                                Edit
                            </a>
                            <form action="{{ route('classes.destroy', $class->class_id ?? $class->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to archive this class?')">
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
                    <td colspan="{{ auth()->user()->role === 'admin' ? '6' : '5' }}" class="text-center py-4 text-muted">No class records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
