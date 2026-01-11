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
                    </div>

        <!-- Assigned Tasks -->
        <h2>Assigned Tasks</h2>

            <!-- Empty State -->
        <div class="task-card">
                       <h3>No Tasks Yet</h3>
            <p>
                You currently have no additional tasks assigned.
            </p>
        </div>

    </div>
</div>

</body>
</html>
