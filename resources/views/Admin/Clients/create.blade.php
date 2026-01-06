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

<h2>Create Client</h2>

<form method="POST" action="{{ route('clients.store') }}">
    @csrf

    <label>Name:</label>
    <input type="text" name="name">

    <label>Email:</label>
    <input type="email" name="email">

    <label>Phone:</label>
    <input type="text" name="phone">

    <label>Address:</label>
    <textarea name="address"></textarea>

    <button type="submit">Save</button>
</form>

@endsection








        
    </div>
</div>

</body>
</html>
