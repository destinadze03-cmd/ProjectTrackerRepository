<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>

    <style>
        body {
            font-family: Arial;
            background: #f0f2f5;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .btn {
            background: #3498db;
            color: white;
            padding: 12px 15px;
            border: none;
            border-radius: 6px;
            margin-top: 20px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        .btn:hover {
            background: #2980b9;
        }

        .back {
            text-decoration: none;
            color: #2c3e50;
            display: inline-block;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('admin.projects.show', $project->id) }}" class="back">← Back to Project</a>

    <h2>Create Task for: <strong>{{ $project->title }}</strong></h2>

    <form action="{{ route('admin.tasks.store', $project->id) }}" method="POST">
        @csrf

        <label>Task Title</label>
        <input type="text" name="title" required>

        <label>Description</label>
        <textarea name="description"></textarea>

        <label>Duration (Days)</label>
        <input type="number" name="duration">

        <label>Start Date</label>
        <input type="date" name="start_date" required>

        <label>End Date</label>
        <input type="date" name="end_date" required>

        <label>Assign to Staff</label>
        <select name="assigned_to">
            <option value="">-- Select Staff --</option>
            @foreach($staff as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
            @endforeach
        </select>

        <label>Status</label>
        <select name="status" required>
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>

        <button type="submit" class="btn">Create Task</button>
    </form>

</div>

</body>
</html>
