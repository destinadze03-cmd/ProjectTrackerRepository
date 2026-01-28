<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskUpdate;
use Illuminate\Http\Request;




use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TasksImport;


use App\Notifications\TaskSubmitted;




class StaffTaskController extends Controller
{
    // Display all tasks assigned to the logged-in staff
  public function index()
{
    $user = auth()->user();

    // Get tasks assigned to this user, most recent first
 $tasks = Task::where('assigned_to', $user->id)
             ->orderBy('created_at', 'desc')          // newest first
             ->orderByRaw("FIELD(status, 'pending', 'done')")  // pending before done if created_at is same
             ->get();



    // Count unread notifications
    $unreadCount = $user->unreadNotifications()->count();

    // Get latest 10 notifications
    $notifications = $user->notifications()->latest()->take(10)->get();

    return view('Staff.tasks.index', compact('tasks', 'unreadCount', 'notifications'));
}
public function indexs()
{
    $user = auth()->user();

    $tasks = Task::where('assigned_to', $user->id)->get();

    $unreadCount = $user->unreadNotifications()->count();
    $notifications = $user->notifications()->latest()->take(10)->get(); // last 10

    return view('Staff.tasks.index', compact('tasks', 'unreadCount', 'notifications'));
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
    $staff = auth()->user();

    // Tasks assigned to this staff
    $tasks = Task::where('assigned_to', $staff->id)->get();

    // Notifications (latest first)
    $notifications = $staff->notifications()->latest()->get();

    // Optional: unread count (for bell icon 🔔)
    $unreadCount = $staff->unreadNotifications()->count();

    return view('staff.dashboard', compact(
        'tasks',
        'notifications',
        'unreadCount'
    ));
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


    public function markNotificationRead($id)
{
    $notification = auth()->user()->notifications()->find($id);

    if ($notification) {
        $notification->markAsRead();
    }

    return redirect()->back();
}


public function import(Request $request)
{


    $request->validate([
        'excel_file' => 'required|mimes:xlsx,xls,csv'
    ]);

    Excel::import(new TasksImport, $request->file('excel_file'));

    return back()->with('success', 'Imported');
}




public function submitTask(Request $request, $id)
{
    $task = Task::findOrFail($id);

    // Save submission
    $task->status = 'done';
    $task->staff_comment = $request->staff_comment ?? null;
    $task->save();

    // Find supervisor/admin
    $supervisor = $task->supervisor;

    // DEBUG: check if supervisor exists
    if (!$supervisor) {
        dd('Supervisor not found', $task->supervised_by);
    }

    // Send email notification
    $supervisor->notify(new TaskSubmitted($task));

    return back()->with('success', 'Task submitted and supervisor notified!');
}



}
