@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Project</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <!-- Add more form fields as needed -->

            <button type="submit" class="btn btn-primary">Create Project</button>
        </form>
    </div>
@endsection
