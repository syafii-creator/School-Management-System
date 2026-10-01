@extends('layouts.app')

@section('content')
<div class="card border-0 shadow-sm rounded-4 p-4 bg-white col-md-8 mx-auto">
    <h4 class="fw-bold mb-4">Add New Student</h4>

    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">NIS</label>
            <input type="text" name="nis" class="form-control" placeholder="e.g. STD-011" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" placeholder="Student full name" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email (For Login)</label>
            <input type="email" name="email" class="form-control" placeholder="student@school.com" required>
            <small class="text-muted">Default login password will be: <b>password123</b></small>
        </div>
        <div class="mb-3">
            <label class="form-label">Class</label>
            <select name="class_id" class="form-select" required>
                <option value="">-- Select Class --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->class_id ?? $class->id }}">{{ $class->class_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" required>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('students.index') }}" class="btn btn-light">Cancel</a>
            <button type="submit" class="btn btn-primary fw-bold">Save Student</button>
        </div>
    </form>
</div>
@endsection
