@extends('admin.layout')

@section('title', 'Create Project')
@section('header', 'Create New Project')

@section('content')

<form action="{{ route('admin.projects.store') }}" method="POST">
    @csrf

    <div class="card">
        <label>Title</label>
        <input type="text" name="title" class="input" required>

        <label>Description</label>
        <textarea name="description" class="input"></textarea>

        <label>Start Date</label>
        <input type="date" name="start_date" class="input" required>

        <label>End Date</label>
        <input type="date" name="end_date" class="input" required>

        <label>Status</label>
        <select name="status" class="input">
            <option value="pending">Pending</option>
            <option value="in-progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>

        <button class="btn">Create Project</button>
    </div>
</form>

@endsection
