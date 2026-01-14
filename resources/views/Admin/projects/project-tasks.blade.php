@extends('admin.layout')

@section('content')

<style>
    /* Wrapper grid for table + form */
    .task-wrapper {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
        margin-top: 25px;
    }

    /* Cards */
    .card {
        background: #fff;
        padding: 20px;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(0,0,0,.08);
    }

    /* Table */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        text-align: left;
    }

    th {
        background: #f8f9fa;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: .04em;
    }

    tr:hover { background: #f5f7fa; }

    .badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-pending { background: #fff3cd; color: #856404; }
    .badge-done { background: #e6f4ea; color: #1e7e34; }

    /* Form styles */
    .form-group { margin-bottom: 15px; }
    label { display: block; margin-bottom: 6px; font-size: 13px; color: #444; }
    input, textarea, select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
    }
    button {
        width: 100%;
        padding: 12px;
        background: #4f46e5;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
    }
    button:hover { background: #4338ca; }

    /* === RESPONSIVE STYLING === */
    @media (max-width: 992px) {
        .task-wrapper {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        th, td {
            font-size: 12px;
            padding: 8px;
        }

        button {
            font-size: 13px;
            padding: 10px;
        }
    }
</style>

<div class="topbar">
    <h2>{{ $project->title }} – Tasks</h2>
    <p>View and create tasks for this project</p>
</div>

<div class="task-wrapper">

    <!-- LEFT: TASK TABLE -->
    <div class="card">
    <h3 style="margin-bottom: 15px;">Tasks List</h3>

    @if($tasks->count())
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $index => $task)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $task->title }}</td>
                        <td>
                            <span class="badge badge-{{ $task->status }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td>{{ $task->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="#">
                                <button>Edit</button>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.tasks.show-task-detail', $task->id) }}">
                                <button>Details</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- SHOW ONLY IF MORE THAN 10 TASKS EXIST --}}
        @if($totalTaskCount > 10)
            <div style="margin-top: 20px; text-align: right;">
                <a href="{{ route('admin.projects.project-tasks', $project->id) }}">
                    <button>View All Tasks</button>
                </a>
            </div>
        @endif

    @else
        <p>No tasks created for this project yet.</p>
    @endif
</div>



    <!-- RIGHT: CREATE TASK FORM -->
    <div class="card">
        <h3 style="margin-bottom: 15px;">Create Task</h3>

        <form method="POST" action="{{ route('admin.projects.store') }}">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id }}">

            <div class="form-group">
                <label>Task Title</label>
                <input type="text" name="title" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3"></textarea>
            </div>

            <!-- Assign Staff -->
            <div class="form-group">
                <label>Assign To Staff</label>
                <select name="assigned_to" required>
                    <option value="">Select Staff</option>
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}">
                            {{ $staff->name }} ({{ $staff->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="pending">Pending</option>
                    <option value="done">Done</option>
                </select>
            </div>

            <div class="form-group">
                <label>Start Date</label>
                <input type="date" name="start_date">
            </div>

            <div class="form-group">
                <label>End Date</label>
                <input type="date" name="end_date">
            </div>

            <button type="submit">Create Task</button>
        </form>
    </div>

</div>

   
@endsection
