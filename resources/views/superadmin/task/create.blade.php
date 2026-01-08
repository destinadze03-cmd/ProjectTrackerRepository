<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Task - Super Admin</title>
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
            color: #fff;
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
            background: white;
            padding: 25px;
            border-radius: 10px;
            max-width: 850px;
            margin: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        h1, h2 {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        .row {
            display: flex;
            gap: 15px;
        }

        .row > div {
            flex: 1;
        }

        .btn {
            margin-top: 20px;
            background: #007bff;
            color: white;
            padding: 12px 18px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #005fc5;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Super Admin</h2>
        <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        <a href="{{ route('superadmin.projects.index') }}">Projects</a>
        <a href="{{ route('superadmin.task.index') }}">Tasks</a>
        <a href="{{ route('superadmin.staff.staffpage') }}">Staff</a>
    </div>

    <!-- MAIN -->
    <div class="main-content">
        <div class="card">

            <!-- Project Name -->
            <h1>Create Task for Project: {{ $project->title }}</h1>
            <!--<h2>{{ $project->title }}</h2>-->

            @if(session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('superadmin.tasks.store', $project->id) }}">
                @csrf

                <label>Task Title</label>
                <input type="text" name="title" required>

                <label>Description</label>
                <textarea name="description"></textarea>

                <div class="row">
                    <div>
                        <label>Start Date</label>
                        <input type="date" name="start_date" required>
                    </div>
                    <div>
                        <label>End Date</label>
                        <input type="date" name="end_date" required>
                    </div>
                </div>

                <label>Assign Staff</label>
                <select name="assigned_to" required>
                    <option value="">Select Staff</option>
                    @foreach($staff as $member)
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endforeach
                </select>

                <label>Assign Admin Supervisor</label>
                <select name="supervised_by" required>
                    <option value="">Select Admin</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @endforeach
                </select>

                <label>Status</label>
                <select name="status">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>

                <button type="submit" class="btn">
                    Create Task
                </button>
            </form>

        </div>
    </div>

</div>

</body>
</html>
