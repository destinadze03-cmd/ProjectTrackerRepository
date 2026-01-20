<?php

namespace App\Http\Controllers\Admin;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 

// Display all tasks submitted as done
  // Show all tasks submitted as done and still pending review (dashboard)
public function staffupdate()
{
    $tasks = Task::where('status', 'done')               // Task completed by staff
                 ->where('review_status', 'pending')    // Review is still pending
                 ->whereHas('project', fn($q) => $q->where('manager_id', auth()->id())) // Only tasks for admin's projects
                 ->with('assignedStaff', 'project')     // Eager load relations
                 ->latest()
                 ->get();

    return view('admin.staff.update', compact('tasks'));
}


    // Show full task details for admin
    public function showTaskDetail(Task $task)
    {
        // Only allow admin of the project
        if ($task->project->admin_id != auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $task->load('assignedStaff','project');

        return view('admin.staff.task-detail', compact('task'));
    }

    // Approve or reject the task
   public function review(Request $request, Task $task)
{
    // Ensure only the admin who owns the project can review
    if ($task->project->manager_id != auth()->id()) { // adjust if your column is admin_id
        abort(403, 'Unauthorized');
    }

    $request->validate([
        'review_status' => 'required|in:validated,rejected',
        'review_note' => 'nullable|string|max:500',
    ]);

    if ($request->review_status == 'validated') {
        $task->status = 'done'; // mark task as completed
    } elseif ($request->review_status == 'rejected') {
        $task->status = 'pending'; // revert task to pending
    }

    $task->review_status = $request->review_status;
    $task->review_note = $request->review_note;
    $task->reviewed_by = auth()->id();
    $task->save();

    return redirect()->route('admin.staff.update')
                     ->with('success', 'Task reviewed successfully.');
}


    public function taskDetail($taskId)
{
    $task = \App\Models\Task::with('assignedStaff', 'project')->findOrFail($taskId);

    return view('admin.staff.task-detail', compact('task'));
}

}









