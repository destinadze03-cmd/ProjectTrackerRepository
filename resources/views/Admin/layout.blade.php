<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #0c2a57ff;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: #d6c1c7ff;
            color: #060607ff;
            padding-top: 20px;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            transition: 0.3s ease-in-out;
        }

        .sidebar h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 15px 25px;
            text-decoration: none;
            font-size: 16px;
            color: #060607ff;
        }

        .sidebar a:hover {
            background: #0f172a;
            color: white;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            padding: 25px;
            width: 100%;
            transition: 0.3s ease;
        }

        /* TOP NAVBAR */
        .topbar {
            background: white;
            padding: 18px 25px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
        }

        /* TABLE */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 600px;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 3px 6px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background: #d6c1c7ff;
            color: #060607ff;
        }

        tr:nth-child(even) { background: #f5f5f5; }

        /* BUTTONS */
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-add    { background: #10b981; color:white; }
        .btn-edit   { background: #0ea5e9; color:white; }
        .btn-delete { background: #ef4444; color:white; }

        /* CARDS */
        .card {
            background:white;
            padding:20px;
            border-radius:12px;
            box-shadow:0px 3px 6px rgba(0,0,0,0.1);
            margin-bottom:25px;
        }

        /* FORM INPUTS */
        input, textarea {
            width:100%;
            padding:10px;
            margin-top:5px;
            border-radius:6px;
            border:1px solid #ccc;
        }

        /* MOBILE RESPONSIVENESS */
        @media (max-width: 900px) {
            .sidebar {
                width: 220px;
            }
            .main-content {
                margin-left: 220px;
            }
        }

        @media (max-width: 768px) {
            /* Sidebar collapses */
            .sidebar {
                left: -260px;
            }

            .sidebar.active {
                left: 0;
            }

            /* Hamburger button */
            .menu-btn {
                display: inline-block;
                font-size: 22px;
                background: #ffffff;
                padding: 10px 15px;
                border-radius: 6px;
                cursor: pointer;
                margin-right: 10px;
            }

            .topbar {
                justify-content: flex-start;
                gap: 15px;
            }

            .main-content {
                margin-left: 0;
            }
        }

        @media (max-width: 480px) {
            .topbar h2 {
                font-size: 18px;
            }
            .sidebar {
                width: 200px;
            }
        }


        /*<!-- am the one adding for resposiveness-->*/

        .cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.cards a {
    text-decoration: none;
}

.cards .card {
    background: white;
    padding: 25px;
    border-radius: 14px;
    text-align: center;
    cursor: pointer;
    transition: 0.25s;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.10);
}

.cards .card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 6px 12px rgba(0,0,0,0.15);
}

.cards .card h3 {
    font-size: 32px;
    margin: 0;
    color: #0c2a57;
}

.cards .card p {
    font-size: 16px;
    margin-top: 8px;
    color: #333;
}

/* Tablet - 2 cards per row */
@media (max-width: 900px) {
    .cards {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Mobile - 1 card per row */
@media (max-width: 600px) {
    .cards {
        grid-template-columns: 1fr;
    }
}









    </style>

    <script>
        function toggleSidebar() {
            document.querySelector(".sidebar").classList.toggle("active");
        }
    </script>
    
</head>
<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Admin</h2>

        <a href="{{ route('admin.dashboard') }}">Home</a>
        <a href="{{ route('admin.my-projects') }}">Preject assignt</a>
        


        <form action="{{ route('logout') }}" method="POST" style="padding:20px;">
            @csrf
            <button class="btn btn-delete">Logout</button>
        </form>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="topbar">
            <span class="menu-btn" onclick="toggleSidebar()">☰</span>
            <h2>@yield('header')</h2>
            <span>Today: <strong>{{ date('M d, Y') }}</strong></span>
        </div>

        <div class="table-container">
            @yield('content')
        </div>

    </div>
</div>

</body>
</html>
