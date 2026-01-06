@extends('admin.layout')

@section('title', 'All Staff')
@section('header', 'Staff List')

@section('content')

<h2 style='color:white'>All Staff</h2>

<a href="{{ route('admin.staff.create') }}" class="btn btn-add"style='color:white'>+ Add Staff</a>
<br></br>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
        <th>Action2</th>
    </tr>

    @foreach ($staff as $member)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->role }}</td>
            <td>
                <a href="{{ route('admin.staff.edit', $member->id) }}"class="btn btn-edit" style="text-decoration: none;">Edit</a>
</td>  
<td> |
                <form action="{{ route('admin.staff.destroy', $member->id) }}"
                      method="POST" style="display:inline-flex;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-delete" type="submit" style="text-decoration: none;">Delete</button>
                </form></td>
            </td>
        </tr>
    @endforeach

</table>

@endsection
