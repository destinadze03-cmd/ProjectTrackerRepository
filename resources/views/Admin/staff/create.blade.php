@extends('admin.layout')

@section('title', 'Add New Staff')
@section('header', 'Add New Staff')

@section('content')

<div class="card">
    <h2>Add New Staff</h2>

    <form action="{{ route('admin.staff.store') }}" method="POST">
        @csrf

        <label>Name</label>
        <input type="text" name="name" class="form-control" required>

        <label>Email</label>
        <input type="email" name="email" class="form-control" required>

        <label>Password</label>
        <input type="password" name="password" class="form-control" required>

        <br>
        <button type="submit" class="btn btn-primary">Create Staff</button>
    </form>
</div>

@endsection
