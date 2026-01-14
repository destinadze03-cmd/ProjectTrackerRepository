<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
// Total count of tasks
    $totalTaskCount = $project->tasks()->count();

    return view(
        'admin.projects.project-tasks',
        compact('project', 'tasks', 'staffs','totalTaskCount')
    );
}

    

    public function store(Request $request)
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

}


