@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4">Edit Class</h5>

            <form action="{{ route('classes.update', $class->class_id ?? $class->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Class Name</label>
                    <input type="text" name="class_name" class="form-control @error('class_name') is-invalid @enderror" value="{{ old('class_name', $class->class_name) }}" required>
                    @error('class_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Homeroom Teacher</label>
                    <select name="homeroom_teacher_id" class="form-select @error('homeroom_teacher_id') is-invalid @enderror">
                        <option value="">-- Select Homeroom Teacher --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->teacher_id }}" {{ old('homeroom_teacher_id', $class->homeroom_teacher_id) == $teacher->teacher_id ? 'selected' : '' }}>
                                {{ $teacher->full_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('homeroom_teacher_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Academic Year</label>
                    <input type="text" name="academic_year" class="form-control @error('academic_year') is-invalid @enderror" placeholder="e.g. 2024/2025" value="{{ old('academic_year', $class->academic_year) }}" required>
                    @error('academic_year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('classes.index') }}" class="btn btn-light rounded-3 px-4 fw-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-bold">Update Class</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
