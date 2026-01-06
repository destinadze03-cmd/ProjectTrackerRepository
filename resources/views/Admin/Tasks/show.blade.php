<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>

    <style>
        body { margin:0; background:#0c2a57ff; font-family:Arial; }
        .container { display:flex; min-height:100vh; }
        .sidebar {
            width:260px; background:#d6c1c7ff; position:fixed; height:100%;
            padding-top:20px; color:black;
        }
        .sidebar h2 { text-align:center; }
        .sidebar a { display:block; padding:15px 25px; color:black; text-decoration:none; }
        .sidebar a:hover { background:#0f172a; color:white; }
        .main-content { margin-left:260px; padding:25px; width:100%; }
        .topbar { background:white; padding:18px 25px; border-radius:8px; margin-bottom:25px; display:flex; justify-content:space-between; }
        .card { background:white; padding:20px; border-radius:12px; margin-bottom:20px; }
        .btn { padding:8px 15px; border-radius:6px; text-decoration:none; color:white; }
        .btn-back { background:#ef4444; }
    </style>
</head>

<body>

<div class="container">

    <div class="sidebar">
        <h2>Task</h2>

        <a href="{{ route('projects.show', $task->project_id) }}">Back to Project</a>
        <a href="{{ route('projects.index') }}">All Projects</a>
    </div>

    <div class="main-content">

        <div class="topbar">
            <h2>Task: {{ $task->title }}</h2>
            <a class="btn btn-back" href="{{ route('projects.show', $task->project_id) }}">Back</a>
        </div>

        <div class="card">
            <h3>Task Details</h3>

            <p><strong>Description:</strong><br>{{ $task->description }}</p>
            <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
            <p><strong>Assigned To:</strong> {{ $task->assigned_to ? $task->assignedTo->name : 'Not Assigned' }}</p>
            <p><strong>Start Date:</strong> {{ $task->start_date }}</p>
            <p><strong>End Date:</strong> {{ $task->end_date }}</p>
        </div>

        <div class="card">
            <h3>Progress Updates</h3>

            @foreach ($task->updates as $update)
                <p>
                    <strong>{{ $update->created_at->format('M d, Y') }}</strong><br>
                    Status: {{ ucfirst($update->status) }}<br>
                    Note: {{ $update->note }}<br>
                    By: {{ $update->user->name }}
                </p>
                <hr>
            @endforeach
        </div>

    </div>

</div>

</body>
</html>
