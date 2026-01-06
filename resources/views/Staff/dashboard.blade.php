<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>

    @include('staff.staffcss')
</head>

<body>

<div class="container">

    @include('staff.staffnavbar')

    <!-- Main Content -->
    <div class="main-content">

        <!-- Top bar -->
        <div class="topbar">
            <h2>Welcome, Staff Member</h2>
            <span>Today: <strong>Mar 16, 2025</strong></span>
        </div>

        <!-- Assigned Tasks -->
        <h2>Assigned Tasks</h2>

        <!-- Task Card -->
        <div class="task-card">
            <span class="status-badge pending">Pending</span>
            <h3>Design Login Page</h3>
            <p>
                Create a responsive login page according to the provided UI design.
            </p>
            <p>
                <strong>Project:</strong> Website Redesign <br>
                <strong>Start Date:</strong> 2025-03-10 <br>
                <strong>End Date:</strong> 2025-03-20
            </p>
            <button class="btn btn-done">Mark as Done</button>
        </div>

        <!-- Task Card -->
        <div class="task-card">
            <span class="status-badge done">Completed</span>
            <h3>Fix Navbar Bugs</h3>
            <p>
                Resolve alignment and responsiveness issues in the navigation bar.
            </p>
            <p>
                <strong>Project:</strong> Mobile App <br>
                <strong>Start Date:</strong> 2025-03-01 <br>
                <strong>End Date:</strong> 2025-03-05
            </p>
            <button class="btn btn-pending">Mark as Pending</button>
        </div>

        <!-- Empty State -->
        <div class="task-card">
            <span class="status-badge pending">Pending</span>
            <h3>No More Tasks</h3>
            <p>
                You currently have no additional tasks assigned.
            </p>
        </div>

    </div>
</div>

</body>
</html>
