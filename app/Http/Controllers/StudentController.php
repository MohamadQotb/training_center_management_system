<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = Student::with('course')->when($request->filled('search'), function ($query)
        use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })->when($request->filled('course_id'), function ($query) use ($request) {
            $query->where('course_id', $request->course_id);
        })->latest()->paginate(10)->withQueryString();
        $courses = Course::select('id', 'title')->orderBy('title')->get();
        return view('students.index', compact('students', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::select('id', 'title')->orderBy('title')->get();
        return view('students.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'course_id' => 'required|exists:courses,id',
        ]);

        Student::create($validatedData);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $courses = Course::select('id', 'title')->orderBy('title')->get();
        return view('students.edit', compact('student', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
            'course_id' => 'required|exists:courses,id',
        ]);

        $student->update($validatedData);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
