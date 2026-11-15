@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="h4 fw-bold text-dark mb-1">Edit Student</h2>
                <p class="text-secondary small mb-0">Update information for {{ $student->name }}</p>
            </div>
            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Back to List
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <span class="fw-semibold text-dark">
                    <i class="bi bi-pencil-square me-2 text-warning"></i> Edit Student #{{ $student->id }}
                </span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('students.update',$student) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-medium">Full Name <span class="text-danger">*</span></label>
                        <input type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="{{ old('name', $student->name) }}">
                    </div>
                    @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-medium">Email Address <span class="text-danger">*</span></label>
                        <input type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            value="{{ old('email', $student->email) }}">
                    </div>
                    @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror

                    <!-- Phone Field -->
                    <div class="mb-4">
                        <label for="phone" class="form-label fw-medium">Phone Number</label>
                        <input type="text"
                            name="phone"
                            id="phone"
                            class="form-control"
                            value="{{ old('phone', $student->phone) }}">
                    </div>
                    @error('phone')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <div class="mb-4">
                        <label for="course_id" class="form-label fw-medium">Select Course <span class="text-danger">*</span></label>
                        <select name="course_id" id="course_id" class="form-select" required>
                            <option value="">-- Choose Course --</option>
                            @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id', $student->course_id) == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @error('course_id')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror

                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="{{ route('students.index') }}" class="btn btn-light px-4 border">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i> Update Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection