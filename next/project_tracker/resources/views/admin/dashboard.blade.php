<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <style>
        body {
            font-family: Arial;
            background: #f0f2f5;
            padding: 20px;
        }
        .container {
            max-width: 1100px;
            margin: auto;
        }
        .header {
            background: #2c3e50;
            padding: 20px;
            color: #fff;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .cards {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            flex: 1;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            text-align: center;
        }

        .btn {
            background: #3498db;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
        }

        .project-list {
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th, table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background: #ecf0f1;
            text-align: left;
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 13px;
        }
        .view-btn {
            background: #27ae60;
        }
        .task-btn {
            background: #8e44ad;
        }
    </style>

</head>
<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <h2>Admin Dashboard</h2>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="
                background:red; 
                color:white; 
                border:none; 
                padding:8px 12px; 
                border-radius:5px;">
                Logout
            </button>
        </form>
    </div>

    <!-- STAT CARDS -->
    <div class="cards">
        <div class="card">
            <h3>Total Projects</h3>
            <p>{{ $totalProjects }}</p>
        </div>
        <div class="card">
            <h3>Total Staff</h3>
            <p>{{ $totalStaff }}</p>
        </div>
        <div class="card">
            <h3>Pending Tasks</h3>
            <p>{{ $pendingTasks }}</p>
        </div>
    </div>

    <!-- PROJECT MANAGEMENT -->
    <div class="project-list">
        <h2>All Projects</h2>

        <a href="{{ route('admin.projects.create') }}" class="btn">+ Create New Project</a>

        <table>
            <thead>
                <tr>
                    <th>Project Title</th>
                    <th>Description</th>
                    <th>Tasks</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->tasks->count() }}</td>

                    <td>
                        <a href="{{ route('admin.projects.show', $project->id) }}" class="action-btn view-btn">View</a>

                        <a href="{{ route('admin.tasks.create', $project->id) }}" class="action-btn task-btn">
    + Add Task
</a>

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

</body>
</html>
