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
        $projects = Project::where('manager_id', Auth::id())->get();

    $tasks = Task::whereHas('project', function ($q) {
        $q->where('manager_id', Auth::id());
    })->get();

    
$staff = User::where('role', 'staff')->get();
return view('Admin.dashboard', compact('projects', 'tasks', 'staff'));
    }
}
