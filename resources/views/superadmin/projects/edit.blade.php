<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>

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
            margin-top: 0;
            text-align: center;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            color: #ddd;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #3b3c4a;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            flex-grow: 1;
        }

        .topbar {
            background: white;
            padding: 15px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        form input,
        form textarea,
        form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 5px;
        }

        form textarea {
            height: 120px;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            background: #007bff;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #006ad1;
        }

        .btn-gray {
            background: gray !important;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-left: 200px;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
            .main-content {
                margin-left: 0;
            }
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
        <a href="{{ route('superadmin.admins.index') }}">Manage Admins</a>
        
        <a href="{{ route('superadmin.projects.index') }}">Manage Projects</a>
        <a href="#">Reports</a>
        <a href="#"><button
    id="themeToggle"
    class="px-3 py-2 rounded border"
>
    🌙 Dark Mode
</button>
</a>
        <a><form action="{{ route('logout') }}" method="POST" style="padding:2px;">
            @csrf
            <button class="btn btn-delete">Logout</button>
        </form></a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="topbar">
            <h2>Edit Project</h2>
            <span>Today: <strong>{{ date('M d, Y') }}</strong></span>
        </div>

        <div class="card">
            <h3>Edit: {{ $project->title }}</h3>

            <form action="{{ route('superadmin.projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label>Project Title</label>
                <input type="text" name="title" value="{{ $project->title }}" required>

                <label>Description</label>
                <textarea name="description">{{ $project->description }}</textarea>

                <label>Client Name</label>
                <input type="text" name="client_name" value="{{ $project->client_name }}">

                <label>Start Date</label>
                <input type="date" name="start_date" value="{{ $project->start_date }}">

                <label>End Date</label>
                <input type="date" name="end_date" value="{{ $project->end_date }}">

                <label>Duration (days)</label>
                <input type="number" name="duration" value="{{ $project->duration }}">

                <label>Assign Admin</label>
                <select name="manager_id">
                    <option value="">Select Admin</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}" {{ $admin->id == $project->manager_id ? 'selected' : '' }}>
                            {{ $admin->name }}
                        </option>
                    @endforeach
                </select>

                <label>Status</label>
                <select name="status">
                    <option value="pending" {{ $project->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ $project->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>

                <button class="btn" type="submit">Update Project</button>
                <a href="{{ route('superadmin.projects.index') }}" class="btn btn-gray">Cancel</a>

            </form>
        </div>

    </div>
</div>

</body>
</html>
