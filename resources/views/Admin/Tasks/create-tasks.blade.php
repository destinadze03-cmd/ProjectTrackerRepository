@extends('admin.layout')

@section('content')

<style>
    .table-card {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,.08);
        margin-top: 25px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px;
        border-bottom: 1px solid #eee;
        text-align: left;
    }

    th {
        background: #f8f9fa;
        text-transform: uppercase;
        font-size: 13px;
    }

    tr:hover {
        background: #f5f7fa;
    }

    .badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-pending { background: #fff3cd; color: #856404; }
    .badge-done { background: #e6f4ea; color: #1e7e34; }
</style>

<div class="topbar">
    <h2>Tasks Created</h2>
    <p>Tasks under your projects</p>
</div>

<div class="table-card">

    <!-- Filters -->
    <form method="GET" action="{{ route('admin.create-tasks') }}"
          style="margin-bottom: 15px; display:flex; gap:10px; flex-wrap:wrap;">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search tasks..."
            style="padding:10px; border:1px solid #ddd; border-radius:6px; width:220px;"
        >

        <select name="project_id"
                style="padding:10px; border:1px solid #ddd; border-radius:6px;">
            <option value="">All Projects</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}"
                    {{ request('project_id') == $project->id ? 'selected' : '' }}>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>

        <button style="padding:10px 16px; background:#4f46e5; color:#fff; border:none; border-radius:6px;">
            Filter
        </button>
    </form>

    @if($tasks->count())
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task Title</th>
                    <th>Project</th>
                    <th>Status</th>
                    <th>Created On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $index => $task)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->project->title ?? 'N/A' }}</td>
                        <td>
                            <span class="badge badge-{{ strtolower($task->status) }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td>{{ $task->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No tasks found.</p>
    @endif

</div>

@endsection
