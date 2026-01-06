<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Task;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Count totals
        $totalProjects = Project::count();
        $totalStaff = User::where('role', 'staff')->count();
        $pendingTasks = Task::where('status', 'pending')->count();

        // Load all projects with their tasks
        $projects = Project::with('tasks')->get();

        return view('admin.dashboard', compact(
            'totalProjects',
            'totalStaff',
            'pendingTasks',
            'projects'
        ));
    }
}
