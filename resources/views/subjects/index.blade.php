@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-decoration-none">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Subject Data</li>
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
        <h4 class="fw-bold text-dark mb-1">Subject Data</h4>
        <p class="text-muted small mb-0">Manage curriculum subjects and credit hours.</p>
    </div>
    @if(auth()->user()->role === 'admin')
        <a href="{{ route('subjects.create') }}" class="btn btn-primary fw-bold px-3 py-2 rounded-3">
            <i class="bi bi-plus-lg me-1"></i> Add Subject
        </a>
    @endif
</div>

<!-- Subject Table Card -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light text-muted small text-uppercase">
                <tr>
                    <th class="ps-4" style="width: 60px;">NO</th>
                    <th>SUBJECT CODE</th>
                    <th>SUBJECT NAME</th>
                    <!-- Header Rata Kanan untuk Angka -->
                    <th class="text-end">CREDITS / HOURS</th>
                    <!-- Tanggal Pembuatan -->
                    <th class="text-center">CREATED DATE</th>
                    @if(auth()->user()->role === 'admin')
                        <th class="text-end pe-4">ACTION</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $index => $subject)
                <tr>
                    <td class="ps-4 text-secondary fw-medium">{{ $index + 1 }}</td>
                    <td class="text-secondary fw-medium">{{ $subject->subject_code }}</td>
                    <td class="fw-bold text-dark">{{ $subject->subject_name }}</td>

                    <!-- Format Angka dengan number_format & Rata Kanan -->
                    <td class="text-end fw-semibold text-dark">
                        {{ number_format($subject->credits, 0, ',', '.') }} Hours
                    </td>

                    <!-- Format Tanggal Indonesia Sesuai Brief (Contoh: 1 Okt 2026) -->
                    <td class="text-center text-muted small">
                        {{ \Carbon\Carbon::parse($subject->created_at)->locale('id')->translatedFormat('j M Y') }}
                    </td>

                    @if(auth()->user()->role === 'admin')
                        <td class="text-end pe-4">
                            <a href="{{ route('subjects.edit', $subject->slug) }}" class="btn btn-sm btn-warning text-dark fw-semibold px-3 me-1">
                                Edit
                            </a>

                            <form action="{{ route('subjects.destroy', $subject->slug) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to archive this subject?')">
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
                    <td colspan="{{ auth()->user()->role === 'admin' ? '6' : '5' }}" class="text-center py-4 text-muted">No subject records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
