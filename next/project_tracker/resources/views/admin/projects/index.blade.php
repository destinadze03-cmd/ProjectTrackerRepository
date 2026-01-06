@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('header', 'Admin Dashboard')

@section('content')

<style>
/* SIMPLE RESPONSIVE DESIGN */
.cards {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}
.card {
    flex: 1 1 250px;
}
table {
    width: 100%;
}
@media(max-width: 700px) {
    table thead {
        display: none;
    }
    table tr {
        display: block;
        margin-bottom: 15px;
        background: #fafafa;
        padding: 10px;
        border-radius: 10px;
    }
    table td {
        display: flex;
        justify-content: space-between;
        padding: 8px 5px;
    }
}
</style>

<div class="cards">
    <div class="card">
        <h3>Total Projects</h3>
        <p>{{ $totalProjects }}</p>
    </div>
    <div class="card">
        <h3>Total Staff</h3>
        <p>{{ $totalStaff }}</p>
    </div>
    <div class="card">
        <h3>Pending Tasks</h3>
        <p>{{ $pendingTasks }}</p>
    </div>
</div>

<div class="project-list">
    <h2>All Projects</h2>

    <a href="{{ route('admin.projects.create') }}" class="btn">+ Create New Project</a>

    <table>
        <thead>
            <tr>
                <th>Project</th>
                <th>Description</th>
                <th>Tasks</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{ $project->title }}</td>
                <td>{{ $project->description }}</td>
                <td>{{ $project->tasks->count() }}</td>
                <td>
                    <a href="{{ route('admin.projects.show', $project->id) }}" class="action-btn view-btn">View</a>
                    <a href="{{ route('admin.tasks.create', $project->id) }}" class="action-btn task-btn">+ Add Task</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
