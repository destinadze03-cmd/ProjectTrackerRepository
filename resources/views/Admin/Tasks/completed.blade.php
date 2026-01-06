@extends('admin.layout')

@section('title', 'Completed Tasks')
@section('header', 'Completed Tasks')

@section('content')

<h2>Completed Tasks</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>id</th>
        <th>Title</th>
        <th>Assigned To</th>
        <th>Status</th>
        <th>Completed On</th>
    </tr>

    @foreach ($tasks as $task)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->assignedTo->name ?? 'N/A' }}</td>
            <td>{{ $task->status }}</td>
            <td>{{ $task->updated_at }}</td>
        </tr>
    @endforeach
</table>

@endsection
