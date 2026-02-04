@extends('admin.layout')

@section('content')

<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
        margin-top: 25px;
    }

    .card-link {
        text-decoration: none;
        color: inherit;
    }

    .square-card {
        background: #ffffff;
        border-radius: 12px;
        height: 180px;
        padding: 20px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.25s ease-in-out;
        text-align: center;
    }

    .square-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 35px rgba(0, 0, 0, 0.18);
    }

    .square-card h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #333;
    }

    .square-card p {
        font-size: 14px;
        color: #666;
    }
</style>



    <!-- Top Bar -->
    <div class="topbar">
        <h2>Admin Dashboard</h2>
        <strong><p>Welcome, {{ auth()->user()->name }}</p></strong>

        <div class="d-flex justify-content-between align-items-center mb-3">

   

    <a href="#" class="btn btn-outline-dark position-relative">
        🔔 

        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
            {{ auth()->user()->unreadNotifications->count() }}
        </span>
    </a> <p>Notification</p>

</div>


@if($notifications->count() > 0)

    @foreach($notifications as $notification)

        <div class="alert alert-info">
            <strong>{{ $notification->data['title'] }}</strong><br>

            {{ $notification->data['message'] }}

            <a href="{{ url('/admin/projects/' . $notification->data['project_id']) }}"
               class="btn btn-sm btn-primary mt-2">
                View Project
            </a>

            <!-- Mark as Read -->
            <form action="{{ route('notifications.read', $notification->id) }}"
                  method="POST"
                  style="display:inline;">
                @csrf
                <button class="btn btn-sm btn-success mt-2">
                    Mark as Read
                </button>
            </form>
        </div>

    @endforeach

@else
    
@endif

    </div>

    <!-- Square Cards -->
    <div class="dashboard-grid">

        <a href="{{ route('admin.my-projects') }}" class="card-link">
            <div class="square-card">
                <h3>My Projects</h3>
                <p>{{ $projects->count() }} Assigned</p>
            </div>
        </a>

        <a href="" class="card-link">
            <div class="square-card">
                <h3>Incomplete Task </h3>
                <p>Unfinished Task</p>
            </div>
        </a>

        <a href="{{ route('admin.staff.update') }}" class="card-link">
    <div class="square-card">
        <h3>Staff Task Update</h3>
        <p>Finished Task</p>
    </div>
</a>


        <a href="" class="card-link">
            <div class="square-card">
                <h3>Task Reviewed</h3>
                <p>Approved Tasks</p>
            </div>
        </a>

        <a href="" class="card-link">
            <div class="square-card">
                <h3>Reports</h3>
                <p>Generate Reports</p>
            </div>
        </a>

    </div>

</div>
@endsection
