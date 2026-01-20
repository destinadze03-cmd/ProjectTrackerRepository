@extends('admin.layout')

@section('content')

<style>
/* Card */
.task-card {
    background: #1f2937; /* dark background */
    color: #ffffff;       /* white text */
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 6px 18px rgba(0,0,0,.3);
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
    color: #111827; /* dark text for white badges */
}

.badge-done { background: #ffffff; }       /* white badge for validated */
.badge-pending { background: #fbbf24; }    /* yellow badge for pending */
.badge-rejected { background: #ffffff; }   /* white badge for rejected */

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.approve-btn, .reject-btn {
    padding: 14px 28px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: transform 0.1s;
    color: #111827;          /* dark text */
    background: #ffffff;     /* white background */
    box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

.approve-btn:hover, .reject-btn:hover {
    background: #f3f4f6;     /* light gray on hover */
    transform: scale(1.05);
}

/* Textarea */
textarea {
    width: 100%;
    border-radius: 8px;
    border: 1px solid #ddd;
    padding: 10px;
    margin-top: 10px;
    background: #374151; /* dark textarea */
    color: #ffffff;      /* white text */
}

textarea::placeholder {
    color: #d1d5db; /* light gray placeholder */
}

/* Topbar */
.topbar {
    margin-bottom: 25px;
}
.topbar h2 { margin: 0; }
.topbar p { margin: 2px 0 0 0; color: #d1d5db; }
</style>

<div class="topbar">
    <h2>Task Detail</h2>
    <p>{{ $task->title }}</p>
</div>

<div class="task-card">
    <div class="task-header">
        <h4>{{ $task->title }}</h4>
        <span class="badge
            @if($task->review_status=='validated') badge-done
            @elseif($task->review_status=='rejected') badge-rejected
            @else badge-pending @endif
        ">
            {{ ucfirst($task->review_status ?? 'Pending Review') }}
        </span>
    </div>

    <p><strong>Staff:</strong> {{ $task->assignedStaff->name }}</p>
    <p><strong>Project:</strong> {{ $task->project->title }}</p>
    <p><strong>Description:</strong> {{ $task->description }}</p>
    <p><strong>star_date:</strong> {{ $task->start_date }}</p>
    <p><strong>end_date:</strong> {{ $task->end_date }}</p>


    {{-- Approve/Reject form only for pending tasks --}}
    @if($task->review_status == 'pending')
    <form method="POST" action="{{ route('admin.staff.review', $task->id) }}">
        @csrf
        <div class="action-buttons">
            <button type="submit" name="review_status" value="validated" class="approve-btn">Approve</button>
            <button type="submit" name="review_status" value="rejected" class="reject-btn">Reject</button>
        </div>
        <textarea name="review_note" rows="2" placeholder="Reason for rejection (optional)"></textarea>
    </form>
    @elseif($task->review_status == 'rejected' && $task->review_note)
        <p><strong>Reason:</strong> {{ $task->review_note }}</p>
    @endif
</div>

@endsection
