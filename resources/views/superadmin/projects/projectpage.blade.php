<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SuperAdmin | Projects</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        *{margin:0;padding:0;box-sizing:border-box;font-family:Segoe UI,Tahoma,sans-serif}
        body{background:#f4f6f9;color:#333}
        .wrapper{display:flex;min-height:100vh}

        .sidebar{
            width:220px;background:#1e293b;color:#fff;padding:20px
        }
        .sidebar h2{text-align:center;margin-bottom:30px}
        .sidebar a{
            display:block;padding:12px 15px;margin-bottom:8px;
            color:#cbd5e1;text-decoration:none;border-radius:6px
        }
        .sidebar a:hover,.sidebar a.active{background:#334155;color:#fff}

        .main-content{flex:1;padding:25px}

        .topbar{
            display:flex;align-items:center;gap:15px;margin-bottom:20px
        }
        .back-btn{
            padding:6px 12px;background:#e5e7eb;color:#111827;
            border-radius:6px;text-decoration:none;font-size:14px
        }

        .card{
            background:#fff;border-radius:8px;
            box-shadow:0 3px 10px rgba(0,0,0,.05)
        }
        .card-header{
            padding:15px 20px;border-bottom:1px solid #eee
        }
        .card-body{padding:20px;overflow-x:auto}

        table{
            width:100%;border-collapse:collapse;min-width:1000px
        }
        thead{background:#f1f5f9}
        th,td{
            padding:12px 10px;font-size:14px;
            border-bottom:1px solid #eee;text-align:left
        }
        tbody tr:hover{background:#f9fafb}

        .btn-create{
            padding:6px 12px;background:#0d6efd;color:#fff;
            border-radius:6px;text-decoration:none;font-size:13px
        }

        footer{
            margin-top:20px;text-align:center;color:#6b7280;font-size:13px
        }

        @media(max-width:768px){
            .sidebar{display:none}
            table{min-width:100%}
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>SuperAdmin</h2>
        <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        <a href="{{ route('superadmin.projects.index') }}" class="active">Projects</a>
        <a href="{{ route('superadmin.task.index') }}">Tasks</a>
        <a href="{{ route('superadmin.admins.index') }}">Admins</a>
        <a href="{{ route('superadmin.staff.staffpage') }}">Staff</a>
        <a href="#">Reports</a>
        <a href="#"><button
    id="themeToggle"
    class="px-3 py-2 rounded border"
>
    🌙 Dark Mode
</button></a>
<li><form action="{{ route('logout') }}" method="POST" style="padding:2px;">
            @csrf
            <button class="btn btn-delete">Logout</button>
        </form></li>
    </aside>

    <!-- MAIN -->
    <main class="main-content">

        <div class="topbar">
            <a href="javascript:history.back()" class="back-btn">← Back</a>
            <h2>All Projects</h2>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Projects List</h3>
            </div>

            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Project</th>
                            <th>Manager</th>
                            <th>Created By</th>
                            <th>Client</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Total Tasks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $index => $project)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->manager->name ?? 'N/A' }}</td>
                                <td>{{ $project->creator->name ?? 'N/A' }}</td>
                                <td>{{ $project->client->name ?? 'N/A' }}</td>
                                <td>{{ $project->start_date ?? 'N/A' }}</td>
                                <td>{{ $project->end_date ?? 'N/A' }}</td>
                                <td>{{ $project->tasks->count() }}</td>
                                <td>
                                    <a href="{{ route('superadmin.tasks.create', $project->id) }}"
                                       class="btn-create">
                                        + Create Task
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">No projects found.</td>
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
