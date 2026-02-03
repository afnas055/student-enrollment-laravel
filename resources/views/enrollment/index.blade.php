@extends('layouts.app')

@section('title', 'Enrollments - Student Enrollment System')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clipboard-check-fill"></i> Enrollments</h2>
    <a href="{{ route('enrollments.create') }}" class="btn btn-info">
        <i class="bi bi-plus-circle"></i> New Enrollment
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($enrollments->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student</th>
                            <th>Course</th>
                            <th>Course Code</th>
                            <th>Teacher</th>
                            <th>Enrollment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->id }}</td>
                            <td>
                                <i class="bi bi-person-circle"></i> {{ $enrollment->student->name }}
                                <br>
                                <small class="text-muted">{{ $enrollment->student->email }}</small>
                            </td>
                            <td>{{ $enrollment->course->course_name }}</td>
                            <td><span class="badge bg-warning">{{ $enrollment->course->course_code }}</span></td>
                            <td>
                                <i class="bi bi-person-badge"></i> {{ $enrollment->course->teacher->name }}
                                <br>
                                <small class="text-muted">{{ $enrollment->course->teacher->subject_specialization }}</small>
                            </td>
                            <td>{{ $enrollment->enrollment_date->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('enrollments.show', $enrollment) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this enrollment?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $enrollments->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No enrollments found. Create your first enrollment!</p>
                <a href="{{ route('enrollments.create') }}" class="btn btn-info">
                    <i class="bi bi-plus-circle"></i> New Enrollment
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
