<h2 style="color: white;">Staff List</h2>

    <a href="{{ route('admin.staff.create') }}" class="btn btn-add">+ Add New Staff</a>

    <table class="table mt-3 table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date Created</th>
                <th >Action</th>
                <th >Action1</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($staff as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.staff.edit', $user->id) }}" class="btn btn-edit" style="text-decoration:none">Edit</a>
                   <!--<a> <form action="{{ route('admin.staff.destroy', $user->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete">Delete</button>
                    </form></a>-->
                </td>
                <td><form action="{{ route('admin.staff.destroy', $user->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete">Delete</button>
                    </form></td>
            </tr>
            @endforeach
        </tbody>
    </table>
