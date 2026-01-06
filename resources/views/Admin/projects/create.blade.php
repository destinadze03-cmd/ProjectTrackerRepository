@extends('admin.layout')

@section('title', 'Create Project')
@section('header', 'Create New Project')

@section('content')

<form action="{{ route('projects.store') }}" method="POST">
    @csrf

    <div class="card">
        <h3>Project Information</h3>

        <label>Project Title</label>
        <input type="text" name="title" required>

        <label>Client</label>
        <input type="text" name="client" required>

        <label>Description</label>
        <textarea name="description" rows="4"></textarea>

        <label>Start Date</label>
        <input type="date" name="start_date">

        <label>End Date</label>
        <input type="date" name="end_date">

        <button class="btn btn-add" style="margin-top:15px;">Save Project</button>
    </div>

</form>

@endsection

































