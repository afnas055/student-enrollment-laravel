@extends('layouts.app')

@section('title', 'Dashboard - Student Enrollment System')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-speedometer2"></i> Dashboard</h2>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card stat-card-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Students</h6>
                        <h2 class="mb-0">{{ $stats['total_students'] }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="bi bi-people-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card stat-card-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Teachers</h6>
                        <h2 class="mb-0">{{ $stats['total_teachers'] }}</h2>
                    </div>
                    <div class="text-success">
                        <i class="bi bi-person-badge-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card stat-card-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Courses</h6>
                        <h2 class="mb-0">{{ $stats['total_courses'] }}</h2>
                    </div>
                    <div class="text-warning">
                        <i class="bi bi-book-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card stat-card-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Enrollments</h6>
                        <h2 class="mb-0">{{ $stats['total_enrollments'] }}</h2>
                    </div>
                    <div class="text-info">
                        <i class="bi bi-clipboard-check-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Enrollments -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-clock-history"></i> Recent Enrollments</h5>
            </div>
            <div class="card-body">
                @if($recent_enrollments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Course</th>
                                    <th>Teacher</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_enrollments as $enrollment)
                                <tr>
                                    <td>{{ $enrollment->student->name }}</td>
                                    <td>{{ $enrollment->course->course_code }}</td>
                                    <td>{{ $enrollment->course->teacher->name }}</td>
                                    <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center py-3">No enrollments yet.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Popular Courses -->
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-star-fill"></i> Popular Courses</h5>
            </div>
            <div class="card-body">
                @if($popular_courses->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($popular_courses as $course)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ $course->course_name }}</h6>
                                <small class="text-muted">{{ $course->teacher->name }}</small>
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ $course->enrollments_count }} students</span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center py-3">No courses available.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-lightning-fill"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ route('students.create') }}" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-plus-circle"></i> Add Student
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('teachers.create') }}" class="btn btn-success w-100 mb-2">
                            <i class="bi bi-plus-circle"></i> Add Teacher
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('courses.create') }}" class="btn btn-warning w-100 mb-2">
                            <i class="bi bi-plus-circle"></i> Add Course
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('enrollments.create') }}" class="btn btn-info w-100 mb-2">
                            <i class="bi bi-plus-circle"></i> New Enrollment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
