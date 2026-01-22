<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class AdminProjectController extends Controller
{
    public function myProjects()
    {
        $manager = Auth::user();

        // ONLY fetch projects assigned to this admin
        $projects = Project::where('manager_id', $manager->id)->get();

        return view('admin.projects.my-projects', compact('projects'));
    }


    public function show(Project $project)
{
    // Security check
    abort_if($project->manager_id !== auth()->id(), 403);

    $totalTasks = $project->tasks()->count();
    $completedTasks = $project->tasks()->where('status', 'done')->count();
    $pendingTasks = $project->tasks()->where('status', 'pending')->count();

    return view('admin.projects.show-project-details', compact(
        'project',
        'totalTasks',
        'completedTasks',
        'pendingTasks'
    ));
}


public function totalTasks(Project $project)
{
    // security check
    abort_if($project->manager_id !== auth()->id(), 403);

    // fetch all tasks for this project
    $tasks = $project->tasks()->latest()->get();

    return view('admin.projects.project-total-task', compact('project', 'tasks'));
}



public function submit(Project $project)
{
    // Ensure only assigned admin can submit
    if ($project->manager_id !== auth()->id()) {
        abort(403);
    }

    // Allow submission only if pending or rejected
    if (!in_array($project->status, ['pending', 'rejected'])) {
        return back()->with('error', 'This project cannot be submitted.');
    }

    $project->update([
        'status' => 'submitted'
    ]);

    return back()->with('success', 'Project submitted to SuperAdmin for review.');
}


}

