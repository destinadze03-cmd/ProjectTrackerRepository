@extends('admin.layout')

@section('title', 'Edit Project')
@section('header', 'Edit Project')

@section('content')

<form action="{{ route('projects.update', $project->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
        <h3>Edit Project Information</h3>

        <!-- Project Title -->
        <label>Project Title</label>
        <input type="text" name="title" value="{{ $project->title }}" required>

        <!-- Client -->
        <label>Client</label>
        <input type="text" name="client" value="{{ $project->client }}" required>

        <!-- Description -->
        <label>Description</label>
        <textarea name="description" rows="4">{{ $project->description }}</textarea>

        <!-- Duration -->
        <label>Duration (Days)</label>
        <input type="number" name="duration" value="{{ $project->duration }}">

        <!-- Start Date -->
        <label>Start Date</label>
        <input type="date" name="start_date" value="{{ $project->start_date }}">

        <!-- End Date -->
        <label>End Date</label>
        <input type="date" name="end_date" value="{{ $project->end_date }}">

        <!-- Created By -->
        <label>Created By</label>
        <input type="text" value="{{ $project->createdBy->name ?? 'Unknown' }}" readonly>

        <button class="btn btn-edit" style="margin-top:15px;">
            Update Project
        </button>
    </div>

</form>

<!-- Back Button -->
<a href="{{ route('projects.index') }}" class="btn btn-delete" style="margin-top:20px; display:inline-block;">
    Back
</a>

@endsection
