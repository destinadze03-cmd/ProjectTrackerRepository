@extends('admin.layout')

@section('content')

<style>
    .table-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        margin-top: 25px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background-color: #f8f9fa;
    }

    th, td {
        padding: 14px 12px;
        text-align: left;
        border-bottom: 1px solid #eaeaea;
    }

    th {
        font-size: 14px;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    td {
        font-size: 14px;
        color: #555;
    }

    tr:hover {
        background-color: #f5f7fa;
    }

    .status-badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-active {
        background: #e6f4ea;
        color: #1e7e34;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-completed {
        background: #e7f1ff;
        color: #004085;
    }
</style>

<div class="topbar">
    <h2>My Projects</h2>
    <p>Project Assigned to, {{ auth()->user()->name }}</p>
</div>

<div class="table-card">

    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.my-projects') }}" style="margin-bottom: 15px; display: flex; gap: 10px;">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search projects..."
            style="
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 6px;
                width: 250px;
            "
        >
        <button
            type="submit"
            style="
                padding: 10px 16px;
                background: #4f46e5;
                color: #fff;
                border: none;
                border-radius: 6px;
                cursor: pointer;
            "
        >
            Search
        </button>
    </form>

    @if($projects->count())
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Status</th>
                    <th>Created On</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $index => $project)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $project->title }}</td>
                        <td>
                            @php
                                $status = strtolower($project->status ?? 'pending');
                            @endphp
                           <span class="status-badge status-{{ $project->status }}">
    {{ ucfirst($project->status) }}
</span>


                         
                        </td>
                        <td>{{ $project->created_at->format('d M Y') }}</td>
                        <td><a href="{{ route('admin.projects.show', $project->id) }}"><button> Project details</button></a></td>
                        <td>
    @if(in_array($project->status, ['pending', 'rejected']))
        <form action="{{ route('admin.projects.submit', $project->id) }}" method="POST">
            @csrf
            <button type="submit"
                style="background:#4f46e5;color:#fff;border:none;padding:8px 12px;border-radius:6px;">
                Submit Project
            </button>
        </form>
    @else
        <button
            disabled
            style="background:#ccc;color:#666;border:none;padding:8px 12px;border-radius:6px;cursor:not-allowed;">
            Submitted
        </button>
    @endif
</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No projects found.</p>
    @endif

</div>

@endsection
