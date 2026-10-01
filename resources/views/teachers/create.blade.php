@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">Add New Teacher</h5>

            <form action="{{ route('teachers.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">NIP / Teacher ID</label>
                    <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" placeholder="e.g. TCH-106" value="{{ old('nip') }}" required>
                    @error('nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Full Name</label>
                    <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" placeholder="Full name with titles" value="{{ old('full_name') }}" required>
                    @error('full_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email (For Login)</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="teacher@school.com" value="{{ old('email') }}" required>
                    <small class="text-muted d-block mt-1">Default login password will be: <strong>password123</strong></small>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Subject Specialization</label>
                    <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror">
                        <option value="">-- Select Subject --</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->subject_id }}" {{ old('subject_id') == $subject->subject_id ? 'selected' : '' }}>
                                {{ $subject->subject_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Phone Number (Optional)</label>
                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="08xxxxxxxxx" value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('teachers.index') }}" class="btn btn-light rounded-3 px-4 fw-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold">Save Teacher</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
