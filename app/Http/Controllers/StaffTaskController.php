<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskUpdate;
use Illuminate\Http\Request;

class StaffTaskController extends Controller
{
    // Display all tasks assigned to the logged-in staff
    public function index()
    {
        $tasks = Task::where('assigned_to', auth()->id())->get();
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


}
