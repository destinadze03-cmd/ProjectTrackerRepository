<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff - My Tasks</title>

    <style>
        /* --- your existing styles --- */
        body { margin: 0; padding: 0; display: flex; font-family: Arial, sans-serif; background: #f4f4f4; }
        .sidebarr { width: 250px; background: #d6c1c7ff; height: 100vh; padding: 20px; color: white; position: fixed; }
        .sidebarr h2 { text-align: center; margin-bottom: 20px; font-size: 22px; }
        .sidebarr a { display: block; color: white; padding: 12px; text-decoration: none; border-radius: 4px; margin-bottom: 10px; }
        .sidebarr a:hover { background: #0f172a; }
        .main-content { margin-left: 270px; padding: 30px; width: 100%; }
        h2 { margin-bottom: 20px; }
        .task-card { background: white; border: 1px solid #ccc; padding: 20px; margin-bottom: 25px; border-radius: 8px; }
        .task-card h3 { margin-top: 0; }
        textarea, select, input[type="file"] { width: 100%; padding: 8px; margin-top: 5px; }
        button { background: #3498db; color: white; padding: 10px 15px; border: none; margin-top: 10px; cursor: pointer; border-radius: 4px; }
        button:hover { background: #2980b9; }
        img { margin-top: 10px; border: 1px solid #ddd; border-radius: 4px; }
        hr { margin: 20px 0; }
        .status-badge { padding: 4px 8px; border-radius: 4px; color: white; }
        .status-pending { background: orange; }
        .status-approved { background: green; }
        .status-rejected { background: red; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebarr">
        <h2>Staff Panel</h2>

        <a href="{{ url('staff/dashboard') }}">Dashboard</a>
        <a href="{{ url('staff/tasks') }}">My Tasks</a>
        <a href="{{ url('staff/progress') }}">My Progress</a>
        <a href="{{ url('staff/profile') }}">Profile</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">

        <h2>My Assigned Tasks</h2>

       @foreach ($tasks as $task)
<div class="task-card">

<p><strong>Task Name:</strong> {{ $task->title }}</p>
    <p><strong>Discription:</strong> {{ $task->description }}</p>


    <p><strong>Start Date:</strong> {{ $task->start_date }}</p>
    <p><strong>End Date:</strong> {{ $task->end_date }}</p>
    <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>

    <!-- ADMIN REVIEW STATUS -->
    <p><strong>Admin Review:</strong> 
        <span class="status-badge 
            {{ $task->review_status == 'pending' ? 'status-pending' : ($task->review_status == 'validated' ? 'status-approved' : 'status-rejected') }}">
            {{ ucfirst($task->review_status == 'pending' ? 'Pending' : ($task->review_status == 'validated' ? 'Approved' : 'Rejected')) }}
        </span>
    </p>

    @if($task->review_note)
        <p><strong>Admin Note:</strong> {{ $task->review_note }}</p>
    @endif

    <!-- Update Form -->
    <form action="{{ route('staff.tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Add Progress Note:</label>
        <textarea name="note" placeholder="Add progress note"></textarea>

        <br><br>

        <label>Upload Screenshot</label>
        <input type="file" name="screenshot">

        <br><br>

        <label>Status</label>
        <select name="status">
            <option value="pending" {{ $task->status=='pending'?'selected':'' }}>Pending</option>
            
            <option value="done" {{ $task->status=='done'?'selected':'' }}>Done</option>
        </select>

        <button type="submit">Submit Update</button>
    </form>

</div>
@endforeach

    </div>

</body>
</html>
