@extends('admin.layout')

@section('content')

<style>
    .task-wrapper {
        max-width: 900px;
        margin: 0 auto;
    }

    .task-card {
        background: #ffffff;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 10px 25px rgba(0,0,0,.08);
    }

    .task-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .task-header h2 {
        margin: 0;
        font-size: 24px;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-completed {
        background: #dcfce7;
        color: #166534;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .task-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .task-item {
        background: #f9fafb;
        padding: 15px 18px;
        border-radius: 10px;
    }

    .task-item strong {
        display: block;
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 6px;
    }

    .task-item span {
        font-size: 15px;
        color: #111827;
    }

    .task-description {
        margin-top: 25px;
        background: #f9fafb;
        padding: 20px;
        border-radius: 10px;
    }

    .back-btn {
        display: inline-block;
        margin-top: 25px;
        text-decoration: none;
        padding: 10px 18px;
        background: #e5e7eb;
        color: #111827;
        border-radius: 8px;
        font-size: 14px;
    }

    .back-btn:hover {
        background: #d1d5db;
    }
</style>

<div class="task-wrapper">

    <div class="task-card">

        <!-- Header --> <h3>Task:</h3>
        <div class="task-header">
            
            <h2>{{ $task->title }}</h2>

 
            <span class="status-badge 
                {{ $task->status === 'completed' ? 'status-completed' : 'status-pending' }}">
                
                {{ ucfirst($task->status) }}
            </span>
        </div>

        <!-- Info Grid -->
        <div class="task-grid">
            <div class="task-item">
                <strong>Assigned To</strong>
                <span>{{ $task->assignedTo?->name ?? 'N/A' }}</span>
            </div>

            <div class="task-item">
                <strong>Start Date</strong>
                <span>{{ $task->start_date ?? 'N/A' }}</span>
            </div>

            <div class="task-item">
                <strong>End Date</strong>
                <span>{{ $task->end_date ?? 'N/A' }}</span>
            </div>
        </div>

        <!-- Description -->
        <div class="task-description">
            <strong>Description</strong>
            <p>{{ $task->description ?? 'No description provided.' }}</p>
        </div>

    </div>

    <!-- Back Button -->
    <a href="{{ url()->previous() }}" class="back-btn">
        ← Back to Project
    </a>

</div>

@endsection
