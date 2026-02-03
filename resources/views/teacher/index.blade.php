@extends('layouts.app')

@section('title', 'Teachers - Student Enrollment System')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-badge-fill"></i> Teachers</h2>
    <a href="{{ route('teachers.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Add New Teacher
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($teachers->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Specialization</th>
                            <th>Courses</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->id }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->subject_specialization }}</td>
                            <td><span class="badge bg-primary">{{ $teacher->courses_count }}</span></td>
                            <td>{{ $teacher->created_at->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure? This will also delete all associated courses.')">
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
                {{ $teachers->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No teachers found. Add your first teacher!</p>
                <a href="{{ route('teachers.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Add Teacher
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
