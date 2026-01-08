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

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #1A237E;
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
            background: rgba(255,255,255,0.3);
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

        p {
            margin: 8px 0;
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

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Super Admin</h2>
        <a href="#">Dashboard</a>
        <a href="#">Manage Admins</a>
        <a href="#">Manage Clients</a>
        <a href="#">Manage Projects</a>
        <a href="#">Reports</a>
        <a href="#"><button id="themeToggle" class="px-3 py-2 rounded border"> 🌙 Dark Mode</button></a>
        <form action="{{ route('logout') }}" method="POST" style="padding:2px;">
            @csrf
            <button class="btn btn-delete">Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <h2>Project Details</h2>
            <span>Today: <strong>{{ date('M d, Y') }}</strong></span>
        </div>

        <div class="card">
            <h3>{{ $project->title }}</h3>

            <p><strong>Description:</strong><br>
                {{ $project->description }}
            </p>

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
                <span style="color:blue; font-weight:bold;">{{ ucfirst($project->status) }}</span>
            </p>

            <a href="{{ route('superadmin.projects.index') }}" class="btn">Back</a>
        </div>
    </div>

</div>
</body>
</html>
