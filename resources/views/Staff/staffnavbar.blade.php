
    <!-- Sidebar -->
    <div class="sidebarr">
        <h2>Staff Panel</h2>
        <a href="#">Dashboard</a>
        <a href="{{ route('staff.tasks.index') }}">My Tasks</a>

        <a href="#">My Progress</a>
        <a href="#">Profile</a>
        <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>

</div>