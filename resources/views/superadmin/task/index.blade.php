<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SuperAdmin | All Tasks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, sans-serif;
        }

        body {
            background: #f4f6f9;
            color: #333;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #1e293b;
            color: #fff;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px 15px;
            margin-bottom: 8px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #334155;
            color: #fff;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 25px;
        }

        /* TOP BAR */
        .topbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            background: #e5e7eb;
            color: #111827;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
        }

        .back-btn:hover {
            background: #d1d5db;
        }

        .topbar-text h1 {
            font-size: 26px;
        }

        .topbar-text p {
            font-size: 14px;
            color: #6b7280;
        }

        /* CARD */
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .card-header {
            padding: 18px 22px;
            border-bottom: 1px solid #e5e7eb;
        }

        .card-body {
            padding: 20px;
            overflow-x: auto;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        thead {
            background: #f1f5f9;
        }

        th, td {
            padding: 12px 10px;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            font-weight: 600;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        /* BADGES */
        .badge {
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 999px;
        }

        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-completed { background: #d1e7dd; color: #0f5132; }
        .badge-review { background: #e7f3ff; color: #0b5ed7; }
        .badge-validated { background: #dcfce7; color: #166534; }

        /* BUTTONS */
        .btn {
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 6px;
            text-decoration: none;
            color: #fff;
            margin-right: 5px;
            display: inline-block;
        }

        .btn-view { background: #2563eb; }
        .btn-track { background: #6b7280; }

        footer {
            margin-top: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 13px;
        }

        /* RESPONSIVENESS */
        @media (max-width: 1024px) {
            table { min-width: 700px; }
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { padding: 15px; }
            table { min-width: 600px; }
        }

        @media (max-width: 480px) {
            .topbar { flex-direction: column; align-items: flex-start; }
            .topbar-text h1 { font-size: 20px; }
            .topbar-text p { font-size: 12px; }
            table { min-width: 400px; font-size: 12px; }
        }
    </style>
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>SuperAdmin</h2>
        <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        <a href="{{ route('superadmin.projects.projectpage') }}">Projects</a>
        <a href="{{ route('superadmin.task.index') }}">Tasks</a>
        <a href="{{ route('superadmin.staff.staffpage') }}" class="active">Staff</a>
        <a href="{{ route('superadmin.admins.index') }}">Admins</a>
        <a href="#">Reports</a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOP BAR -->
        <div class="topbar">
            <a href="javascript:history.back()" class="back-btn">← Back</a>
            <div class="topbar-text">
                <h1>All Tasks</h1>
                <p>Overview of all tasks across all projects</p>
            </div>
        </div>

        <!-- TASK TABLE -->
        <div class="card">
            <div class="card-header">
                <h3>Tasks List</h3>
            </div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task Title</th>
                            <th>Project</th>
                            <th>Project Manager</th>
                            <th>Assigned Staff</th>
                            <th>Status</th>
                            <th>Review Status</th>
                            <th>Progress</th>
                            <th>View</th>
                            <th>Track</th>
                        </tr>
                    </thead>
                    <tbody>
@forelse($tasks as $task)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $task->title }}</td>
    <td>{{ $task->project->title ?? '-' }}</td>
    <td>{{ $task->project->manager->name ?? '-' }}</td>
    <td>{{ $task->assignedStaff->name ?? '-' }}</td>
    <td>{{ ucfirst($task->status) }}</td>
    <td>{{ ucfirst($task->review_status) }}</td>
    <td>{{ $task->progress ?? 50 }}%</td>
     <td><a href="#" class="btn btn-view">View</a></td>
                            <td><a href="#" class="btn btn-track">Track</a></td>
</tr>
@empty
<tr>
    <td colspan="8" style="text-align:center;">No tasks found</td>
</tr>
@endforelse
</tbody>

                </table>
            </div>
        </div>

        <footer>
            © 2025 Project Tracker System — SuperAdmin Panel
        </footer>

    </main>

</div>

</body>
</html>
