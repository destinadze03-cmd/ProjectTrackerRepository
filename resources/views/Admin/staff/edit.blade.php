@extends('admin.layout')

@section('title', 'Edit Staff')
@section('header', 'Edit Staff Details')

@section('content')

<h2>Edit Staff</h2>

<form action="{{ route('admin.staff.update', $staff->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name</label><br>
    <input type="text" name="name" value="{{ $staff->name }}" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="{{ $staff->email }}" required><br><br>

    <label>Role</label><br>
    <select name="role" required>
        <option value="admin" {{ $staff->role == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="staff" {{ $staff->role == 'staff' ? 'selected' : '' }}>Staff</option>
    </select>
    <br><br>

    <button type="submit" class="btn btn-primary">Update Staff</button>
</form>

@endsection
