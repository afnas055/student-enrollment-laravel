<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of enrollments.
     */
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'course.teacher'])
                                 ->latest()
                                 ->paginate(15);
        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new enrollment.
     */
    public function create()
    {
        $students = Student::all();
        $courses = Course::with('teacher')->get();
        return view('enrollments.create', compact('students', 'courses'));
    }

    /**
     * Store a newly created enrollment in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'enrollment_date' => 'required|date',
        ]);

        // Check if enrollment already exists
        $exists = Enrollment::where('student_id', $validated['student_id'])
                           ->where('course_id', $validated['course_id'])
                           ->exists();

        if ($exists) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Student is already enrolled in this course.');
        }

        Enrollment::create($validated);

        return redirect()->route('enrollments.index')
                         ->with('success', 'Enrollment created successfully.');
    }

    /**
     * Display the specified enrollment.
     */
    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['student', 'course.teacher']);
        return view('enrollments.show', compact('enrollment'));
    }

    /**
     * Remove the specified enrollment from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index')
                         ->with('success', 'Enrollment deleted successfully.');
    }

    /**
     * Display enrollment report.
     */
    public function report()
    {
        $enrollments = Enrollment::with(['student', 'course.teacher'])
                                 ->orderBy('enrollment_date', 'desc')
                                 ->get();

        return view('enrollments.report', compact('enrollments'));
    }
}
