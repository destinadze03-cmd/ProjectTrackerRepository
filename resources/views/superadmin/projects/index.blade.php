<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin - Manage Projects</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f4f4;
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: #1A237E;
            color: #fff;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 25px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 12px 10px;
            margin-bottom: 10px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .sidebar ul li:hover {
            background: rgba(255,255,255,0.3);
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
        }

        /* MAIN CONTENT */
        .main-conten {
            margin-left: 260px;
            padding: 20px;
            width: calc(100% - 260px);
        }

        .topbar {
            background: #fff;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .topbar h2 {
            margin: 0;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .card h3 {
            margin-top: 0;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        .btn {
            padding: 8px 15px;
            background: #1A237E;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background: #283593;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        table thead {
            background: #f2f2f2;
        }

        .btn-action {
            display: inline-block;
            margin-right: 5px;
            margin-bottom: 5px;
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
        }

        .btn-view { background: #4CAF50; }
        .btn-edit { background: #2196F3; }
        .btn-report { background: #FF9800; }
        .btn-delete { background: red; border: none; cursor: pointer; }

        /* Responsive */
        @media(max-width: 900px) {
            .main-conten {
                margin-left: 220px;
                width: calc(100% - 220px);
            }
        }

        @media(max-width: 600px) {
            .main-conten {
                margin-left: 0;
                width: 100%;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Super Admin</h2>
        <ul>
            <li><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('superadmin.admins.index') }}">Manage Admins</a></li>
          
            <li><a href="{{ route('superadmin.projects.index') }}">Projects</a></li>
            <li><a href="#">Tasks</a></li>
            <li><a href="#">Settings</a></li>

            <li><form action="{{ route('logout') }}" method="POST" style="padding:2px;">
            @csrf
            <button class="btn btn-delete">Logout</button>
        </form></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-conten">

        <div class="topbar">
            <h2>Manage Projects</h2>
            <span>Today: <strong>{{ date('M d, Y') }}</strong></span>
        </div>

        @if(session('success'))
            <div style="background:#c8e6c9;padding:10px;border-radius:6px;margin-bottom:10px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background:#ffcdd2;padding:10px;border-radius:6px;margin-bottom:10px;">
                {{ session('error') }}
            </div>
        @endif

        <!-- CREATE PROJECT FORM -->
        <div class="card">
            <h3>Create New Project</h3>
            <form action="{{ route('superadmin.projects.store') }}" method="POST">
                @csrf
                <label>Project Title:</label>
                <input type="text" name="title" required>

                <label>Description:</label>
                <textarea name="description"></textarea>

                <label>Client Name:</label>
                <input type="text" name="client_name">

                <label>Start Date:</label>
                <input type="date" name="start_date">

                <label>End Date:</label>
                <input type="date" name="end_date">

                <label>Duration (days):</label>
                <input type="number" name="duration">

                <label>Assign Admin:</label>
                <select name="manager_id">
                    <option value="">Select Admin</option>
                    
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @endforeach
                </select>

                <label>Status:</label>
                <select name="status">
                    <option value="pending">Pending</option>
                    <option value="active">Active</option>
                    <option value="completed">Completed</option>
                </select>

                <button type="submit" class="btn">Create Project</button>
            </form>
        </div>

        <!-- PROJECT LIST -->
        <div class="card">
            <h3>All Projects</h3>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Client</th>
                        <th>Admin</th>
                        <th>Duration</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                        <th>Actions</th>
                        <th>Actions</th>
                        <th>Actions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $p)
                    <tr>
                        <td>{{ $p->title }}</td>
                        <td>{{ $p->description }}</td>
                        <td>{{ $p->client_name ?? ($p->client->name ?? '-') }}</td>
                        <td>{{ $p->manager->name ?? '-' }}</td>
                        <td>{{ $p->duration ?? '-' }} days</td>
                        <td>{{ $p->start_date ?? '-' }}</td>
                        <td>{{ $p->end_date ?? '-' }}</td>
                        <td>{{ ucfirst($p->status) }}</td>
                        <td><a class="btn-action btn-view" href="{{ route('superadmin.projects.show', $p->id) }}">View</a></td>
                           <td> <a class="btn-action btn-edit" href="{{ route('superadmin.projects.edit', $p->id) }}">Edit</a></td>
                           <td> <a class="btn-action btn-report" href="{{ route('superadmin.projects.report', $p->id) }}">Report</a></td>
                           <td> <form action="{{ route('superadmin.projects.delete', $p->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>
