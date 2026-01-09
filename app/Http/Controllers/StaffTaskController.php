<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskUpdate;
use Illuminate\Http\Request;

class StaffTaskController extends Controller
{
    // Display all tasks assigned to the logged-in staff
  public function index(Request $request)
{
    $query = Task::where('assigned_to', auth()->id())
                 ->orderBy('created_at', 'desc');

    if ($request->filled('status')) {
        $query->where('review_status', $request->status);
    }

    $tasks = $query->get();

    return view('staff.tasks.index', compact('tasks'));
}


    // Submit task progress update
    public function UpdateTask(Request $request, Task $task)
    {
        $request->validate([
            'note' => 'nullable|string',
            'status' => 'required|in:pending,done',
            'screenshot' => 'nullable|image|max:4096'
        ]);

        $fileName = null;

        if ($request->hasFile('screenshot')) {
            $fileName = time().'_'.$request->screenshot->getClientOriginalName();
            $request->screenshot->move(public_path('task_screenshots'), $fileName);
        }

        TaskUpdate::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'note' => $request->note,
            'screenshot' => $fileName,
            'status' => $request->status,
        ]);

        // update main task status
        $task->update(['status' => $request->status]);

        return back()->with('success', 'Task progress submitted!');
    }
public function dashboard()
{
    $tasks = Task::where('assigned_to', auth()->id())->get();

    return view('staff.dashboard', compact('tasks'));
}

 // DASHBOARD WITH 3 CARDS
    public function dashboards()
    {
        $pendingCount = Task::where('assigned_to', Auth::id())
            ->where('review_status', 'pending')
            ->count();

        $validatedCount = Task::where('assigned_to', Auth::id())
            ->where('review_status', 'validated')
            ->count();

        $rejectedCount = Task::where('assigned_to', Auth::id())
            ->where('review_status', 'rejected')
            ->count();

        return view('staff.tasks.dashboard', compact(
            'pendingCount',
            'validatedCount',
            'rejectedCount'
        ));
    }

    // SHOW TASKS BY STATUS
    public function tasksByStatus($status)
    {
        abort_unless(in_array($status, ['pending', 'validated', 'rejected']), 404);

        $tasks = Task::where('assigned_to', Auth::id())
            ->where('review_status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('staff.tasks.by-status', compact('tasks', 'status'));
    }
}
