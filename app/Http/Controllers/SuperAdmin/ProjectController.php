<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Auth;

use App\Notifications\ProjectAssigned;


class ProjectController extends Controller
{
    public function dashboard()
    {
        return view('superadmin.dashboard');
    }

    public function index()
    {
        $projects = Project::with(['manager', 'client'])->get();
        $admins = User::where('role', 'admin')->get();

        return view('superadmin.projects.index', compact('projects', 'admins'));
    }
public function store(Request $request)
{
    // 1️⃣ Validate input
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'duration' => 'required|integer',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'manager_id' => 'required|exists:users,id', // ensure admin exists
        'client_name' => 'nullable|string|max:255',
        'status' => 'nullable|string'
    ]);

    // 2️⃣ Create project
    $project = Project::create([
        'title' => $request->title,
        'description' => $request->description,
        'duration' => $request->duration,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'manager_id' => $request->manager_id,
        'client_name' => $request->client_name,
        'status' => $request->status ?? 'pending',
        'created_by' => Auth::id(),
    ]);

    // 3️⃣ Notify assigned admin
    $admin = User::find($request->manager_id);
    if ($admin) {
        $admin->notify(new ProjectAssigned($project));
    }

    return redirect()->back()->with('success', 'Project created successfully and Admin notified by email.');
}

    public function show($id)
    {
        $project = Project::with(['manager', 'client'])->findOrFail($id);
        return view('superadmin.projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $admins = User::where('role', 'admin')->get();

        return view('superadmin.projects.edit', compact('project', 'admins'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $project->update($request->all());

        return redirect()->route('superadmin.projects.index')
                         ->with('success', 'Project updated successfully.');
    }

    public function report($id)
    {
        $project = Project::with(['tasks.assignedTo', 'manager'])->findOrFail($id);

        return view('superadmin.projects.report', compact('project'));
    }

    public function destroy($id)
    {
        Project::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Project deleted successfully.');
    }
}
