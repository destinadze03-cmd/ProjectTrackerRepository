<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Show the form to create a task under a project
     */
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);

        // Load staff users
        $staff = User::where('role', 'staff')->get();

        return view('admin.tasks.create', compact('project', 'staff'));
    }

    /**
     * Store a new task
     */
    public function store(Request $request, $projectId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'assigned_to' => 'nullable|integer|exists:users,id',
            'status' => 'required|string'
        ]);

        Task::create([
            'project_id' => $projectId,
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'assigned_to' => $request->assigned_to,
            'status' => $request->status
        ]);

        return redirect()->route('admin.projects.show', $projectId)
            ->with('success', 'Task created successfully!');
    }

    
}
