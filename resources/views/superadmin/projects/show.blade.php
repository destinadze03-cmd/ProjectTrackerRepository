<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>

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

        .sidebar {
            width: 250px;
            background: #1A237E;
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
            background: rgba(255,255,255,0.3);
        }

        .main-content {
            margin-left: 250px;
            padding: 30px;
            width: 100%;
        }

        .topbar {
            background: white;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }

        .btn {
            background: #007bff;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #006ad1;
        }


        .btn:disabled {
    background: #9ca3af;
    cursor: not-allowed;
    opacity: 0.7;
}

    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Super Admin</h2>
         <div class="menu-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></div>
        <div class="menu-item"><a href="{{ route('superadmin.admins.index') }}">Manage Admins</a></div>
        <div class="menu-item"><a href="{{ route('superadmin.projects.index') }}">Projects</a></div>
        <div class="menu-item"><a href="{{ route('superadmin.task.index') }}">Tasks</a></div>
        <div class="menu-item"><a href="#">Settings</a></div>


        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn" style="width:100%; margin-top:15px;">Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <div class="topbar">
            <a href="{{ route('superadmin.projects.index') }}" class="btn">Back</a>
            <h2>Project Details</h2>
            <span>{{ date('M d, Y') }}</span>
        </div>

        <!-- PROJECT DETAILS -->
        <div class="card">
            <h3>{{ $project->title }}</h3>

            <p><strong>Description:</strong><br>{{ $project->description }}</p>

            <p><strong>Client:</strong>
                {{ $project->client_name ?? ($project->client->name ?? '-') }}
            </p>

            <p><strong>Assigned Admin:</strong>
                {{ $project->manager->name ?? '-' }}
            </p>

            <p><strong>Duration:</strong> {{ $project->duration }} days</p>
            <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
            <p><strong>End Date:</strong> {{ $project->end_date }}</p>

            <p><strong>Status:</strong>
                <span style="
                    font-weight:bold;
                    color: {{ $project->status === 'approved' ? 'green' :
                             ($project->status === 'rejected' ? 'red' : 'blue') }};
                ">
                    {{ ucfirst($project->status) }}
                </span>
            </p>

            
        </div>

        <!-- TASKS -->
        <div class="card">
            <h3>Tasks Under This Project</h3>

            <table width="100%" border="1" cellpadding="10">
                <thead style="background:#006ad1;">
                    <tr>
                        <th>#</th>
                        <th>Task Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Assigned To</th>
                        <th>project manager</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($project->tasks as $task)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td>{{ $task->assignedTo->email ?? '-' }}</td>
                        <td>{{ $task->supervisor->email ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" align="center">No tasks created</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

  
       <!-- APPROVE / REJECT -->
<div class="card" style="text-align:center;">

    <form action="{{ route('superadmin.projects.approve', $project->id) }}"
          method="POST" style="display:inline-block;">
        @csrf
        <button
            class="btn"
            style="background:green;"
            {{ $project->status !== 'submitted' ? 'disabled' : '' }}>
            Approve Project
        </button>
    </form>

    <form action="{{ route('superadmin.projects.reject', $project->id) }}"
          method="POST" style="display:inline-block; margin-left:15px;">
        @csrf
        <button
            class="btn"
            style="background:red;"
            {{ $project->status !== 'submitted' ? 'disabled' : '' }}>
            Reject Project
        </button>
    </form>

</div>

    </div>
</div>

</body>
</html>
