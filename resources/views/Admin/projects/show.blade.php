<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>

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

        .btn-add    { background: #10b981; color:white; }
        .btn-edit   { background: #0ea5e9; color:white; }
        .btn-delete { background: #ef4444; color:white; }
    </style>
</head>

<body>

<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Projects</h2>

        <a href="{{ route('admin.dashboard') }}">Home</a>
        <a href="{{ route('projects.index') }}">All Projects</a>
        <a href="{{ route('projects.create') }}">Create Project</a>
        
        <form action="{{ route('logout') }}" method="POST" style="padding:20px;">
            @csrf
            <button class="btn btn-delete" style="width:100%;">Logout</button>
        </form>
    </div>

    <!-- Main content -->
    <div class="main-content">

        <div class="topbar">
            <h2>Project Details</h2>
            <span>Today: <strong>{{ date('M d, Y') }}</strong></span>
        </div>

        <div class="card">
            <h2>{{ $project->title }}</h2>

            <p><strong>Client:</strong>
                {{ $project->client ? $project->client->name : 'No Client Assigned' }}
            </p>

            <p><strong>Description:</strong><br>
                {{ $project->description ?? 'No description provided.' }}
            </p>

            <p><strong>Start Date:</strong>
    {{ $project->start_date ?? 'Not set' }}
</p>


            <p><strong>End Date:</strong>
    {{ $project->end_date ?? 'Not set' }}
</p>



            <!-- Action Buttons -->
<div style="margin-top: 20px;">

    <!-- Create Task -->
    <a href="{{ route('tasks.create', $project->id) }}" 
       class="btn btn-add" 
       style="margin-right:10px;">
        + Create Task for This Project
    </a>

    <!-- Edit Project -->
    <a href="{{ route('projects.edit', $project->id) }}" 
       class="btn btn-edit" 
       style="margin-right:10px;">
        Edit Project
    </a>

    <!-- Back -->
    <a href="{{ route('projects.index') }}" 
       class="btn btn-delete">
        Back
    </a>

