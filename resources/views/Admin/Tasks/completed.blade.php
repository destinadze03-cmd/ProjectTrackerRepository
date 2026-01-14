@extends('admin.layout')

@section('content')
<h2>
    Tasks for {{ $project->title }}
    @if(request('reviewed_status'))
        — {{ ucfirst(request('reviewed_status')) }}
    @endif
</h2>

<table class="table">
    <thead>
        <tr>
            <th>Title</th>
            <th>Reviewed_Status</th>
            <th>Assigned To</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ ucfirst($task->review_status) }}</td>
                <td>{{ $task->assignedTo?->name ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('admin.tasks.show-task-detail', $task->id) }}"
                       class="btn btn-sm btn-primary">
                        Details
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No validated tasks found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-secondary">
    ← Back to Project
</a>
@endsection
