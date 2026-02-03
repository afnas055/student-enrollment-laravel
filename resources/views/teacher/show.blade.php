@extends('layouts.app')

@section('title', 'Teacher Details - Student Enrollment System')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-badge"></i> Teacher Details</h2>
    <div>
        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-person-badge"></i> Teacher Information</h5>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $teacher->id }}</p>
                <p><strong>Name:</strong> {{ $teacher->name }}</p>
                <p><strong>Email:</strong> {{ $teacher->email }}</p>
                <p><strong>Specialization:</strong> {{ $teacher->subject_specialization }}</p>
                <p><strong>Joined:</strong> {{ $teacher->created_at->format('M d, Y') }}</p>
                <p><strong>Total Courses:</strong> {{ $teacher->courses->count() }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-book-half"></i> Assigned Courses</h5>
            </div>
            <div class="card-body">
                @if($teacher->courses->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>Credits</th>
                                    <th>Students Enrolled</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teacher->courses as $course)
                                <tr>
                                    <td><span class="badge bg-warning">{{ $course->course_code }}</span></td>
                                    <td>{{ $course->course_name }}</td>
                                    <td>{{ $course->credits }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $course->enrollments->count() }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i> View
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
                        <p class="text-muted mt-3">No courses assigned to this teacher yet.</p>
                        <a href="{{ route('courses.create') }}" class="btn btn-warning">
                            <i class="bi bi-plus-circle"></i> Add Course
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
