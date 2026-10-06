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

<!-- Header & Toolbar Search -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">Subject Data</h4>
        <p class="text-muted small mb-0">Manage curriculum subjects and credit hours.</p>
    </div>

    <div class="d-flex flex-wrap align-items-center gap-2">
        <!-- Form Search -->
        <form action="{{ route('subjects.index') }}" method="GET" class="d-flex gap-2">
            <div class="input-group">
                <input type="text"
                       name="search"
                       class="form-control bg-white border-0 shadow-sm ps-3"
                       placeholder="Search subject, code..."
                       value="{{ request('search') }}"
                       style="min-width: 220px;">
                <button type="submit" class="btn btn-primary fw-bold shadow-sm px-3">
                    <i class="bi bi-search"></i> Search
                </button>
            </div>
            @if(request('search'))
                <a href="{{ route('subjects.index') }}" class="btn btn-light border shadow-sm" title="Reset Search">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </form>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('subjects.create') }}" class="btn btn-primary fw-bold px-3 py-2 rounded-3 shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Subject
            </a>
        @endif
    </div>
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
                    <th class="text-center">CREDITS / HOURS</th>
                    <th class="text-center">CREATED DATE</th>
                    @if(auth()->user()->role === 'admin')
                        <th class="text-end pe-4">ACTION</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $index => $subject)
                <tr>
                    <td class="ps-4 text-secondary fw-medium">{{ $subjects->firstItem() + $index }}</td>
                    <td class="text-secondary fw-medium">{{ $subject->subject_code ?? $subject->code ?? '-' }}</td>
                    <td class="fw-bold text-dark">{{ $subject->subject_name ?? $subject->name }}</td>
                    <td class="text-center text-secondary fw-medium">{{ $subject->credits ? $subject->credits . ' Hours' : '-' }}</td>
                    <td class="text-center text-muted small">
                        {{ \Carbon\Carbon::parse($subject->created_at)->locale('id')->translatedFormat('j M Y') }}
                    </td>

                    @if(auth()->user()->role === 'admin')
                        <td class="text-end pe-4">
                            <a href="{{ route('subjects.edit', $subject->subject_id ?? $subject->slug ?? $subject->id) }}" class="btn btn-sm btn-warning text-dark fw-semibold px-3 me-1">
                                Edit
                            </a>
                            <form action="{{ route('subjects.destroy', $subject->subject_id ?? $subject->slug ?? $subject->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this subject?')">
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
                    <td colspan="{{ auth()->user()->role === 'admin' ? '6' : '5' }}" class="text-center py-4 text-muted">
                        @if(request('search'))
                            No subject records found matching "{{ request('search') }}".
                        @else
                            No subject records found.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Footer -->
    @if($subjects->total() > 0)
    <div class="card-footer bg-white border-top-0 py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <small class="text-muted">
            Showing {{ $subjects->firstItem() ?? 0 }} to {{ $subjects->lastItem() ?? 0 }} of {{ $subjects->total() }} entries
        </small>
        <div>
            {{ $subjects->links() }}
        </div>
    </div>
    @endif
</div>
@endsection
