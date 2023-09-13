@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Task</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Task Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $task->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="project_id" class="form-label">Project</label>
                <select class="form-select" id="project_id" name="project_id">
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}" {{ $project->id == old('project_id', $task->project_id) ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Add more form fields as needed -->

            <button type="submit" class="btn btn-primary">Update Task</button>
        </form>
    </div>
@endsection
