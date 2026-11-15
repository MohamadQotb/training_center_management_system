<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsCount = Student::count();
        $coursesCount = Course::count();
        $recentCourses = Course::withCount('students')->orderBy('created_at', 'desc')->take(5)->get();
        return view('dashboard', compact('studentsCount', 'coursesCount', 'recentCourses'));
    }
}
