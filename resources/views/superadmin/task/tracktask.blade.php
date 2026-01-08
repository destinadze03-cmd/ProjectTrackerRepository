<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Track Task Progress - Super Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #1e1f29;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            padding: 12px;
            color: #ddd;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #3b3c4a;
        }

        /* Main */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            flex-grow: 1;
        }

        .card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            max-width: 900px;
            margin: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        h2, h3 {
            margin-bottom: 15px;
        }

        .info {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        .progress-bar {
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            height: 22px;
            margin-top: 10px;
        }

        .progress-fill {
            height: 100%;
            background: #28a745;
            text-align: center;
            color: white;
            font-size: 13px;
            line-height: 22px;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 13px;
            color: white;
        }

        .pending { background: #ffc107; color: #000; }
        .in_progress { background: #17a2b8; }
        .completed { background: #28a745; }

        /* Timeline */
        .timeline {
            margin-top: 25px;
        }

        .update {
            background: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .update small {
            color: #666;
        }

        .screenshot {
            margin-top: 10px;
        }

        .screenshot img {
            max-width: 250px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
        }

        .btn:hover {
            background: #005fc5;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Super Admin</h2>
        <a href="{{ route('superadmin.dashboard') }}">Dashboard</a>
        <a href="{{ route('superadmin.task.index') }}">Tasks</a>
        <a href="{{ route('superadmin.projects.index') }}">Projects</a>
    </div>

    <!-- MAIN -->
    <div class="main-content">
        <div class="card">

            <h2>Track Task Progress</h2>

            <div class="info">
                <span class="label">Task:</span> {{ $task->title }}
            </div>

            <div class="info">
                <span class="label">Assigned Staff:</span>
                {{ $task->assignedStaff->name ?? '-' }}
            </div>

            <div class="info">
                <span class="label">Status:</span>
                <span class="badge {{ $task->status }}">
                    {{ ucfirst(str_replace('_',' ', $task->status)) }}
                </span>
            </div>

            <div class="info">
                <span class="label">Progress:</span>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: {{ $task->progress ?? 0 }}%">
                        {{ $task->progress ?? 0 }}%
                    </div>
                </div>
            </div>

            <h3>Progress Updates</h3>

            <div class="timeline">
                @forelse($task->updates as $update)
                    <div class="update">
                        <strong>{{ optional($update->user)->name ?? 'Unknown User' }}</strong>

                        <small> — {{ $update->created_at->format('d M Y, h:i A') }}</small>

                        <p>{{ $update->note ?? 'No note provided' }}</p>

                        @if($update->screenshot)
                            <div class="screenshot">
                                <img src="{{ asset('storage/' . $update->screenshot) }}" alt="Screenshot">
                            </div>
                        @endif
                    </div>
                @empty
                    <p>No progress updates yet.</p>
                @endforelse
            </div>

            <a href="{{ route('superadmin.task.index') }}" class="btn">
                ← Back to Tasks
            </a>

        </div>
    </div>

</div>

</body>
</html>
