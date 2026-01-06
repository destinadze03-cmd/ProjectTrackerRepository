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

<h2>Edit Client</h2>

<form method="POST" action="{{ route('clients.update', $client->id) }}">
    @csrf @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ $client->name }}">

    <label>Email:</label>
    <input type="email" name="email" value="{{ $client->email }}">

    <label>Phone:</label>
    <input type="text" name="phone" value="{{ $client->phone }}">

    <label>Address:</label>
    <textarea name="address">{{ $client->address }}</textarea>

    <button type="submit">Update</button>
</form>

@endsection







        
    </div>
</div>

</body>
</html>











@extends('admin.dashboard')

@section('content')

<div class="topbar">
    <h2>You Are Editing a Client</h2>
    <span>Today: <strong>{{ date('M d, Y') }}</strong></span>
</div>

<h2>Edit Client</h2>

<form method="POST" action="{{ route('clients.update', $client->id) }}">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ $client->name }}" required>

    <label>Email:</label>
    <input type="email" name="email" value="{{ $client->email }}">

    <label>Phone:</label>
    <input type="text" name="phone" value="{{ $client->phone }}">

    <label>Address:</label>
    <textarea name="address">{{ $client->address }}</textarea>

    <button type="submit">Update</button>
</form>

@endsection
