<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #0c2a57ff;
        }

        .container { display: flex; min-height: 100vh; }

        .sidebar {
            width: 260px;
            background: #d6c1c7ff;
            color: #060607ff;
            padding-top: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 15px 25px;
            text-decoration: none;
            font-size: 16px;
            color: #060607ff;
        }

        .sidebar a:hover {
            background: #0f172a;
            color: white;
        }

        .main-content {
            margin-left: 260px;
            padding: 25px;
            width: 100%;
        }

        .topbar {
            background: white;
            padding: 18px 25px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
        }

        .card {
            background:white;
            padding:20px;
            border-radius:12px;
            box-shadow:0px 3px 6px rgba(0,0,0,0.1);
            margin-bottom:25px;
            width: 100%;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-save   { background: #10b981; color:white; }
        .btn-back   { background: #ef4444; color:white; }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        label { font-weight:bold; }
    </style>
</head>

<body>

<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Tasks</h2>

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('projects.index') }}">All Projects</a>
        <a href="{{ route('projects.show', $project->id) }}">Back to Project</a>

        <form action="{{ route('logout') }}" method="POST" style="padding:20px;">
            @csrf
            <button class="btn btn-back" style="width:100%;">Logout</button>
        </form>
    </div>

    <!-- Main content -->
    <div class="main-content">

        <div class="topbar">
            <h2>Create Task</h2>
            <span>Project: <strong>{{ $project->title }}</strong></span>
        </div>

        <div class="card">
            <form action="{{ route('tasks.store', $project->id) }}" method="POST">
    @csrf


                <input type="hidden" name="project_id" value="{{ $project->id }}">

                <label>Task Title</label>
                <input type="text" name="title" required>

                <label>Description</label>
                <textarea name="description" rows="4"></textarea>

                <label>Duration (Days)</label>
                <input type="number" name="duration">

                <label>Start Date</label>
                <input type="date" name="start_date">

                <label>End Date</label>
                <input type="date" name="end_date">

                <label>Assign To (Staff)</label>
                <select name="assigned_to">
                    <option value="">-- Select Staff --</option>
                    @foreach ($staff as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </select>

                <label>Status</label>
                <select name="status">
                    <option value="pending">Pending</option>
                    <option value="in-progress">In Progress</option>
                    <option value="done">Done</option>
                </select>

                <button class="btn btn-save" type="submit">Save Task</button>
                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-back">Cancel</a>

            </form>
        </div>

    </div>
</div>

</body>
</html>
