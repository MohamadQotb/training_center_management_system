@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 fw-bold text-dark mb-1">Student Management</h2>
        <p class="text-secondary small mb-0">register students.</p>
    </div>
    <a href="{{ route('students.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-person-plus-fill me-1"></i> Add Student
    </a>
</div>
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<form action="{{ route('students.index') }}" method="GET" class="row g-3 mb-4">
    <div class="col-md-5">
        <input type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control"
            placeholder="Search student by name...">
    </div>
    <div class="col-md-4">
        <select name="course_id" class="form-select">
            <option value="">All Courses</option>
            @foreach($courses as $course)
            <option value="{{ $course->id }}" @selected(request('course_id')==$course->id)>
                {{ $course->title }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3 d-flex gap-2">
        <button type="submit" class="btn btn-primary w-100">Filter</button>
        @if(request()->filled('search') || request()->filled('course_id'))
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">Reset</a>
        @endif
    </div>
</form>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="fw-semibold text-dark">
            <i class="bi bi-people-fill me-2 text-primary"></i> All Students ({{ $students->total() }})
        </span>
    </div>
    <div class="table-responsive">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                    <th class="text-end" style="width: 180px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($students->isEmpty())
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">
                        @if(request()->filled('search') || request()->filled('course_id'))
                        No students found matching your search criteria.
                        @else
                        No students registered yet. Click "Add Student" to create the first record.
                        @endif
                    </td>
                </tr>
                @else
                @foreach ($students as $student)
                <tr>

                    <td class="text-secondary fw-semibold">#{{ $student['id'] }}</td>
                    <td class="fw-semibold text-dark">{{ $student['name'] }}</td>

                    <td>{{ $student['email'] }}</td>
                    <td>{{ $student['phone']?? "N/A" }}</td>
                    <td>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle badge-count">
                            <i class="bi bi-journal-bookmark me-1"></i>
                            {{ $student->course->title }}
                        </span>
                    </td>
                    <td class="text-end">
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('students.edit', $student) }}"
                                class="btn btn-outline-warning"
                                title="Edit Student">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this student?');" title="Delete Student">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>

        </table>

    </div>
    @if($students->hasPages())
    <div class="card-footer bg-white py-3">
        {{ $students->links() }}
    </div>
    @endif
</div>
@endsection