@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="h4 fw-bold text-dark mb-1">{{ $course['id'] }}</h2>
        <p class="text-secondary small mb-0">Course Overview & Enrolled Student Roster</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Back to Courses
        </a>
        <a href="{{ route('courses.edit',$course) }}" class="btn btn-warning btn-sm text-dark">
            <i class="bi bi-pencil-square me-1"></i> Edit Course
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Course Information Card -->
    <div class="col-lg-4">
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <span class="fw-semibold text-dark">
                    <i class="bi bi-journal-text me-2 text-success"></i> Course Summary
                </span>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <span class="badge bg-secondary-subtle text-secondary">Course #{{ $course['id'] }}</span>
                    <span class="badge bg-success fs-6 fw-bold px-3 py-2">
                        ${{ $course['price'] }}
                    </span>
                </div>

                <h5 class="fw-bold text-dark mb-2">{{ $course['title'] }}</h5>
                <p class="text-secondary small mb-3">
                    <em class="text-muted">{{ $course['description'] ?? "No description provided." }}</em>
                </p>

                <ul class="list-group list-group-flush small">
                    <li class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span class="text-muted"><i class="bi bi-people me-2"></i>Total Students</span>
                        <span class="badge bg-primary rounded-pill">{{ $course['students_count'] }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span class="text-muted"><i class="bi bi-calendar3 me-2"></i>Created On</span>
                        <span class="fw-medium text-dark">{{ Carbon\Carbon::parse($course['created_at'])->format('M d,Y') }}</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <!-- Enrolled Students Table -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <span class="fw-semibold text-dark">
                    <i class="bi bi-people-fill me-2 text-primary"></i> Enrolled Students Roster ({{ $course['students_count'] }})
                </span>
            </div>
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($course['students']->isEmpty())


                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                No students are enrolled in this course yet.
                            </td>
                        </tr>
                        @else
                        @foreach($course['students'] as $student)

                        <tr>
                            <td>
                                <div class="fw-semibold text-dark">
                                    <a href="{{ route('students.show',$student) }}" class="text-dark text-decoration-none">
                                        {{ $student['name'] }}
                                    </a>
                                </div>
                                <small class="text-muted">{{ $student['email'] }}</small>
                            </td>
                            <td>
                                {{ $student['phone']?? "N/A" }}
                            </td>
                        </tr>

                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection