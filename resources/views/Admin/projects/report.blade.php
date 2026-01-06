@php
    $totalTasks = $totalTasks ?? 0;
    $completed  = $completed  ?? 0;
    $active     = $active     ?? 0;
    $pending    = $pending    ?? 0;
    $tasks      = $tasks      ?? collect();
    $project    = $project    ?? (object) ['title' => '—', 'description' => '—', 'start_date' => null, 'end_date' => null];
@endphp




@extends('admin.layout')

@section('title', 'Project Report')
@section('header', 'Project Report')

@section('content')


<style>
    .report-box {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .summary-box {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .summary-item {
        flex: 1;
        background: #f1f1f1;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        font-size: 18px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 10px;
    }

    .print-btn {
        margin-bottom: 20px;
    }

    @media print {
        .print-btn {
            display: none;
        }
    }
</style>

<div class="print-btn">
    <button onclick="window.print()" class="btn btn-primary">Print Report</button>
</div>

<div class="report-box">
    <h2>Project: {{ $project->title }}</h2>
    <p><strong>Description:</strong> {{ $project->description }}</p>
    <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
    <p><strong>End Date:</strong> {{ $project->end_date }}</p>
</div>

<div class="summary-box">
    <div class="summary-item">
        <strong>Total Tasks</strong><br>{{ $totalTasks }}
    </div>

    <div class="summary-item">
        <strong>Completed</strong><br>{{ $completed }}
    </div>

    <div class="summary-item">
        <strong>Active</strong><br>{{ $active }}
    </div>

    <div class="summary-item">
        <strong>Pending</strong><br>{{ $pending }}
    </div>
</div>

<h3>Task Breakdown</h3>

<table>
    <tr>
        <th>Task Title</th>
        <th>Status</th>
        <th>Assigned To</th>
        <th>Start</th>
        <th>End</th>
        <th>Duration</th>
    </tr>

    @foreach ($tasks as $task)
    <tr>
        <td>{{ $task->title }}</td>
        <td>{{ ucfirst($task->status) }}</td>
        <td>{{ $task->user->name ?? 'Unassigned' }}</td>

        <td>{{ $task->start_date }}</td>
        <td>{{ $task->end_date }}</td>
        <td>{{ $task->duration }} days</td>
    </tr>
    @endforeach

</table>

@endsection
