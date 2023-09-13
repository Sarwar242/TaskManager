@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tasks</h1>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>
    <!-- Project Tabs -->
    <ul class="nav nav-tabs" id="projectTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
        </li>
        @foreach ($projects as $project)
        <li class="nav-item">
            <a class="nav-link" id="project-{{ $project->id }}-tab" data-bs-toggle="tab" href="#project-{{ $project->id }}" role="tab" aria-controls="project-{{ $project->id }}" aria-selected="false">{{ $project->name }}</a>
        </li>
        @endforeach
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="projectTabsContent">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            <!-- Display all tasks here -->
            <ul id="sortable-tasks" class="list-group">
                @foreach ($tasks as $task)
                <li id="task-{{ $task->id }}" class="list-group-item">
                    <span class="handle">&#9776;</span>
                    {{ $task->name }}
                    <div class="float-end">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @foreach ($projects as $project)
        <div class="tab-pane fade" id="project-{{ $project->id }}" role="tabpanel" aria-labelledby="project-{{ $project->id }}-tab">
            <!-- Display tasks for the selected project here -->
            <ul id="sortable-tasks-{{ $project->id }}" class="list-group">
                @foreach ($project->tasks as $task)
                <li id="task-{{ $task->id }}" class="list-group-item">
                    <span class="handle">&#9776;</span>
                    {{ $task->name }}
                    <div class="float-end">
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <!-- JavaScript for Sorting -->
<script>
    // Make tasks sortable
    function makeTasksSortable(projectId = null) {
        const sortableTasksId = projectId ? `sortable-tasks-${projectId}` : 'sortable-tasks';

        new Sortable(document.getElementById(sortableTasksId), {
            handle: '.handle',
            onEnd: function (evt) {
                const taskIds = [];
                $(`#${sortableTasksId} li`).each(function () {
                    taskIds.push($(this).attr('id').replace('task-', ''));
                });

                // Send an AJAX request to update priorities in the backend
                $.ajax({
                    url: "{{ route('tasks.update-priorities') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { taskIds: taskIds },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        });
    }

    // Initialize sorting for all tasks
    makeTasksSortable();

    // Initialize sorting for each project's tasks
    @foreach ($projects as $project)
        makeTasksSortable({{ $project->id }});
    @endforeach
</script>
@endsection
