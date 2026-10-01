@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">School Profile & Academic Period</h4>
        <p class="text-muted small mb-0">Manage school identity and active academic session.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm rounded-4 bg-white p-4 col-md-10 mx-auto">
    <form action="{{ route('school.update', $school->school_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <h5 class="fw-bold text-primary mb-3">1. Academic Period</h5>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Academic Year</label>
                <input type="text" name="academic_year" class="form-control" value="{{ old('academic_year', $school->academic_year) }}" {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }} required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Semester Period</label>
                <select name="semester" class="form-select" {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }} required>
                    <option value="Odd" {{ $school->semester == 'Odd' ? 'selected' : '' }}>Odd (Ganjil)</option>
                    <option value="Even" {{ $school->semester == 'Even' ? 'selected' : '' }}>Even (Genap)</option>
                </select>
            </div>

            <hr class="my-4">

            <h5 class="fw-bold text-primary mb-3">2. School Identity</h5>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">School Name</label>
                <input type="text" name="school_name" class="form-control" value="{{ old('school_name', $school->school_name) }}" {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }} required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">NPSN</label>
                <input type="text" name="npsn" class="form-control" value="{{ old('npsn', $school->npsn) }}" {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">School Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $school->phone) }}" {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">School Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $school->email) }}" {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label fw-semibold">Address</label>
                <textarea name="address" class="form-control" rows="3" {{ auth()->user()->role !== 'admin' ? 'disabled' : '' }}>{{ old('address', $school->address) }}</textarea>
            </div>
        </div>

        @if(auth()->user()->role === 'admin')
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary fw-bold px-4 rounded-3">Save Changes</button>
            </div>
        @endif
    </form>
</div>
@endsection
