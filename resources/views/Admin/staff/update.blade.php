@extends('admin.layout')

@section('content')

<style>
/* Task Card */
.task-card {
    background: #1f2937;
    color: #ffffff;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 6px 18px rgba(0,0,0,.3);
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
}

.task-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 25px rgba(0,0,0,.5);
}

/* Task Header */
.task-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Status Badges */
.badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    color: #ffffff;
}

.badge-done { background: #22c55e; }
.badge-pending { background: #f59e0b; }
.badge-rejected { background: #ef4444; }

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 10px;
    margin-top: 15px;
}

.approve-btn {
    background: #10b981;
    color: #ffffff;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
}

.reject-btn {
    background: #ef4444;
    color: #ffffff;
    border: none;
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
}

/* Textarea for rejection reason */
textarea {
    width: 100%;
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 10px;
    margin-top: 10px;
    background: #374151; 
    color: #ffffff;
}

textarea::placeholder {
    color: #d1d5db;
}

/* Topbar */
.topbar {
    margin-bottom: 25px;
}
.topbar h2 { margin: 0; }
.topbar p { margin: 2px 0 0 0; color: #d1d5db; }
</style>

<div class="topbar">
    <h2>Staff Task Updates</h2>
    <p>Review completed tasks submitted by staff</p>
</div>

{{-- Loop through tasks submitted as Done --}}
@forelse($tasks as $task)
<div class="task-card" onclick="window.location='{{ route('admin.staff.task-detail', $task->id) }}'">
    <div class="task-header">
        <h4>{{ $task->title }}</h4>
        <span class="badge 
            @if($task->review_status=='validated') badge-done
            @elseif($task->review_status=='rejected') badge-rejected
            @else badge-pending @endif
        ">
            {{ ucfirst($task->status ?? 'Pending Review') }}
        </span>
    </div>

    <p><strong>Staff:</strong> {{ $task->assignedStaff->name }}</p>
    <p><strong>Project:</strong> {{ $task->project->title }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>

    {{-- Approve/Reject form only for pending tasks --}}
    @if($task->review_status == 'pending')
    
    @else
        @if($task->review_status == 'rejected' && $task->review_note)
            <p><strong>Reason:</strong> {{ $task->review_note }}</p>
        @endif
    @endif
</div>
@empty
<p style="color:white;">No tasks submitted as done yet.</p>
@endforelse

@endsection
