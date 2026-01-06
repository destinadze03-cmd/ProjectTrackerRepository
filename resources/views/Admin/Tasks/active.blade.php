


@extends('admin.layout')

@section('title', 'Active Tasks')
@section('header', 'Active Tasks')

@section('content')

<h2>Active Tasks</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Number</th>
        <th>Title</th>
        <th>Assigned To</th>
        <th>Status</th>
        <th>Start Date</th>
        <th>End Date</th>
    </tr>

    @foreach ($tasks as $task)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->assignedTo->name ?? 'N/A' }}</td>
            <td>{{ $task->status }}</td>
            <td>{{ $task->start_date }}</td>
            <td>{{ $task->end_date }}</td>
        </tr>
    @endforeach
</table>

@endsection
