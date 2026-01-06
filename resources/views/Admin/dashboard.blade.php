@extends('admin.layout')

@section('content')

<div class="main-conten">

```
<!-- Top Bar -->
<div class="topbar">
    <h2>Admin Dashboard</h2>
    <p>Welcome, {{ auth()->user()->name }}</p>
</div>

<!-- My Assigned Projects -->
<div class="card">
    <h3>My Assigned Projects</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Start</th>
                <th>End</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td>{{ $project->title }}</td>
                <td>{{ ucfirst($project->status) }}</td>
                <td>{{ $project->start_date }}</td>
                <td>{{ $project->end_date }}</td>
                <td>
                    <a href="#" class="btn btn-sm">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No projects assigned to you.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Tasks Created By Me -->
<div class="card">
    <h3>Tasks I Created</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Task</th>
                <th>Project</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Review</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->project->title ?? '-' }}</td>
                <td>{{ $task->staff->name ?? '-' }}</td>
                <td>{{ ucfirst($task->status) }}</td>
                <td>{{ ucfirst($task->review_status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No tasks created by you.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Create Task -->
<div class="card">
    <h3>Create New Task</h3>
    <form method="POST" action="{{ route('admin.tasks.store') }}">
        @csrf

        <div class="form-group">
            <label>Project</label>
            <select name="project_id" class="form-control">
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Task Title</label>
            <input name="title" type="text" class="form-control" placeholder="Task title">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control">
        </div>

        <div class="form-group">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control">
        </div>

        <div class="form-group">
    <label>Assign To (Staff)</label>
    <select name="assigned_to" class="form-control">
        <option value="">-- Optional --</option>
        @foreach($staff as $member)
            <option value="{{ $member->id }}">{{ $member->name }}</option>
        @endforeach
    </select>
</div>


        <button class="btn btn-primary">Create Task</button>
    </form>
</div>

<!-- Staff Task Updates -->
<!-- Staff Task Updates -->
<div class="card">
    <h3>Staff Task Updates</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Task</th>
                <th>Staff</th>
                <th>Status</th>
                <th>Admin Action</th>
                        
                <th>Admin Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                @if($task->status === 'done' && $task->review_status === 'pending')
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->staff->name ?? '-' }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    
                    <td>
                        <form method="POST" action="{{ route('admin.tasks.approve', $task->id) }}" style="display:inline;">
                            @csrf
                            <button class="btn btn-success btn-sm">Validate</button>
                        </form></td>

                        <td><form method="POST" action="{{ route('admin.tasks.reject', $task->id) }}" style="display:inline;">
                            @csrf
                            <input type="text" name="note" placeholder="Reason" required class="form-control mb-1">
                    
                            <button class="btn btn-danger btn-sm">Rejecte</button>
                        </form>
                        

                    <td>
                       <!-- {{-- Admin note will appear here after review --}}
                        {{ $task->review_note ?? '-' }}-->
                    </td>
                </tr>
                @endif

                {{-- Already reviewed tasks --}}
                @if($task->review_status !== 'pending')
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->staff->name ?? '-' }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>{{ ucfirst($task->review_status) }}</td>
                    <td>{{ $task->review_note ?? '-' }}</td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<!-- Reports -->
<div class="card">
    <h3>Task Reports</h3>
    <p>Generate printable reports for tasks you created.</p>
    <a href="#" class="btn btn-secondary">Generate Report</a>
</div>
```

</div>
@endsection
