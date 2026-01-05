<?php

// app/Http/Controllers/AdminDashboardController.php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $adminId = auth()->id();

        $projects = Project::where('manager_id', $adminId)->get();

        $tasks = Task::where('created_by', $adminId)
            ->with(['project', 'staff'])
            ->get();

        return view('admin.dashboard', compact('projects', 'tasks'));
    }
}
