@extends('layouts.app')

@section('title', 'Enrollment Details - Student Enrollment System')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clipboard-check"></i> Enrollment Details</h2>
    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Enrollments
    </a>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-person-circle"></i> Student Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Student ID:</strong> {{ $enrollment->student->id }}</p>
                <p><strong>Name:</strong> {{ $enrollment->student->name }}</p>
                <p><strong>Email:</strong> {{ $enrollment->student->email }}</p>
                <p><strong>Phone:</strong> {{ $enrollment->student->phone ?? 'N/A' }}</p>
                <a href="{{ route('students.show', $enrollment->student) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-eye"></i> View Student Profile
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="bi bi-book-half"></i> Course Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Course Code:</strong> <span class="badge bg-warning">{{ $enrollment->course->course_code }}</span></p>
                <p><strong>Course Name:</strong> {{ $enrollment->course->course_name }}</p>
                <p><strong>Credits:</strong> {{ $enrollment->course->credits }}</p>
                <hr>
                <h6><i class="bi bi-person-badge"></i> Course Teacher</h6>
                <p class="mb-1"><strong>Name:</strong> {{ $enrollment->course->teacher->name }}</p>
                <p class="mb-1"><strong>Email:</strong> {{ $enrollment->course->teacher->email }}</p>
                <p class="mb-1"><strong>Specialization:</strong> {{ $enrollment->course->teacher->subject_specialization }}</p>
                <a href="{{ route('courses.show', $enrollment->course) }}" class="btn btn-sm btn-warning">
                    <i class="bi bi-eye"></i> View Course Details
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-calendar-check"></i> Enrollment Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Enrollment ID:</strong> {{ $enrollment->id }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Enrollment Date:</strong> {{ $enrollment->enrollment_date->format('F d, Y') }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Record Created:</strong> {{ $enrollment->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
