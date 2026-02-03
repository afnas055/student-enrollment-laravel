<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Students Routes
Route::resource('students', StudentController::class);

// Teachers Routes
Route::resource('teachers', TeacherController::class);

// Courses Routes
Route::resource('courses', CourseController::class);

// Enrollments Routes
Route::resource('enrollments', EnrollmentController::class)->except(['edit', 'update']);
Route::get('/enrollment-report', [EnrollmentController::class, 'report'])->name('enrollments.report');
