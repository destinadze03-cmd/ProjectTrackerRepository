<div class="container">

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="#">Dashboard</a>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">create project</a>
        <a href="{{ route('projects.index') }}">Manage Staff</a>
        <a href="#">Tasks</a>
        <a href="#">Reports</a>
        <a href="#">Create Client</a>
        <a href="#">Settings</a>
        <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>



    </div>