@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 fw-bold">Course Catalog (Course Number)</h2>
    <a href="courses/create.php" class="btn btn-success">Add Course</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-custom mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Students</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>

                <!-- <tr><td colspan="5" class="text-center py-4">No courses yet.</td></tr> -->

                <tr>
                    <td>Course ID</td>
                    <td><a href="courses/show.php?id=1">title</a></td>
                    <td>$price</td>
                    <td>number</td>
                    <td class="text-end">
                        <a href="courses/show.php?id=1" class="btn btn-outline-info btn-sm">View</a>
                        <a href="courses/edit.php?id=1" class="btn btn-outline-warning btn-sm">Edit</a>
                        <a href="courses/delete.php?id=1" class="btn btn-outline-danger btn-sm" onclick="return confirm('Delete?');">Delete</a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
@endsection