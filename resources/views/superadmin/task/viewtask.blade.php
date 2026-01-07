<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Task - Super Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #1e1f29;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            color: #ddd;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #3b3c4a;
        }

        /* Main */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            flex-grow: 1;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        .row {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        .value {
            margin-top: 5px;
            color: #222;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 13px;
            display: inline-block;
        }

        .pending { background: #ffc107; color: #000; }
        .in_progress { background: #17a2b8; color: #fff; }
        .completed { background: #28a745; color: #fff; }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
        }

        .btn:hover {
            background: #005fc5;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Super Admin</h2>
        <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        <a href="{{ route('superadmin.projects.index') }}">Manage Projects</a>
        <a href="{{ route('superadmin.task.index') }}">Manage Tasks</a>
        <a href="{{ route('superadmin.staff.staffpage') }}">Manage Staff</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="card">
            <h2>Task Details</h2>


            <div class="row">
                <div class="label">Project</div>
                <div class="value">{{ $task->project->title ?? '-' }}</div>
            </div>
            
            <div class="row">
                <div class="label">Task Title</div>
                <div class="value">{{ $task->title }}</div>
            </div>

            

            <div class="row">
                <div class="label">Assigned Staff</div>
                <div class="value">{{ $task->assignedStaff->name ?? '-' }}</div>
            </div>

            <div class="row">
                <div class="label">Supervisor (Admin)</div>
                <div class="value">{{ $task->supervisor->name ?? 'N/A' }}</div>
            </div>

            <div class="row">
                <div class="label">Description</div>
                <div class="value">{{ $task->description ?? 'No description' }}</div>
            </div>

            <div class="row">
                <div class="label">Start Date</div>
                <div class="value">{{ $task->start_date }}</div>
            </div>

            <div class="row">
                <div class="label">End Date</div>
                <div class="value">{{ $task->end_date }}</div>
            </div>

            <div class="row">
                <div class="label">Status</div>
                <div class="value">
                    <span class="badge {{ $task->status }}">
                        {{ ucfirst(str_replace('_',' ', $task->status)) }}
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="label">Progress</div>
                <div class="value">{{ $task->progress ?? 0 }}%</div>
            </div>

            <a href="{{ route('superadmin.task.index') }}" class="btn">
                ← Back to Tasks
            </a>
        </div>
    </div>

</div>

</body>
</html>
