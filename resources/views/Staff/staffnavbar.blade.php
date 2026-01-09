
    <!-- Sidebar -->
    <div class="sidebarr">
        <h2>Staff Panel</h2>
        <a href="#">Dashboard</a>
        <a href="{{ route('staff.tasks.index') }}">My Tasks</a>
        <button
    id="themeToggle"
    class="px-3 py-2 rounded border"
>
    🌙 Dark Mode
</button>

        <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="btn btn-danger">Logout</button>
</form>

</div>