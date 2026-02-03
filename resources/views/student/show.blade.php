@extends('layouts.app')

@section('title', 'Student Details - Student Enrollment System')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-circle"></i> Student Details</h2>
    <div>
        <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-person-badge"></i> Student Information</h5>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $student->id }}</p>
                <p><strong>Name:</strong> {{ $student->name }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Phone:</strong> {{ $student->phone ?? 'N/A' }}</p>
                <p><strong>Joined:</strong> {{ $student->created_at->format('M d, Y') }}</p>
                <p><strong>Total Enrollments:</strong> {{ $student->enrollments->count() }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-book-half"></i> Enrolled Courses</h5>
            </div>
            <div class="card-body">
                @if($student->enrollments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>Credits</th>
                                    <th>Teacher</th>
                                    <th>Enrollment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->enrollments as $enrollment)
                                <tr>
                                    <td><span class="badge bg-primary">{{ $enrollment->course->course_code }}</span></td>
                                    <td>{{ $enrollment->course->course_name }}</td>
                                    <td>{{ $enrollment->course->credits }}</td>
                                    <td>
                                        <i class="bi bi-person-badge"></i> {{ $enrollment->course->teacher->name }}
                                        <br>
                                        <small class="text-muted">{{ $enrollment->course->teacher->subject_specialization }}</small>
                                    </td>
                                    <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <p class="mb-0"><strong>Total Credits:</strong> {{ $student->enrollments->sum(function($e) { return $e->course->credits; }) }}</p>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                        <p class="text-muted mt-3">This student is not enrolled in any courses yet.</p>
                        <a href="{{ route('enrollments.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Enroll in Course
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
