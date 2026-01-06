@extends('admin.layout')

@section('title', 'All Projects')
@section('header', 'All Projects')

@section('content')
<a href="{{ route('superadmin.projects.create') }}" class="btn btn-add">+ Create New Project</a>


<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Client</th>
            <th>Start</th>
            <th>End</th>
            <th >Actions1</th>
            <th >Actions2</th>
            <th >Actions3</th>
            <th >Action4</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($projects as $project)
        <tr>
            <td>{{ $project->id }}</td>
            <td>{{ $project->title }}</td>
            <td>{{ $project->client }}</td>
            <td>{{ $project->start_date }}</td>
            <td>{{ $project->end_date }}</td>

            <td><a href="{{ route('projects.show', $project->id) }}" class="btn btn-edit" style="text-decoration: none;">View</a></td>

           <td><a href="{{ route('projects.edit', $project->id) }}" class="btn btn-edit" style="text-decoration: none;">Edit</a></td>

           <td><form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-delete" style="text-decoration: none;">Delete</button>
                </form>
            </td>
            <td><a href="{{ route('projects.report', $project->id) }}" class="btn btn-edit" style="text-decoration: none;">ProjectReport</a>
</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
