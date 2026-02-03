<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $stats = [
            'total_students' => Student::count(),
            'total_teachers' => Teacher::count(),
            'total_courses' => Course::count(),
            'total_enrollments' => Enrollment::count(),
        ];

        $recent_enrollments = Enrollment::with(['student', 'course.teacher'])
                                        ->latest()
                                        ->limit(5)
                                        ->get();

        $popular_courses = Course::withCount('enrollments')
                                 ->with('teacher')
                                 ->orderBy('enrollments_count', 'desc')
                                 ->limit(5)
                                 ->get();

        return view('dashboard', compact('stats', 'recent_enrollments', 'popular_courses'));
    }
}

    

