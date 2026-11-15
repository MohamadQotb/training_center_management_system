@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 fw-bold">Course Catalog (Course Number)</h2>
    <a href="{{ route('courses.create') }}" class="btn btn-success">Add Course</a>
</div>
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

</div>
@endif
<div class="card">
    <div class="table-responsive">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Duration</th>
                    <th>Students</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($courses->isEmpty())
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No courses found yet.</td>
                </tr>
                @else
                @foreach($courses as $course)
                <tr>
                    <td>{{ $course['id'] }}</td>
                    <td><a href="{{ route('courses.show',$course) }}">{{ $course['title'] }}</a></td>
                    <td>${{ $course['price'] }}</td>
                    <td>${{ $course['duration'] }}</td>
                    <td>{{ $course['students_count'] }}</td>
                    <td class="text-end">
                        <a href="{{ route('courses.show',$course) }}" class="btn btn-outline-info btn-sm">View</a>
                        <a href="{{ route('courses.edit',$course) }}" class="btn btn-outline-warning btn-sm">Edit</a>
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
@endsection