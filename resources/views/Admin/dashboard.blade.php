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
        <p>Welcome, {{ auth()->user()->name }}</p>
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
