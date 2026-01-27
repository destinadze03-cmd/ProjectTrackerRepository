<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SuperAdmin | Total Staff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Segoe UI", Tahoma, sans-serif; }
        body { background: #f4f6f9; color: #333; }
        .wrapper { display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar { width: 220px; background: #1e293b; color: #fff; padding: 20px; }
        .sidebar h2 { text-align: center; margin-bottom: 30px; }
        .sidebar a { display: block; padding: 12px 15px; margin-bottom: 8px; color: #cbd5e1; text-decoration: none; border-radius: 6px; }
        .sidebar a.active, .sidebar a:hover { background: #334155; color: #fff; }

        /* Main content */
        .main-content { flex: 1; padding: 25px; }

        /* Topbar */
        .topbar { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; flex-wrap: wrap; }
        .back-btn { padding: 6px 12px; background: #e5e7eb; color: #111827; border-radius: 6px; text-decoration: none; font-size: 14px; }
        .back-btn:hover { background: #d1d5db; }
        .topbar h2 { font-size: 24px; }

        /* Card */
        .card { background: #fff; border-radius: 8px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); margin-bottom: 20px; }
        .card-header { padding: 15px 20px; border-bottom: 1px solid #eee; }
        .card-header h3 { font-size: 18px; }
        .card-body { padding: 20px; overflow-x: auto; }

        /* Table */
        table { width: 100%; border-collapse: collapse; min-width: 900px; }
        thead { background: #f1f5f9; }
        th, td { padding: 12px 10px; font-size: 14px; border-bottom: 1px solid #eee; text-align: left; vertical-align: middle; }
        tbody tr:hover { background: #f9fafb; }

        /* Buttons */
        .btn-view { padding: 6px 12px; background: #0d6efd; color: #fff; border-radius: 6px; text-decoration: none; font-size: 13px; }
        .btn-view:hover { background: #0b5ed7; }

        /* Footer */
        footer { margin-top: 20px; text-align: center; color: #6b7280; font-size: 13px; }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { padding: 15px; }
            table { min-width: 100%; }
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="wrapper">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>SuperAdmin</h2>
        <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        <a href="{{ route('superadmin.projects.projectpage') }}">Projects</a>
        <a href="{{ route('superadmin.task.index') }}">Tasks</a>
        <a href="{{ route('superadmin.staff.staffpage') }}" class="active">Staff</a>
        <a href="{{ route('superadmin.admins.index') }}">Admins</a>
        <a href="#">Reports</a>
    </aside>

    <!-- Main Content -->
    <main class="main-content">

        <!-- Topbar -->
        <div class="topbar">
            <a href="javascript:history.back()" class="back-btn">← Back</a>
            <h2>All Staff</h2>
        </div>

        <!-- Card/Table -->
        <div class="card">
            <div class="card-header">
                <h3>Staff List</h3>
            </div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Assigned By</th>
                            <th>Total Tasks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($staff as $index => $s)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $s->name }}</td>
                            <td>{{ $s->email }}</td>
                            <td>{{ $s->supervisor->name ?? 'N/A' }}</td>

                            <td>{{ $s->assignedTasks->count() }}</td>
                            <td>
                               <a href="{{ route('superadmin.staff.view', $s->id) }}" class="btn-view">View</a>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No staff found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <footer>© 2025 Project Tracker System — SuperAdmin Panel</footer>

    </main>

</div>

</body>
</html>
