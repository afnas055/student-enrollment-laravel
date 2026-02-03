@extends('layouts.app')

@section('title', 'Edit Teacher - Student Enrollment System')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-pencil-square"></i> Edit Teacher</h2>
    <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back to Teachers
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('teachers.update', $teacher) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $teacher->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $teacher->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subject_specialization" class="form-label">Subject Specialization <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('subject_specialization') is-invalid @enderror" 
                               id="subject_specialization" name="subject_specialization" 
                               value="{{ old('subject_specialization', $teacher->subject_specialization) }}" required>
                        @error('subject_specialization')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Update Teacher
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-info-circle"></i> Teacher Info</h5>
                <p class="card-text"><strong>Teacher ID:</strong> {{ $teacher->id }}</p>
                <p class="card-text"><strong>Total Courses:</strong> {{ $teacher->courses->count() }}</p>
                <p class="card-text"><strong>Joined:</strong> {{ $teacher->created_at->format('M d, Y') }}</p>
                <p class="card-text"><strong>Last Updated:</strong> {{ $teacher->updated_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
