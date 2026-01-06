@extends('admin.layout')

@section('content')

<div class="main-conten">

    <div class="topbar">
        <h2>Welcome, Admin</h2>
        <span>Today: <strong>{{ date('M d, Y') }}</strong></span>
    </div>

    <!-- Stats Cards (Dynamic Now) -->
    <div class="cards">
        <div class="card">
            <h3>{{ $totalStaff }}</h3>
          <strong>  <p>Total Staff</p></strong>
        </div>

        <div class="card">
            <h3>{{ $activeTasks }}</h3>
            <strong><p>Active Tasks</p></strong>
        </div>

        <div class="card">
            <h3>{{ $completedTasks }}</h3>
            <p><strong>Completed Tasks</strong></p>
        </div>

        <div class="card">
            <h3>{{ $pendingApprovals }}</h3>
            <strong><p>Pending Approvals</p></strong>
        </div>
    </div>

    <!-- Staff List Table for management -->
    @include('admin.management')
</div>

@endsection
