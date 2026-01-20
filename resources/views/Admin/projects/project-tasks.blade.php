@extends('admin.layout')

@section('content')

<style>
/* ================= PAGE HEADER ================= */
.topbar {
    margin-bottom: 25px;
}
.topbar h2 {
    font-size: 22px;
    margin-bottom: 5px;
}
.topbar p {
    font-size: 14px;
    color: #666;
}

/* ================= GRID ================= */
.task-wrapper {
    display: grid;
    grid-template-columns: 2.2fr 1fr;
    gap: 25px;
}

/* ================= CARD ================= */
.card {
    background: #fff;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 6px 18px rgba(0,0,0,.08);
}

/* ================= TABLE ================= */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}
th, td {
    padding: 12px;
    border-bottom: 1px solid #eee;
}
th {
    background: #f8f9fa;
    text-transform: uppercase;
    font-size: 11px;
    letter-spacing: .05em;
}
tr:hover { background: #f5f7fa; }

/* ================= BADGES ================= */
.badge {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}
.badge-pending { background: #fff3cd; color: #856404; }
.badge-done { background: #e6f4ea; color: #1e7e34; }

/* ================= BUTTONS ================= */
.btn {
    padding: 6px 10px;
    font-size: 12px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
}
.btn-edit { background: #6366f1; color: #fff; }
.btn-view { background: #10b981; color: #fff; }
.btn:hover { opacity: .9; }

.btn-primary {
    width: 100%;
    padding: 12px;
    background: #4f46e5;
    color: #fff;
    border-radius: 10px;
    font-size: 14px;
    border: none;
}

/* ================= FORM ================= */
.form-group { margin-bottom: 14px; }
label {
    font-size: 13px;
    color: #444;
    margin-bottom: 6px;
    display: block;
}
input, textarea, select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 14px;
}

/* Sticky form */
.form-card {
    position: sticky;
    top: 90px;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
    .task-wrapper {
        grid-template-columns: 1fr;
    }
    .form-card {
        position: static;
    }
}
@media (max-width: 576px) {
    th, td {
        font-size: 12px;
        padding: 8px;
    }
}
</style>

{{-- ================= PAGE HEADER ================= --}}
@if(isset($project))
<div class="topbar">
    <h2>{{ $project->title }} – Tasks</h2>
    <p>Manage tasks for this project</p>
</div>
@endif

<div class="task-wrapper">

{{-- ================= LEFT: TASK LIST ================= --}}
<div class="card">
    <h3 style="margin-bottom:15px;">Tasks List</h3>

    @if(isset($tasks) && $tasks->count())
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Task</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
                <th>Actions</th>
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
                    <a href="{{ route('admin.tasks.edit', $task->id) }}">
                        <button class="btn btn-edit">Edit</button>
                    </a></td>
                    <td><a href="{{ route('admin.tasks.show-task-detail', $task->id) }}">
                        <button class="btn btn-view">View</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if(isset($totalTaskCount) && $totalTaskCount > 10)
        <div style="margin-top:15px; text-align:right;">
            <a href="{{ route('admin.projects.project-tasks', $project->id) }}">
                <button class="btn btn-edit">View All</button>
            </a>
        </div>
    @endif

    @else
        <p>No tasks created for this project yet.</p>
    @endif
</div>

{{-- ================= RIGHT: CREATE / EDIT FORM ================= --}}
<div class="card form-card">
    <h3 style="margin-bottom:5px;">
        {{ isset($editTask) ? 'Edit Task' : 'Create Task' }}
    </h3>
    <p style="font-size:13px; color:#666; margin-bottom:15px;">
        {{ isset($editTask) ? 'Update task details' : 'Fill in task information' }}
    </p>

    <form method="POST"
          action="{{ isset($editTask) ? route('admin.tasks.update', $editTask->id) : route('admin.tasks.store') }}">
        @csrf
        @isset($editTask) @method('PUT') @endisset

        <input type="hidden" name="project_id"
               value="{{ $project->id ?? ($editTask->project_id ?? '') }}">

        <div class="form-group">
            <label>Task Title</label>
            <input type="text" name="title"
                   value="{{ old('title', $editTask->title ?? '') }}" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="3">{{ old('description', $editTask->description ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label>Duration (days)</label>
            <input type="number" name="duration"
                   value="{{ old('duration', $editTask->duration ?? '') }}">
        </div>

        <div class="form-group">
            <label>Start Date</label>
            <input type="date" name="start_date"
                   value="{{ old('start_date', $editTask->start_date ?? '') }}">
        </div>

        <div class="form-group">
            <label>End Date</label>
            <input type="date" name="end_date"
                   value="{{ old('end_date', $editTask->end_date ?? '') }}">
        </div>

       

        

        

        <div class="form-group">
            <label>Assign to Staff</label>
            <select name="assigned_to" required>
                <option value="">Select Staff</option>
                @foreach($staffs as $staff)
                <option value="{{ $staff->id }}"
                    {{ old('assigned_to', $editTask->assigned_to ?? '') == $staff->id ? 'selected' : '' }}>
                    {{ $staff->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Supervised By</label>
            <select name="supervised_by">
                <option value="">Select Supervisor</option>
                @foreach($admins as $admin)
                <option value="{{ $admin->id }}"
                    {{ old('supervised_by', $editTask->supervised_by ?? '') == $admin->id ? 'selected' : '' }}>
                    {{ $admin->name }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn-primary">
            {{ isset($editTask) ? 'Update Task' : 'Create Task' }}
        </button>
    </form>
</div>

</div>
@endsection
