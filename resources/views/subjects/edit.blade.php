@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('subjects.index') }}" class="text-decoration-none text-primary fw-semibold">Subject Data</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Edit Subject</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">Edit Subject</h5>

            <!-- PERBAIKAN: Mengambil nilai 'mathematics' langsung dari URL aktif -->
            <form action="{{ route('subjects.update', ['id' => request()->route('id') ?? request()->route('subject') ?? $subject->subject_id ?? $subject->slug]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Subject Code</label>
                    <input type="text" name="subject_code" class="form-control @error('subject_code') is-invalid @enderror" value="{{ old('subject_code', $subject->subject_code ?? '') }}" required>
                    @error('subject_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Subject Name</label>
                    <input type="text" name="subject_name" class="form-control @error('subject_name') is-invalid @enderror" value="{{ old('subject_name', $subject->subject_name ?? '') }}" required>
                    @error('subject_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Credits / Hours</label>
                    <input type="number" name="credits" class="form-control @error('credits') is-invalid @enderror" value="{{ old('credits', $subject->credits ?? '') }}" required>
                    @error('credits')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('subjects.index') }}" class="btn btn-light rounded-3 px-4 fw-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold">Update Subject</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
