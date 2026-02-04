<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        // ✅ Projects assigned to this admin
        $projects = Project::where('manager_id', $admin->id)->get();

        // ✅ Tasks under admin projects
        $tasks = Task::whereHas('project', function ($q) use ($admin) {
            $q->where('manager_id', $admin->id);
        })->get();

        // ✅ Staff list
        $staff = User::where('role', 'staff')->get();

        // ✅ Notifications (Unread)
        $notifications = $admin->unreadNotifications;

        return view('Admin.dashboard', compact(
            'projects',
            'tasks',
            'staff',
            'notifications'
        ));
    }
}

