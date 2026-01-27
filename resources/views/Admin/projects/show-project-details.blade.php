@extends('admin.layout')

@section('content')

<style>
    .details-card {
        background:#fff;
        padding:25px;
        border-radius:14px;
        box-shadow:0 6px 18px rgba(0,0,0,.08);
        margin-top:25px;
    }

    .project-header {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }

    .stats {
        display:grid;
        grid-template-columns:repeat(auto-fit, minmax(180px, 1fr));
        gap:15px;
        margin-top:20px;
    }

    .stat-box {
        background:#f8f9fa;
        padding:18px;
        border-radius:12px;
        text-align:center;
    }

    .stat-box h3 {
        margin:0;
        font-size:22px;
        color:#4f46e5;
    }

    .stat-box p {
        margin:5px 0 0;
        color:#555;
        font-size:14px;
    }

    .btn {
        padding:10px 16px;
        border-radius:8px;
        text-decoration:none;
        font-size:14px;
        margin-left:8px;
        display:inline-block;
    }

    .btn-primary {
        background:#4f46e5;
        color:#fff;
    }

    .btn-secondary {
        background:#e5e7eb;
        color:#333;
    }

    .info-row {
        margin-bottom:12px;
    }

    .info-row strong {
        color:#333;
    }
</style>

<div class="topbar">
    <h2>Project Details</h2>
    <p>Overview of the :{{ $project->title }}</p>
</div>

<div class="details-card">

    <!-- Header -->
    <div class="project-header">
        <div>
            <h2>{{ $project->title }}</h2>
            <p>Status: <strong>{{ ucfirst($project->status ?? 'N/A') }}</strong></p>
        </div>

        <div>
    <a href="{{ route('admin.projects.project-tasks', $project->id) }}" class="btn btn-primary">
        Details / Create Task
    </a>
</div>

    </div>

    <!-- Project Info -->
    <div class="info-row">
        <strong>Description:</strong>
        <p>{{ $project->description ?? 'No description provided.' }}</p>
    </div>

    <div class="info-row">
        <strong>Start Date:</strong>
        {{ $project->start_date ?? 'N/A' }}
    </div>

    <div class="info-row">
        <strong>End Date:</strong>
        {{ $project->end_date ?? 'N/A' }}
    </div>

    <div class="info-row">
        <strong>Created On:</strong>
        {{ $project->created_at->format('d M Y') }}
    </div>

    

    <!-- Task Stats -->
    <div class="stats">
    <a href="{{ route('admin.projects.project-total-task', $project->id) }}" class="stat-link">
        <div class="stat-box">
            <h3>{{ $totalTasks }}</h3>
            <p>Total Tasks</p>
        </div>
    </a>
<a href="{{ route('admin.Tasks.completed', [$project->id, 'status' => 'validated']) }}" class="stat-link">
    <div class="stat-box">
        <h3>{{ $submittedTasks }}</h3>
        <p>submitted Tasks</p>
    </div>
</a>

   <a href="{{ route('admin.Tasks.completed', [$project->id, 'status' => 'validated']) }}" class="stat-link">
    <div class="stat-box">
        <h3>{{ $completedTasks }}</h3>
        <p>Completed Task</p>
    </div>
</a>

<a href="{{ route('admin.Tasks.completed', [$project->id, 'status' => 'validated']) }}" class="stat-link">
    <div class="stat-box">
        <h3>{{ $rejectedTasks }}</h3>
        <p>Rejected Task</p>
    </div>
</a>

    <a href="{{ route('admin.Tasks.pending', [$project->id, 'status' => 'pending']) }}" class="stat-link">
        <div class="stat-box">
            <h3>{{ $pendingTasks }}</h3>
            <p>Pending Task</p>
        </div>
    </a>
</div>


@endsection
