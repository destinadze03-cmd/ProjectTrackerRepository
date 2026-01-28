<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskAssigned;

class AdminTaskController extends Controller
{
    // Store a new task
    public function storee(Request $request)
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

    public function create()
{
    // Get all projects managed by this admin
    $projects = Project::where('manager_id', auth()->id())->get();

    return view('admin.tasks.create-tasks', compact('projects'));
}


 public function createTasks(Request $request)
{
    // Only admin's projects
    $projects = Project::where('manager_id', auth()->id())->get();

    $query = Task::whereHas('project', function ($q) {
        $q->where('manager_id', auth()->id());
    });

    // Filter by project
    if ($request->filled('project_id')) {
        $query->where('project_id', $request->project_id);
    }

    // Search by task title
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    $tasks = $query->latest()->get();

    return view('admin.tasks.create-tasks', compact('tasks', 'projects'));
}
      // View tasks under a specific project
    public function projectTasks($projectId)
{
    // Ensure project belongs to this admin
    $project = Project::where('id', $projectId)
        ->where('manager_id', auth()->id())
        ->firstOrFail();

    // Tasks under this project
    $tasks = Task::where('project_id', $project->id)
        ->latest()
        ->take(10)
        ->get();






      
    // Staff list
    $staffs = User::where('role', 'staff')->get();

    // Fetch all admin users
    $admins = User::where('role', 'admin')->get();
// Total count of tasks
    $totalTaskCount = $project->tasks()->count();

    return view(
        'admin.projects.project-tasks',
        compact('project', 'tasks', 'staffs','admins','totalTaskCount')
    );
}

    

    public function storeee(Request $request)
{
    $request->validate([
        'project_id' => 'required|exists:projects,id',
        'title' => 'required|string|max:255',
    ]);

    Task::create([
        'project_id' => $request->project_id,
        'title' => $request->title,
        'description' => $request->description,
        'status' => $request->status ?? 'pending',
        'created_by' => auth()->id(),
    ]);

    return back()->with('success', 'Task created successfully.');
}










public function store(Request $request)
{
    // Validate input
    $data = $request->validate([
        'project_id' => 'required|exists:projects,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'assigned_to' => 'required|exists:users,id',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'duration' => 'nullable|integer',
    ]);

    // Set supervised_by automatically to the current admin
    $data['supervised_by'] = auth()->id();

    // Save task
    $task = Task::create($data);

    // 🔔 NOTIFY assigned staff
    $assignedUser = User::find($data['assigned_to']);
    if ($assignedUser) {
        $assignedUser->notify(new TaskAssigned($task));
    }

    return redirect()
        ->route('admin.projects.project-tasks', $data['project_id'])
        ->with('success', 'Task created successfully and staff notified!');
}














public function index(Request $request, Project $project)
{
    $tasks = $project->tasks(); // relationship

    if ($request->status) {
        $tasks->where('status', $request->status);
    }

    return view('admin.tasks.index', [
        'project' => $project,
        'tasks' => $tasks->get(),
    ]);
}
 

 public function show(Task $task)
    {
        // Route model binding automatically injects the Task
        return view('Admin.tasks.show-task-detail', compact('task'));
    }
    

    



















   public function completedtask(Project $project)
{
    $tasks = $project->tasks()
        ->where('review_status', 'validated')
        ->get();

    return view('admin.Tasks.completed', compact('project', 'tasks'));
}
public function pendingtask(Project $project)
{
    $tasks = $project->tasks()
        ->where('status', 'pending')
        ->get();

    return view('admin.Tasks.completed', compact('project', 'tasks'));
}










/* app/Http/Controllers/Admin/TaskController.php

public function edite(Task $task)
{
    return view('admin.projects.project-tasks', [
        'project' => $task->project,
        'tasks' => $task->project->tasks()->latest()->take(10)->get(),
        'totalTaskCount' => $task->project->tasks()->count(),
        'staffs' => User::where('role', 'staff')->get(),
        'editTask' => $task, // 👈 IMPORTANT
    ]);
}*/

public function update(Request $request, Task $task)
{
    $task->update($request->all());

    return redirect()
        ->route('admin.projects.tasks.edit', $task->id)
        ->with('success', 'Task updated successfully');
}






public function edit($id)
{
    $editTask = Task::findOrFail($id);

    // Get the project
    $project = $editTask->project;

    // Get all tasks for this project
    $tasks = $project->tasks()->latest()->get();

    // Count total tasks
    $totalTaskCount = $project->tasks()->count();

    // Staff & admin lists
    $staffs = User::where('role', 'staff')->get();
    $admins = User::where('role', 'admin')->get();

    return view(
        'Admin.projects.project-tasks',
        compact(
            'project',
            'tasks',
            'staffs',
            'admins',
            'editTask',
            'totalTaskCount'
        )
    );
}



}


