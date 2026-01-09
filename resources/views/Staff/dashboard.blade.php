<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Tasks</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f1f5f9;
    display: flex;
}

/* Sidebar */
.sidebar {
    width: 240px;
    background: #111827;
    height: 100vh;
    padding: 20px;
    color: white;
}

.sidebar a {
    display: block;
    padding: 12px;
    margin-bottom: 10px;
    color: #e5e7eb;
    text-decoration: none;
    border-radius: 6px;
}

.sidebar a:hover {
    background: #374151;
}

/* Content */
.content {
    padding: 30px;
    width: 100%;
}

.task-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
}


/* Card */
.task-card {
    background: white;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    position: relative;
}

.status-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 6px 14px;
    border-radius: 20px;
    color: white;
    font-size: 12px;
    font-weight: bold;
}

.pending { background: #f59e0b; }
.validated { background: #16a34a; }
.rejected { background: #dc2626; }

.admin-note {
    margin-top: 12px;
    background: #fee2e2;
    padding: 10px;
    border-left: 4px solid #dc2626;
    border-radius: 6px;
}
</style>
</head>

<body>

<div class="sidebar">
    <h2>Staff Panel</h2>
    <a href="#">Dashboard</a>
    <a href="{{ route('staff.tasks.index') }}">My Tasks</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button style="margin-top:10px;">Logout</button>
    </form>
</div>

<div class="content">
    <h2>My Assigned Tasks</h2>

    <div class="task-grid">

    {{-- PENDING CARD --}}
    <div class="task-card">
         <a href="{{ route('staff.tasks.index', ['status' => 'pending']) }}" class="task-card clickable">
  
        <h3>Pending Tasks</h3>
        <p>Click to view all pending tasks</p>
    </a>
        <span class="status-badge pending">PENDING</span>
        <h3>Pending Tasks</h3>

        @foreach($tasks->where('review_status', 'pending') as $task)
            <p><strong>{{ $task->title }}</strong></p>
            <p>{{ $task->description }}</p>
            <hr>
        @endforeach

        @if($tasks->where('review_status', 'pending')->isEmpty())
            <p>No pending tasks.</p>
        @endif
    </div>

    {{-- VALIDATED CARD --}}
    <div class="task-card">
         <a href="{{ route('staff.tasks.index', ['status' => 'validated']) }}" class="task-card clickable">
        
       
        <p>Click to view all validated tasks</p>
    </a>
        <span class="status-badge validated">VALIDATED</span>
   

        @foreach($tasks->where('review_status', 'validated') as $task)
            <p><strong>{{ $task->title }}</strong></p>
            <p>{{ $task->description }}</p>
            <hr>
        @endforeach

        @if($tasks->where('review_status', 'validated')->isEmpty())
            <p>No validated tasks.</p>
        @endif
    </div>

    {{-- REJECTED CARD --}}
    <div class="task-card">
        <a href="{{ route('staff.tasks.index', ['status' => 'rejected']) }}" class="task-card clickable">
      
        <h3>Rejected Tasks</h3>
        <p>Click to view all rejected tasks</p>
    </a>

        <span class="status-badge rejected">REJECTED</span>
        <h3>Rejected Tasks</h3>

        @foreach($tasks->where('review_status', 'rejected') as $task)
            <p><strong>{{ $task->title }}</strong></p>
            <p>{{ $task->description }}</p>

            @if($task->review_note)
                <div class="admin-note">
                    <strong>Admin Note:</strong><br>
                    {{ $task->review_note }}
                </div>
            @endif

            <hr>
        @endforeach

        @if($tasks->where('review_status', 'rejected')->isEmpty())
            <p>No rejected tasks.</p>
        @endif
    </div>

</div>


</body>
</html>
