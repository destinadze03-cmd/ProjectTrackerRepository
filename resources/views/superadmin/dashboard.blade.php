<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>

    <style>
        body {
            margin: 0;
            padding: 0;
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
            left: 0;
            top: 0;
        }

        .sidebar h2 {
            margin-top: 0;
            font-size: 22px;
            margin-bottom: 25px;
            text-align: center;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .sidebar ul li {
            padding: 12px 10px;
            margin-bottom: 10px;
            background: rgba(255,255,255,0.1);
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        .sidebar ul li:hover {
            background: rgba(255,255,255,0.3);
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

        /* CARDS */
        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: 0.3s;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }

        .card h3 {
            margin: 0;
            font-size: 32px;
            color: #1A237E;
        }

        .card p {
            margin-top: 8px;
            font-size: 15px;
            font-weight: bold;
        }

        /* RESPONSIVE */
        @media(max-width: 900px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 600px) {
            .cards {
                grid-template-columns: 1fr;
            }
            .sidebar {
                width: 200px;
            }
            .main-conten {
                margin-left: 210px;
            }
            
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Super Admin</h2>

        <ul>
            <li>Dashboard</li>
            <li>
    <a href="{{ route('superadmin.admins.index') }}" style="text-decoration: none; color: inherit;">
        Manage Admins
    </a>
</li>
            
            <li>
    <a href="{{ route('superadmin.projects.index') }}" style="text-decoration: none; color: inherit;">
        Projects
    </a>
</li>
            <li>Tasks</li>
            <li><button
    id="themeToggle"
    class="px-3 py-2 rounded border"
>
    🌙 Dark Mode
</button>
</li>
            <li><form action="{{ route('logout') }}" method="POST" style="padding:2px;">
            @csrf
            <button class="btn btn-delete">Logout</button>
        </form></li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-conten">

        <div class="topbar">
            <h2>Welcome, Super Admin</h2>
            <span>Today: <strong>{{ date('M d, Y') }}</strong></span>
        </div>

        <div class="cards">

            <a href="{{ route('superadmin.admins.adminpage') }}" class="card-link">
                <div class="card">
                    <h3>{{ $totalAdmins }}</h3>
                    <p>Total Admins</p>
                </div>
            </a>

            <a href="{{ route('superadmin.staff.staffpage') }}" class="card-link">
                <div class="card">
                    <h3>{{ $totalStaff }}</h3>
                    <p>Total Staff</p>
                </div>
            </a>

            <a href="{{ route('superadmin.projects.projectpage') }}" class="card-link">
                <div class="card">
                    <h3>{{ $totalProjects }}</h3>
                    <p>Total Projects</p>
                </div>
            </a>



            <a href="{{ route('superadmin.task.index') }}" class="card-link">
                <div class="card">
                    <h3>{{ $TotalTasks }}</h3>
                    <p>Total Tasks</p>
                </div>
            </a>

            
            
            <a href="{{ route('superadmin.task.submittedtask') }}" class="card-link">
                <div class="card">
                    <h3>{{ $submittedTasks }}</h3>
                    <p>Submitted Tasks</p>
                </div>
            </a>


            <a href="{{ route('superadmin.task.validatedtasks') }}" class="card-link">
                <div class="card">
                    <h3>{{ $ValidatedTasks }}</h3>
                    <p>ValidatedTasks</p>
                </div>
            </a>



            <a href="{{ route('superadmin.task.completedtask') }}" class="card-link">
                <div class="card">
                    <h3>{{ $CompletedTasks }}</h3>
                    <p>CompletedTasks</p>
                </div>
            </a>

            <a href="{{ route('superadmin.task.pendingtask') }}" class="card-link">
                <div class="card">
                    <h3>{{ $PendingTasks }}</h3>
                    <p>PendingTasks</p>
                </div>
            </a>

            
            
        </div>

    </div>

</body>
</html>
