<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>


    @include('admin.admincss')
</head>
<body>

<!--<div class="container">-->

   

@include('admin.adminnavbar')


    <!-- Main -->
    <div class="main-content">

        <!-- Top Bar -->
        <div class="topbar">
            <h2>You Are Creating, client</h2>
            <span>Today: <strong>{{ date('M d, Y') }}</strong></span>
        </div>

        



@extends('admin.dashboard')

@section('content')

<h2>Clients</h2>

<a href="{{ route('clients.create') }}">Create New Client</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>

    @foreach($clients as $client)
    <tr>
        <td>{{ $client->name }}</td>
        <td>{{ $client->email }}</td>
        <td>{{ $client->phone }}</td>
        <td>{{ $client->address }}</td>
        <td>
            <a href="{{ route('clients.edit', $client->id) }}">Edit</a>

            <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                @csrf @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

@endsection








    </div>
</div>

</body>
</html>
