@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h2 class="h4 fw-bold text-dark mb-1">Edit Course</h2>
                <p class="text-secondary small mb-0">Update course details for {{ $course['title'] }}</p>
            </div>
            <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Back to Courses
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <span class="fw-semibold text-dark">
                    <i class="bi bi-pencil-square me-2 text-warning"></i> Edit Course #{{ $course['id'] }}
                </span>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('courses.update',$course) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Title Field -->
                    <div class="mb-3">
                        <label for="title" class="form-label fw-medium">Course Title <span class="text-danger">*</span></label>
                        <input type="text"
                            name="title"
                            id="title"
                            class="form-control"
                            value="{{ old('title',$course['title']) }}">
                    </div>
                    @error('title')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror

                    <!-- Price Field -->
                    <div class="mb-3">
                        <label for="price" class="form-label fw-medium">Price (USD) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                step="0.01"
                                min="0"
                                name="price"
                                id="price"
                                class="form-control"
                                value="{{ old('price',$course['price']) }}">
                        </div>
                    </div>
                    @error('price')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    <!-- Duration Field -->
                    <div class="mb-3">
                        <label for="duration" class="form-label fw-medium">Duration (Hr) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number"
                                name="duration"
                                id="duration"
                                class="form-control"
                                value="{{ old('duration',$course['duration']) }}">
                            <span class="input-group-text">Hr</span>
                        </div>
                    </div>
                    @error('duration')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    <!-- Description Field -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-medium">Description</label>
                        <textarea name="description"
                            id="description"
                            rows="4"
                            class="form-control">{{ old('description',$course['description']) }}</textarea>
                    </div>
                    @error('description')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror

                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="{{ route('courses.index') }}" class="btn btn-light px-4 border">Cancel</a>
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-check-lg me-1"></i> Update Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection