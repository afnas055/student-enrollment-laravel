@extends('layouts.app')

@section('title', 'New Enrollment - Student Enrollment System')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clipboard-plus"></i> New Enrollment</h2>
    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Enrollments
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('enrollments.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="student_id" class="form-label">Select Student <span class="text-danger">*</span></label>
                        <select class="form-select @error('student_id') is-invalid @enderror" 
                                id="student_id" name="student_id" required>
                            <option value="">Choose a student</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} - {{ $student->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="course_id" class="form-label">Select Course <span class="text-danger">*</span></label>
                        <select class="form-select @error('course_id') is-invalid @enderror" 
                                id="course_id" name="course_id" required>
                            <option value="">Choose a course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->course_code }} - {{ $course->course_name }} 
                                    ({{ $course->teacher->name }})
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="enrollment_date" class="form-label">Enrollment Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('enrollment_date') is-invalid @enderror" 
                               id="enrollment_date" name="enrollment_date" 
                               value="{{ old('enrollment_date', date('Y-m-d')) }}" required>
                        @error('enrollment_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-info">
                            <i class="bi bi-check-circle"></i> Create Enrollment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-info-circle"></i> Information</h5>
                <p class="card-text">Select a student and course to enroll. Fields marked with <span class="text-danger">*</span> are required.</p>
                <hr>
                <small class="text-muted">
                    <strong>Note:</strong> A student cannot be enrolled in the same course twice.
                </small>
            </div>
        </div>

        @if($students->count() == 0 || $courses->count() == 0)
        <div class="card bg-warning mt-3">
            <div class="card-body">
                <h6 class="card-title"><i class="bi bi-exclamation-triangle"></i> Prerequisites Required</h6>
                @if($students->count() == 0)
                <p class="card-text small mb-2">You need to add students first.</p>
                <a href="{{ route('students.create') }}" class="btn btn-sm btn-dark mb-2">
                    <i class="bi bi-plus-circle"></i> Add Student
                </a>
                @endif
                @if($courses->count() == 0)
                <p class="card-text small mb-2">You need to add courses first.</p>
                <a href="{{ route('courses.create') }}" class="btn btn-sm btn-dark">
                    <i class="bi bi-plus-circle"></i> Add Course
                </a>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
