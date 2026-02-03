@extends('layouts.app')

@section('title', 'Course Details - Student Enrollment System')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-book-half"></i> Course Details</h2>
    <div>
        <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Course Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Course ID:</strong> {{ $course->id }}</p>
                <p><strong>Course Code:</strong> <span class="badge bg-warning">{{ $course->course_code }}</span></p>
                <p><strong>Course Name:</strong> {{ $course->course_name }}</p>
                <p><strong>Credits:</strong> {{ $course->credits }}</p>
                <hr>
                <h6><i class="bi bi-person-badge"></i> Assigned Teacher</h6>
                <p class="mb-1"><strong>Name:</strong> {{ $course->teacher->name }}</p>
                <p class="mb-1"><strong>Email:</strong> {{ $course->teacher->email }}</p>
                <p class="mb-1"><strong>Specialization:</strong> {{ $course->teacher->subject_specialization }}</p>
                <a href="{{ route('teachers.show', $course->teacher) }}" class="btn btn-sm btn-success mt-2">
                    <i class="bi bi-eye"></i> View Teacher Profile
                </a>
                <hr>
                <p><strong>Total Students:</strong> {{ $course->enrollments->count() }}</p>
                <p><strong>Created:</strong> {{ $course->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-people-fill"></i> Enrolled Students</h5>
            </div>
            <div class="card-body">
                @if($course->enrollments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Enrollment Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($course->enrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->student->id }}</td>
                                    <td>{{ $enrollment->student->name }}</td>
                                    <td>{{ $enrollment->student->email }}</td>
                                    <td>{{ $enrollment->student->phone ?? 'N/A' }}</td>
                                    <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('students.show', $enrollment->student) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                        <p class="text-muted mt-3">No students enrolled in this course yet.</p>
                        <a href="{{ route('enrollments.create') }}" class="btn btn-info">
                            <i class="bi bi-plus-circle"></i> Enroll Student
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
