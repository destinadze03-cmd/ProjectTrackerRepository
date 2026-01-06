<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Auth;

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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'duration' => 'required|integer',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'client_name' => $request->client_name,
            'manager_id' => $request->manager_id,
            'client_id' => null,
            'duration' => $request->duration,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'created_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Project created successfully.');
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
