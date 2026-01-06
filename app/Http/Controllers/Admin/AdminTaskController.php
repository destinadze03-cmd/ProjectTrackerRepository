<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminTaskController extends Controller
{
    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        // Security check: project must belong to this admin
        $project = Project::where('id', $request->project_id)
            ->where('manager_id', auth()->id())
            ->firstOrFail();

        Task::create([
            'project_id' => $project->id,
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'created_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Task created successfully.');
    }

    // Approve a task
    


    public function approve(Task $task)
    {
        // Ensure admin manages the project
        abort_if($task->project->manager_id !== Auth::id(), 403);

        // Update review_status and task status
        $task->review_status = 'validated';
        $task->status = 'done'; // automatically mark done
        $task->review_note = 'Approved by admin';
        $task->reviewed_by = Auth::id();
        $task->save();

        return redirect()->back()->with('success', 'Task approved and marked as done.');
    }

    // Reject a task
    public function reject(Request $request, Task $task)
    {
        $request->validate([
            'note' => 'required|string|max:255',
        ]);

        // Ensure admin manages the project
        abort_if($task->project->manager_id !== Auth::id(), 403);

        // Update review_status and task status
        $task->review_status = 'rejected';
        $task->status = 'pending'; // reset to pending
        $task->review_note = $request->note;
        $task->reviewed_by = Auth::id();
        $task->save();

        return redirect()->back()->with('success', 'Task rejected and reset to pending.');
    }
}


