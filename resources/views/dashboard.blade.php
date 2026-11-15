@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 fw-bold text-dark mb-1">System Overview</h2>
        <p class="text-secondary small mb-0">Welcome to your Course Management Dashboard.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('students.create') }}" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-person-plus me-1"></i> Add Student
        </a>
        <a href="{{ route('courses.create') }}" class="btn btn-outline-success btn-sm">
            <i class="bi bi-journal-plus me-1"></i> Add Course
        </a>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-4 mb-4">
    <!-- Total Students Card -->
    <div class="col-md-6">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary small text-uppercase fw-semibold">Total Students</span>
                    <h3 class="fw-bold mt-2 mb-0 text-dark">{{ $studentsCount }}</h3>
                    <a href="{{ route('students.index') }}" class="text-primary small text-decoration-none mt-2 d-inline-block">
                        View students <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="icon-badge badge-blue">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Courses Card -->
    <div class="col-md-6">
        <div class="card stat-card p-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-secondary small text-uppercase fw-semibold">Total Courses</span>
                    <h3 class="fw-bold mt-2 mb-0 text-dark">{{ $coursesCount }}</h3>
                    <a href="{{ route('courses.index') }}" class="text-success small text-decoration-none mt-2 d-inline-block">
                        View courses <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="icon-badge badge-green">
                    <i class="bi bi-journal-code"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Recent Courses & Quick Actions -->
<div class="row g-4">
    <!-- Recent Enrollments Table -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="text-dark fw-semibold">
                    <i class="bi bi-clock-history me-2 text-primary"></i> Recent Courses
                </span>
                <a href="{{ route('courses.index') }}" class="small text-decoration-none">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Students</th>
                            <th>Created Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($recentCourses->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                No courses found yet.
                            </td>
                        </tr>
                        @else
                        @foreach($recentCourses as $course)

                        <tr>
                            <td>
                                <div class="fw-semibold text-dark">{{ $course['title'] }}</div>
                                <small class="text-muted">{{ Str::limit($course->description, 50) }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $course['students_count'] }}</span>
                            </td>
                            <td class="text-secondary small">
                                {{ \Carbon\Carbon::parse($course['created_at'])->format('Y-m-d H:i:s') }}
                            </td>
                            <td class="text-end">
                                <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this course?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Info / Helpful Links -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <span class="text-dark fw-semibold">
                    <i class="bi bi-lightning-charge-fill me-2 text-warning"></i> Quick Actions
                </span>
            </div>
            <div class="card-body d-flex flex-column gap-3">

                <a href="{{ route('students.create') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-between p-3 rounded-3 text-decoration-none">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-plus-fill fs-4 me-3 text-primary"></i>
                        <div class="text-start">
                            <div class="fw-bold text-dark">Register Student</div>
                            <small class="text-muted">Create a new student profile</small>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-muted"></i>
                </a>

                <a href="{{ route('courses.create') }}" class="btn btn-outline-secondary d-flex align-items-center justify-content-between p-3 rounded-3 text-decoration-none">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-journal-plus fs-4 me-3 text-success"></i>
                        <div class="text-start">
                            <div class="fw-bold text-dark">Create Course</div>
                            <small class="text-muted">Add a new curriculum item</small>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-muted"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection