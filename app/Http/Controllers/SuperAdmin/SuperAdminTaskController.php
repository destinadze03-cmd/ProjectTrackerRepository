<?php



namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;


use App\Http\Controllers\SuperAdmin\SuperAdminProjectController;
use App\Http\Controllers\SuperAdmin\ProjectController as SAProjectController;

class SuperAdminTaskController extends Controller
{
    // Display a list of tasks (optional)
    public function index()
    {
        $tasks = Task::with('assignedTo', 'project')->get();
        return view('superadmin.task.index', compact('tasks'));
    }

    // Show create task form
   

    // Store task
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'assigned_to' => 'required|exists:users,id',
            'supervisor' => 'nullable|exists:users,id',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task = new Task();
        $task->title = $validated['title'];
        $task->description = $validated['description'] ?? null;
        $task->start_date = $validated['start_date'];
        $task->end_date = $validated['end_date'];
        $task->status = $validated['status'];
        $task->project_id = $project->id;
        $task->assigned_to = $validated['assigned_to'];
        $task->supervised_by = $validated['supervisor'] ?? null;
        $task->save();


    

        return redirect()->route('superadmin.projects.show', $project->id)
                         ->with('success', 'Task created successfully!');
    }
















     public function create(Project $project)
    {
        // Get all staff
        $staff = User::where('role', 'staff')->get();

        // Get all admins
        $admins = User::where('role', 'admin')->get();

        // Pass variables to the view
        return view('superadmin.task.create', compact('project', 'staff', 'admins'));
    }

    

    public function show($id)
    {
        //
    }
}



