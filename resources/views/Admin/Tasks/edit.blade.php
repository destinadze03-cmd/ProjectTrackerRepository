<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

    <style>
        body { margin:0; font-family:Arial; background:#0c2a57ff; }
        .container { display:flex; min-height:100vh; }
        .sidebar {
            width:260px; background:#d6c1c7ff; padding-top:20px; position:fixed; height:100%;
        }
        .sidebar a { padding:15px 25px; display:block; text-decoration:none; color:black; }
        .sidebar a:hover { background:black; color:white; }
        .main-content { margin-left:260px; padding:25px; width:100%; }
        .card { background:white; padding:20px; border-radius:12px; }
        .btn-save { background:#10b981; color:white; padding:10px 15px; border-radius:6px; }
        .btn-back { background:#ef4444; color:white; padding:10px 15px; border-radius:6px; }
        input, textarea, select { width:100%; padding:10px; margin:8px 0; border-radius:5px; }
        label { font-weight:bold; }
    </style>
</head>

<body>

<div class="container">

    <div class="sidebar">
        <h2>Edit Task</h2>
        <a href="{{ route('tasks.show', $task->id) }}">Back to Task</a>
        <a href="{{ route('projects.show', $task->project_id) }}">Back to Project</a>
    </div>

    <div class="main-content">

        <div class="card">

            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label>Title</label>
                <input type="text" name="title" value="{{ $task->title }}" required>

                <label>Description</label>
                <textarea name="description">{{ $task->description }}</textarea>

                <label>Status</label>
                <select name="status">
                    <option value="pending" {{ $task->status == 'pending' ? 'selected':'' }}>Pending</option>
                    <option value="in-progress" {{ $task->status == 'in-progress' ? 'selected':'' }}>In Progress</option>
                    <option value="done" {{ $task->status == 'done' ? 'selected':'' }}>Done</option>
                </select>

                <label>Assigned Staff</label>
                <select name="assigned_to">
                    <option value="">-- Select Staff --</option>
                    @foreach ($staff as $member)
                        <option value="{{ $member->id }}" 
                            {{ $task->assigned_to == $member->id ? 'selected':'' }}>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>

                <label>Start Date</label>
                <input type="date" name="start_date" value="{{ $task->start_date }}">

                <label>End Date</label>
                <input type="date" name="end_date" value="{{ $task->end_date }}">

                <button class="btn-save">Save</button>
                <a href="{{ route('tasks.show', $task->id) }}" class="btn-back">Cancel</a>

            </form>

        </div>

    </div>

</div>

</body>
</html>
