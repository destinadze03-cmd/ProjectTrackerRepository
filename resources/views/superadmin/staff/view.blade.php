<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $staff->name }} - Staff Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        /* Sidebar */
        .sidebar {
            width: 220px;
            background: #2c3e50;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar a {
            text-decoration: none;
            color: #fff;
            padding: 12px 20px;
            display: block;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background: #34495e;
        }
        /* Main Content */
        .main {
            flex: 1;
            padding: 20px;
        }
        .topbar {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .back-btn {
            text-decoration: none;
            color: #555;
            margin-right: 15px;
            font-size: 18px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 20px;
            overflow: hidden;
            background: #fff;
        }
        .card-header {
            background: #007bff;
            color: #fff;
            padding: 15px;
        }
        .card-body {
            padding: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .btn-view {
            padding: 6px 12px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        footer {
            margin-top: 40px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Dashboard</h2>
            <a href="{{ route('superadmin.dashboard') }}">Home</a>
            <a href="{{ route('superadmin.staff.staffpage') }}">Staff</a>
            <a href="{{ route('superadmin.projects.index') }}">Projects</a>
            <a href="{{ route('superadmin.task.index') }}">Tasks</a>
            <a href="">Logout</a>
        </div>

        <!-- Main Content -->
        <div class="main">
            <div class="topbar">
                <a href="{{ route('superadmin.staff.staffpage') }}" class="back-btn">← Back</a>
                <h2>{{ $staff->name }} Details</h2>
            </div>

            <!-- Staff Info Card -->
            <div class="card">
                <div class="card-header"><h3>Staff Info</h3> </div>
                <div class="card-body">
                    <p><strong>Name:</strong> {{ $staff->name }}</p>
                    <p><strong>Email:</strong> {{ $staff->email }}</p>
                    <p><strong>Assigned Projects:</strong>
                        @if($staff->projects->count() > 0)
                            {{ $staff->projects->pluck('name')->join(', ') }}
                        @else
                            None
                        @endif
                    </p>
                    <p><strong>Total Tasks:</strong> {{ $staff->assignedTasks->count() }}</p>
                </div>
            </div>

            <!-- Staff Tasks Table -->
            <div class="card">
                <div class="card-header"><h3>Assigned Tasks</h3></div>
                <div class="card-body">
                    @if($staff->assignedTasks->count() > 0)
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project</th>
                                    <th>Task Title</th>
                                    <th>Assigned By (Admin)</th>
                                    <th>Status</th>
                                    <th>Review Status</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staff->assignedTasks as $index => $task)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $task->project->name ?? 'N/A' }}</td>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->assignedBy->name ?? 'N/A' }}</td>
                                        <td>{{ ucfirst($task->status) }}</td>
                                        <td>{{ ucfirst($task->review_status ?? 'N/A') }}</td>
                                        <td>{{ $task->start_date ?? 'N/A' }}</td>
                                        <td>{{ $task->end_date ?? 'N/A' }}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No tasks assigned to this staff member yet.</p>
                    @endif
                </div>
            </div>

            <footer>© 2025 Project Tracker System — SuperAdmin Panel</footer>
        </div>
    </div>
</body>
</html>
