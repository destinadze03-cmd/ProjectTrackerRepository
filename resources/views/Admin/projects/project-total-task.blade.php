@extends('admin.layout')

@section('content')

<h2>{{ $project->title }} – All Tasks</h2>

@if($tasks->count())
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Task</th>
                <th>Status</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $index => $task)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ $task->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No tasks found for this project.</p>
@endif

<a href="{{ route('admin.projects.show', $project->id) }}">
    ← Back to Project
</a>

@endsection
