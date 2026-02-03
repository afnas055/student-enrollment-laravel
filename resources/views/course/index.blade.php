@extends('layouts.app')

@section('title', 'Courses - Student Enrollment System')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-book-fill"></i> Courses</h2>
    <a href="{{ route('courses.create') }}" class="btn btn-warning">
        <i class="bi bi-plus-circle"></i> Add New Course
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($courses->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th>Credits</th>
                            <th>Teacher</th>
                            <th>Students</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td><span class="badge bg-warning">{{ $course->course_code }}</span></td>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->credits }}</td>
                            <td>
                                <i class="bi bi-person-badge"></i> {{ $course->teacher->name }}
                                <br>
                                <small class="text-muted">{{ $course->teacher->subject_specialization }}</small>
                            </td>
                            <td><span class="badge bg-primary">{{ $course->enrollments_count }}</span></td>
                            <td>
                                <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure? This will also delete all enrollments for this course.')">
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
                {{ $courses->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No courses found. Add your first course!</p>
                <a href="{{ route('courses.create') }}" class="btn btn-warning">
                    <i class="bi bi-plus-circle"></i> Add Course
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
