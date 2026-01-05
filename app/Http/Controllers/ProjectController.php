<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Task;

class ProjectController extends Controller
{
    // Show all projects
    public function index()
    {
        $projects = Project::with('client')->latest()->get();
        return view('admin.projects.index', compact('projects'));
    }


    
    // Show project creation form
    public function create()
    {
        $clients = Client::all(); // You need clients to attach to project
        return view('admin.projects.create', compact('clients'));
    }

    // Store project
    public function storee(Request $request)
    {
        $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'title'       => 'required',
            'description' => 'nullable',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'status'      => 'required'
        ]);

        Project::create($request->all());

        return redirect()->route('admin/projects.index')->with('success', 'Project created successfully');
    }










    

public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'duration' => 'nullable|integer',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'client_id' => 'nullable|integer'
    ]);

    // VERY IMPORTANT – Without this, nothing will save
    $data['created_by'] = auth()->id();

    Project::create($data);

    return redirect()->route('projects.index')->with('success', 'Project created successfully!');
}







    // Edit project
    public function edite($id)
    {
        $project = Project::findOrFail($id);
        $clients = Client::all();

        return view('admin.projects.edit', compact('project', 'clients'));
    }


    public function edit($id)
{
    $project = Project::findOrFail($id);
    return view('admin/projects.edit', compact('project'));
}

    // Update project
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'title'       => 'required',
            'description' => 'nullable',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'status'      => 'required'
        ]);

        $project = Project::findOrFail($id);
        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }

    // Delete project
    public function destroy($id)
    {
        Project::findOrFail($id)->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }







    public function show($id)
{
    $project = Project::findOrFail($id);
    return view('admin.projects.show', compact('project'));
}


    
// am adding  project report funtion here









public function report($id)
{
    $project = Project::with(['tasks.user'])->findOrFail($id); // eager load tasks and users if relation exists

    // get tasks for this project (if you keep tasks in a separate model)
    $tasks = $project->tasks ?? Task::where('project_id', $id)->get();

    $totalTasks = $tasks->count();
    $completed  = $tasks->where('status', 'done')->count();
    $active     = $tasks->where('status', 'active')->count();
    $pending    = $tasks->where('status', 'pending')->count();

    return view('admin.projects.report', compact(
        'project', 'tasks', 'totalTasks', 'completed', 'active', 'pending'
    ));
}

}
