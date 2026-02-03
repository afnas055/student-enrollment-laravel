@extends('layouts.app')

@section('title', 'Add Course - Student Enrollment System')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-book-half"></i> Add New Course</h2>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Courses
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="course_name" class="form-label">Course Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('course_name') is-invalid @enderror" 
                               id="course_name" name="course_name" value="{{ old('course_name') }}" required>
                        @error('course_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="course_code" class="form-label">Course Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('course_code') is-invalid @enderror" 
                               id="course_code" name="course_code" value="{{ old('course_code') }}" required>
                        @error('course_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">e.g., CS101, MATH201</small>
                    </div>

                    <div class="mb-3">
                        <label for="credits" class="form-label">Credits <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('credits') is-invalid @enderror" 
                               id="credits" name="credits" value="{{ old('credits', 3) }}" min="1" max="6" required>
                        @error('credits')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="teacher_id" class="form-label">Assign Teacher <span class="text-danger">*</span></label>
                        <select class="form-select @error('teacher_id') is-invalid @enderror" 
                                id="teacher_id" name="teacher_id" required>
                            <option value="">Select a teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }} - {{ $teacher->subject_specialization }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('courses.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-check-circle"></i> Create Course
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
                <p class="card-text">Fill in the course details. Fields marked with <span class="text-danger">*</span> are required.</p>
                <hr>
                <small class="text-muted">
                    <strong>Note:</strong> Course codes must be unique. Each course must be assigned to a teacher.
                </small>
            </div>
        </div>

        @if($teachers->count() == 0)
        <div class="card bg-warning mt-3">
            <div class="card-body">
                <h6 class="card-title"><i class="bi bi-exclamation-triangle"></i> No Teachers Available</h6>
                <p class="card-text small">You need to add teachers before creating courses.</p>
                <a href="{{ route('teachers.create') }}" class="btn btn-sm btn-dark">
                    <i class="bi bi-plus-circle"></i> Add Teacher
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
