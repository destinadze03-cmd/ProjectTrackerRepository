<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Tasks</title>

    <style>
        body { margin:0; font-family:Arial; background:#0c2a57ff; }
        .container { display:flex; min-height:100vh; }
        .sidebar {
            width:260px; background:#d6c1c7ff; color:#060607ff;
            padding-top:20px; position:fixed; height:100%;
        }
        .sidebar h2 { text-align:center; margin-bottom:30px; font-weight:bold; }
        .sidebar a { padding:15px 25px; display:block; text-decoration:none; color:#060607ff; }
        .sidebar a:hover { background:#0f172a; color:white; }
        .main-content { margin-left:260px; padding:25px; width:100%; }
        .topbar {
            background:white; padding:18px 25px; border-radius:8px;
            box-shadow:0px 2px 5px rgba(0,0,0,0.1);
            display:flex; justify-content:space-between; margin-bottom:25px;
        }
        table { width:100%; border-collapse:collapse; background:white; border-radius:10px; overflow:hidden; }
        th, td { padding:12px; border-bottom:1px solid #ddd; }
        th { background:#0f172a; color:white; }
        .btn { padding:8px 12px; border-radius:6px; text-decoration:none; color:white; font-size:14px; }
        .btn-add { background:#10b981; }
        .btn-edit { background:#0ea5e9; }
    </style>
</head>

<body>

<div class="container">

    <div class="sidebar">
        <h2>Tasks</h2>

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('projects.index') }}">All Projects</a>
     

    <div class="main-content">
        
        <div class="topbar">
            <h2>Tasks for {{ $project->title }}</h2>
            <a href="{{ route('tasks.create', $project->id) }}" class="btn btn-add">+ New Task</a>
        </div>

        <table>
            <tr>
                <th>Title</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            @foreach ($project->tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->assigned_to ? $task->assignedTo->name : 'Not Assigned' }}</td>
                <td>{{ ucfirst($task->status) }}</td>

                <td>
                    <a href="" class="btn btn-edit">View</a>
                </td>
            </tr>
            @endforeach

        </table>

    </div>

</div>

</body>
</html>
