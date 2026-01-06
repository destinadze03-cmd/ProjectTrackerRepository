<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display all projects
     */
    public function index()
    {
        $projects = Project::with('tasks')->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the project creation form
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a new project
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'status' => 'required|string',
    ]);

    Project::create([
        'title' => $request->title,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'status' => $request->status,
    ]);

    return redirect()->route('admin.dashboard')
        ->with('success', 'Project created successfully!');
}

    /**
     * Show a single project and its tasks
     */
    public function show($id)
    {
        $project = Project::with('tasks')->findOrFail($id);

        return view('admin.projects.show', compact('project'));
    }

    /**
     * Edit project
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);

        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update project
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::findOrFail($id);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.projects.show', $project->id)
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Delete project
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}
