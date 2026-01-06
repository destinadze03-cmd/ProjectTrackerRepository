<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SuperAdmin | Completed Tasks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, sans-serif;
        }

        body {
            background: #f4f6f9;
            color: #333;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            background: #1e293b;
            color: #fff;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 12px 15px;
            margin-bottom: 8px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 6px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #334155;
            color: #fff;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 25px;
        }

        /* TOPBAR */
        .topbar {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .back-btn {
            padding: 6px 12px;
            background: #e5e7eb;
            color: #111827;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
        }

        .back-btn:hover {
            background: #d1d5db;
        }

        .topbar h2 {
            font-size: 24px;
        }

        /* CARD */
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .card-header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }

        .card-header h3 {
            font-size: 18px;
        }

        .card-body {
            padding: 20px;
            overflow-x: auto;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        thead {
            background: #f1f5f9;
        }

        th, td {
            padding: 12px 10px;
            font-size: 14px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        /* BADGES */
        .badge-completed {
            background: #d1e7dd;
            color: #0f5132;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        /* FOOTER */
        footer {
            margin-top: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 13px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-content {
                padding: 15px;
            }
            table {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>SuperAdmin</h2>
        <a href="#">Dashboard</a>
        <a href="#">Projects</a>
        <a href="#" class="active">Tasks</a>
        <a href="#">Admins</a>
        <a href="#">Staff</a>
        <a href="#">Reports</a>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- TOPBAR -->
        <div class="topbar">
            <a href="javascript:history.back()" class="back-btn">← Back</a>
            <h2>Completed Tasks</h2>
        </div>

        <!-- CARD / TABLE -->
        <div class="card">
            <div class="card-header">
                <h3>All Completed Tasks</h3>
            </div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Task Title</th>
                            <th>Project</th>
                            <th>Project Manager</th>
                            <th>Assigned Staff</th>
                            <th>Status</th>
                            <th>Review Status</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>API Integration</td>
                            <td>HR Management System</td>
                            <td>Mary Admin</td>
                            <td>Paul Staff</td>
                            <td>Completed</td>
                            <td><span class="badge-completed">Completed</span></td>
                            <td>100%</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Payment Gateway Setup</td>
                            <td>E-Commerce Platform</td>
                            <td>John Admin</td>
                            <td>Linda Staff</td>
                            <td>Completed</td>
                            <td><span class="badge-completed">Completed</span></td>
                            <td>100%</td>
                        </tr>
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
