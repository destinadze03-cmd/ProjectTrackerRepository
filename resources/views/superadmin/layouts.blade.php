<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin Panel</title>

    <style>
        /* GLOBAL RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #EEF1F6;
            display: flex;
            height: 100vh;
            overflow-x: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #1A237E;
            color: #fff;
            padding: 25px 20px;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            overflow-y: auto;
            transition: 0.3s ease-in-out;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .menu-item {
            margin-bottom: 10px;
        }

        .menu-item a {
            text-decoration: none;
            padding: 12px 15px;
            display: block;
            color: #fff;
            font-size: 15px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .menu-item a:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateX(5px);
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            padding: 25px;
            width: calc(100% - 260px);
            transition: 0.3s;
        }

        /* TOPBAR */
        .topbar {
            background: #fff;
            padding: 18px 22px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.06);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar h1 {
            font-size: 22px;
            color: #1A237E;
            font-weight: bold;
        }

        /* CARDS */
        .card {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.07);
        }

        .card h3 {
            margin-bottom: 15px;
        }

        /* FORM ELEMENTS */
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 12px;
            font-size: 14px;
        }

        /* BUTTONS */
        .btn {
            padding: 10px 15px;
            background: #1A237E;
            color: white;
            border-radius: 6px;
            display: inline-block;
            cursor: pointer;
            border: none;
            transition: 0.2s;
            font-size: 14px;
            text-decoration: none;
        }

        .btn:hover {
            background: #283593;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #D32F2F;
        }

        .btn-danger:hover {
            background: #B71C1C;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        table th {
            background: #f5f5f5;
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        table td {
            padding: 10px;
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
        }

        .btn-action {
            padding: 6px 10px;
            border-radius: 4px;
            color: white;
            font-size: 12px;
            text-decoration: none;
            display: inline-block;
            margin-right: 4px;
        }

        .btn-view { background: #4CAF50; }
        .btn-edit { background: #2196F3; }
        .btn-report { background: #FF9800; }

        /* MOBILE RESPONSIVENESS */
        @media(max-width: 900px) {
            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .sidebar {
                transform: translateX(-260px);
                position: absolute;
                z-index: 1000;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .menu-toggle {
                display: inline-block;
                font-size: 24px;
                cursor: pointer;
                color: #1A237E;
            }
        }
    </style>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>SuperAdmin</h2>

        <div class="menu-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></div>
        <div class="menu-item"><a href="{{ route('superadmin.admins.index') }}">Manage Admins</a></div>
        <div class="menu-item"><a href="{{ route('superadmin.projects.index') }}">Projects</a></div>
        <div class="menu-item"><a href="{{ route('superadmin.task.index') }}">Tasks</a></div>
        <div class="menu-item"><a href="#">Settings</a></div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger" style="width:100%; margin-top:20px;">Logout</button>
        </form>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="topbar">
            <span class="menu-toggle" onclick="toggleSidebar()">☰</span>
            <h1>@yield('title', 'SuperAdmin Dashboard')</h1>
            <span>{{ date('M d, Y') }}</span>
        </div>

        @yield('content')

    </div>

</body>
</html>
