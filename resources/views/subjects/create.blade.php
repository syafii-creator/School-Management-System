@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">Add New Subject</h5>

            <form action="{{ route('subjects.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Subject Code</label>
                    <input type="text" name="subject_code" class="form-control @error('subject_code') is-invalid @enderror" placeholder="e.g. MTH-101" value="{{ old('subject_code') }}" required>
                    @error('subject_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Subject Name</label>
                    <input type="text" name="subject_name" class="form-control @error('subject_name') is-invalid @enderror" placeholder="e.g. Mathematics" value="{{ old('subject_name') }}" required>
                    @error('subject_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Credits / Hours</label>
                    <input type="number" name="credits" class="form-control @error('credits') is-invalid @enderror" placeholder="e.g. 2" value="{{ old('credits') }}" required>
                    @error('credits')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('subjects.index') }}" class="btn btn-light rounded-3 px-4 fw-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold">Save Subject</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
