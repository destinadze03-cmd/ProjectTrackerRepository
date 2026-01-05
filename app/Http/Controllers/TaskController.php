<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\TaskUpdate;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Show form to create a task
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);
        $staff = User::where('role', 'staff')->get();

        return view('admin.tasks.create', compact('project', 'staff'));
    }

    // Store a new task
    public function store(Request $request, $projectId)
    {
        $request->validate([
            'title' => 'required|string',
            'assigned_to' => 'nullable|exists:users,id'
        ]);

        Task::create([
            'project_id' => $projectId,
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'assigned_to' => $request->assigned_to,
            'status' => 'pending'
        ]);

        return redirect()
            ->route('projects.show', $projectId)
            ->with('success', 'Task created successfully!');
    }

    // Staff submits a task update
    public function updateProgress(Request $request, $taskId)
    {
        $request->validate([
            'status' => 'required|in:pending,active,completed',
            'note' => 'nullable|string',
            'end_date' => 'nullable|date',
            'screenshot' => 'nullable|image'
        ]);

        $screenshot = null;

        if ($request->hasFile('screenshot')) {
            $screenshot = time() . '_' . $request->file('screenshot')->getClientOriginalName();
            $request->file('screenshot')->move(public_path('task_screenshots'), $screenshot);
        }

        // Save update into task_updates table
        TaskUpdate::create([
            'task_id' => $taskId,
            'user_id' => auth()->id(),
            'status' => $request->status,
            'note' => $request->note,
            'screenshot' => $screenshot,
            'end_date' => $request->end_date
        ]);

        // Update main task status to match latest update
        Task::where('id', $taskId)->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Task updated successfully!');
    }

    // ============ FILTER PAGES USING LATEST UPDATE ===============

    public function active()
    {
        $tasks = Task::whereHas('latestUpdate', function ($query) {
            $query->where('status', 'active');
        })
        ->with(['assignedTo', 'latestUpdate'])
        ->get();

        return view('admin.tasks.active', compact('tasks'));
    }

    public function pending()
    {
        $tasks = Task::whereHas('latestUpdate', function ($query) {
            $query->where('status', 'pending');
        })
        ->with(['assignedTo', 'latestUpdate'])
        ->get();

        return view('admin.tasks.pending', compact('tasks'));
    }

    public function completed()
    {
        $tasks = Task::whereHas('latestUpdate', function ($query) {
            $query->where('status', 'completed');
        })
        ->with(['assignedTo', 'latestUpdate'])
        ->get();

        return view('admin.tasks.completed', compact('tasks'));
    }
}
