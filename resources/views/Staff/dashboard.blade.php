<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Staff - My Tasks</title>

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

.sidebar h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 22px;
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

/* Top Bar */
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.notification-bell {
    position: relative;
    font-size: 24px;
    cursor: pointer;
}

.notification-bell .badge {
    position: absolute;
    top: -8px;
    right: -10px;
    background: red;
    color: white;
    font-size: 12px;
    padding: 2px 6px;
    border-radius: 50%;
}

.notification-dropdown {
    position: absolute;
    background: white;
    color: black;
    right: 0;
    top: 30px;
    width: 300px;
    border: 1px solid #ccc;
    border-radius: 6px;
    display: none;
    max-height: 400px;
    overflow-y: auto;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    z-index: 1000;
}

.notification-dropdown ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.notification-dropdown li {
    padding: 8px;
    border-bottom: 1px solid #eee;
}

.notification-dropdown li a {
    text-decoration: none;
    color: #111827;
}

/* Task Grid */
.task-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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






.task-card {
    display: block;           /* allow <a> to be block */
    text-decoration: none;    /* remove underline */
    color: inherit;           /* keep text color */
    background: white;
    border-radius: 14px;
    padding: 20px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.08);
    position: relative;
    transition: transform 0.2s;
}

.task-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}

</style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Staff Panel</h2>
    <a href="{{ route('staff.dashboard') }}">Dashboard</a>
    <a href="{{ route('staff.tasks.index') }}">My Tasks</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button style="margin-top:10px;">Logout</button>
    </form>
</div>

<!-- Main Content -->
<div class="content">

    <!-- Top Bar -->
    <div class="top-bar">
        <h2>My Assigned Tasks</h2>

        <div class="notification-bell">
            🔔
            @if($unreadCount > 0)
                <span class="badge">{{ $unreadCount }}</span>
            @endif

            <!-- Notification Dropdown -->
            <div class="notification-dropdown">
                <ul>
                    @forelse($notifications as $notification)
                        <li>
                            <a href="{{ route('staff.notifications.read', $notification->id) }}">
                                <strong>{{ $notification->data['title'] }}</strong> - 
                                {{ $notification->data['message'] }} 
                                (Due: {{ $notification->data['due_date'] ?? 'N/A' }})
                            </a>
                        </li>
                    @empty
                        <li>No notifications</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Task Grid -->
<div class="task-grid">

    {{-- Pending Tasks --}}
    <a href="{{ route('staff.tasks.index', ['status' => 'pending']) }}" class="task-card">
        <span class="status-badge pending">PENDING</span>
        <h3>Pending Tasks</h3>
        @forelse($tasks->where('review_status', 'pending') as $task)
            <p><strong>{{ $task->title }}</strong></p>
            <p>{{ $task->description }}</p>
            <hr>
        @empty
            <p>No pending tasks.</p>
        @endforelse
    </a>

    {{-- Validated Tasks --}}
    <a href="{{ route('staff.tasks.index', ['status' => 'validated']) }}" class="task-card">
        <span class="status-badge validated">VALIDATED</span>
        <h3>Validated Tasks</h3>
        @forelse($tasks->where('review_status', 'validated') as $task)
            <p><strong>{{ $task->title }}</strong></p>
            <p>{{ $task->description }}</p>
            <hr>
        @empty
            <p>No validated tasks.</p>
        @endforelse
    </a>

    {{-- Rejected Tasks --}}
    <a href="{{ route('staff.tasks.index', ['status' => 'rejected']) }}" class="task-card">
        <span class="status-badge rejected">REJECTED</span>
        <h3>Rejected Tasks</h3>
        @forelse($tasks->where('review_status', 'rejected') as $task)
            <p><strong>{{ $task->title }}</strong></p>
            <p>{{ $task->description }}</p>
            @if($task->review_note)
                <div class="admin-note">
                    <strong>Admin Note:</strong><br>
                    {{ $task->review_note }}
                </div>
            @endif
            <hr>
        @empty
            <p>No rejected tasks.</p>
        @endforelse
    </a>

</div>


    </div>

</div>

<!-- JS for notification dropdown -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bell = document.querySelector('.notification-bell');
    if (bell) {
        bell.addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdown = this.querySelector('.notification-dropdown');
            if (dropdown) {
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            }
        });
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        const dropdown = document.querySelector('.notification-dropdown');
        if (dropdown) dropdown.style.display = 'none';
    });
});
</script>

</body>
</html>
