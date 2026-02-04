<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ProjectApprovedNotification;
use App\Notifications\ProjectAssignedNotification;
use App\Notifications\ProjectUpdatedNotification;
use App\Notifications\ProjectRejectedNotification;
class SuperAdminProjectController extends Controller
{
    // Show all projects
    public function index()
    {
        $projects = Project::with(['manager', 'creator', 'client'])->get();
        $admins = User::where('role', 'admin')->get();
        $clients = Client::all();

        return view('superadmin.projects.index', compact('projects', 'admins', 'clients'));
    }




    // Store new project
   public function store(Request $request)  
{
    $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'client_name' => 'nullable|string',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'duration' => 'nullable|integer',
        'manager_id' => 'nullable|exists:users,id',
        'client_id' => 'nullable|exists:clients,id',
        'status' => 'required|in:pending,active,completed',
    ]);

    // Create project
    $project = Project::create([
        'title' => $request->title,
        'description' => $request->description,
        'client_name' => $request->client_name,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'duration' => $request->duration,
        'manager_id' => $request->manager_id,
        'client_id' => $request->client_id,
        'created_by' => Auth::id(),
        'status' => $request->status,
    ]);

    // Notify assigned admin
    if ($project->manager_id) {
        $admin = User::find($project->manager_id);
        if ($admin) {
            $admin->notify(new ProjectAssignedNotification($project));
        }
    }

    return back()->with('success', 'Project created successfully and Admin notified!');
}
    // Show project details
public function show(Project $project)
{
    $project->load('tasks', 'client', 'manager');

    return view('superadmin.projects.show', compact('project'));
}






























    // Edit project
    public function edit(Project $project)
    {
        $admins = User::where('role', 'admin')->get();
        $clients = Client::all();

        return view('superadmin.projects.edit', compact('project', 'admins', 'clients'));
    }

    // Update project
   

public function update(Request $request, Project $project)
{
    $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'client_name' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'duration' => 'required|integer',
        'manager_id' => 'nullable|exists:users,id',
        'client_id' => 'nullable|exists:clients,id',
        'status' => 'required|in:pending,active,completed',
    ]);

    // ✅ Update project
    $project->update([
        'title' => $request->title,
        'description' => $request->description,
        'client_name' => $request->client_name,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'duration' => $request->duration,
        'manager_id' => $request->manager_id,
        'client_id' => $request->client_id,
        'status' => $request->status,
    ]);

    // ✅ Notify assigned admin after update
    if ($project->manager_id) {

        $admin = User::find($project->manager_id);

        if ($admin) {
            $admin->notify(new ProjectUpdatedNotification($project));
        }
    }

    return redirect()
        ->route('superadmin.projects.index')
        ->with('success', 'Project updated successfully and Admin notified!');
}

    // Delete project
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('superadmin.projects.index')
                 ->with('success', 'Project deleted successfully!');

    }

    // Project report (placeholder)
    public function report(Project $project)
    {
        return view('superadmin.projects.report', compact('project'));
    }
    public function dashboard()
{
    // Load whatever data the superadmin dashboard needs
    return view('superadmin.dashboard');
}













public function approve(Project $project)
{
    $project->update([
        'status' => 'approved',
        'reviewed_by' => auth()->id(),
        'reviewed_at' => now(),
        'review_note' => request('review_note')
    ]);

    // ✅ Notify the admin who submitted the project
    if ($project->manager_id) {
        $admin = User::find($project->manager_id);
        if ($admin) {
            $admin->notify(new ProjectApprovedNotification($project));
        }
    }

    return back()->with('success', 'Project approved and Admin notified!');
}




public function submitted()
{
    $projects = Project::with('tasks', 'manager')
        ->where('status', 'submitted')
        ->latest()
        ->get();

    return view('superadmin.projects.submitted', compact('projects'));
}



public function reject(Project $project)
{
    // ✅ Validate that a note is provided
    request()->validate([
        'review_note' => 'required'
    ]);

    // ✅ Update project status and review fields
    $project->update([
        'status' => 'pending',               // Reset project status to pending
        'review_status' => 'rejected',       // Track review decision
        'reviewed_by' => auth()->id(),
        'reviewed_at' => now(),
        'review_note' => request('review_note')
    ]);

    // ✅ Notify the admin who submitted the project
    if ($project->manager_id) {
        $admin = User::find($project->manager_id);
        if ($admin) {
            $admin->notify(new ProjectRejectedNotification($project));
        }
    }

    return back()->with('error', 'Project rejected and sent back to admin for review!');
}

}











