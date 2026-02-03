@extends('layouts.app')

@section('title', 'Enrollment Report - Student Enrollment System')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-file-earmark-text-fill"></i> Enrollment Report</h2>
    <button onclick="window.print()" class="btn btn-success">
        <i class="bi bi-printer"></i> Print Report
    </button>
</div>

<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Complete Student Enrollment Report</h5>
        <small class="text-muted">Generated on {{ date('F d, Y') }}</small>
    </div>
    <div class="card-body">
        @if($enrollments->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Enrollment ID</th>
                            <th>Student Name</th>
                            <th>Student Email</th>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Credits</th>
                            <th>Teacher Name</th>
                            <th>Teacher Specialization</th>
                            <th>Enrollment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->id }}</td>
                            <td>{{ $enrollment->student->name }}</td>
                            <td>{{ $enrollment->student->email }}</td>
                            <td><span class="badge bg-warning">{{ $enrollment->course->course_code }}</span></td>
                            <td>{{ $enrollment->course->course_name }}</td>
                            <td>{{ $enrollment->course->credits }}</td>
                            <td>{{ $enrollment->course->teacher->name }}</td>
                            <td>{{ $enrollment->course->teacher->subject_specialization }}</td>
                            <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h4>{{ $enrollments->count() }}</h4>
                                <p class="mb-0 text-muted">Total Enrollments</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h4>{{ $enrollments->pluck('student_id')->unique()->count() }}</h4>
                                <p class="mb-0 text-muted">Unique Students</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h4>{{ $enrollments->pluck('course_id')->unique()->count() }}</h4>
                                <p class="mb-0 text-muted">Unique Courses</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-light">
                            <div class="card-body text-center">
                                <h4>{{ $enrollments->pluck('course.teacher_id')->unique()->count() }}</h4>
                                <p class="mb-0 text-muted">Unique Teachers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No enrollment data available to generate report.</p>
                <a href="{{ route('enrollments.create') }}" class="btn btn-info">
                    <i class="bi bi-plus-circle"></i> Create Enrollment
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    @media print {
        .sidebar, .btn, nav, .no-print {
            display: none !important;
        }
        .content-wrapper {
            padding: 0 !important;
        }
        .card {
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>
@endsection
