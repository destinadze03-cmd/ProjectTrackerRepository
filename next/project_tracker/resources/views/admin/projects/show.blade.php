@extends('admin.layout')

@section('title', 'Project Details')
@section('header', $project->title)

@section('content')

<style>
.task-box {
    background: white;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 15px;
}
.badge {
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
}
.badge-pending { background: orange; color: white; }
.badge-done { background: green; color: white; }
</style>

<div class="card">
    <h3>{{ $project->title }}</h3>
    <p>{{ $project->description }}</p>

    <p><strong>Start:</strong> {{ $project->start_date }}</p>
    <p><strong>End:</strong> {{ $project->end_date }}</p>

    <a href="{{ route('admin.tasks.create', $project->id) }}" class="btn">+ Add Task</a>
</div>

<hr><br>

<h2>Tasks Under This Project</h2>

@foreach ($project->tasks as $task)
<div class="task-box">
    <h3>{{ $task->title }}</h3>
    <p>{{ $task->description }}</p>

    <span class="badge badge-{{ $task->status == 'pending' ? 'pending' : 'done' }}">
        {{ ucfirst($task->status) }}
    </span>

    <p><strong>Duration:</strong> {{ $task->duration }} days</p>
    <p><strong>Assigned To:</strong> {{ $task->assignedTo->name ?? 'Unassigned' }}</p>
</div>
@endforeach

@if ($project->tasks->count() == 0)
<p>No tasks yet. Click “Add Task”.</p>
@endif

@endsection
