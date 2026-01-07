<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Project; 
use App\Models\Task;
class SuperAdminController extends Controller
{
    // Show admin management page
    public function admins()
    {
        $admins = User::where('role', 'admin')->get();
        $staff = User::where('role', 'staff')->get();

        return view('superadmin.admins.index', compact('admins', 'staff'));
    }

    // Create a new admin
    public function createAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'New Admin Created Successfully');
    }

    // Convert existing staff to admin
    public function convertStaffToAdmin($id)
    {
        $staff = User::findOrFail($id);
        
        if ($staff->role !== 'staff') {
            return back()->with('error', 'User is not a staff');
        }

        $staff->role = 'admin';
        $staff->save();

        return back()->with('success', 'Staff converted to Admin successfully');

    }
    
    public function indexAdmins()
    {
    // Load all admins + staff that can be converted
    $admins = User::where('role', 'admin')->get();
    $staff = User::where('role', 'staff')->get();

    return view('superadmin.admins.index', compact('admins', 'staff'));
    }


 // make sure this exists

public function dashboard()
{
    $totalAdmins = User::where('role', 'admin')->count();
    $totalStaff = User::where('role', 'staff')->count();
    $totalProjects = Project::count();
    $TotalTasks = Task::count();
    $submittedTasks = Task::where('status', 'submitted')->count(); // or whatever status you use
    $CompletedTasks = Task::where('status', 'done')->count(); // or whatever status you use
    $PendingTasks = Task::where('status', 'pending')->count(); // or whatever status you use
    $ValidatedTasks = Task::where('review_status', 'validated')->count(); // or whatever status you use
    return view('superadmin.dashboard', compact(
        'totalAdmins',
        'totalStaff',
        'totalProjects',
        'submittedTasks',
         'TotalTasks',
         'CompletedTasks',
         'PendingTasks',
         'ValidatedTasks'
    ));
}

public function tasks()
{
    $tasks = Task::with(['project.manager', 'assignedStaff'])->get();
    return view('superadmin.task.index', compact('tasks'));
}



public function validatedTasks()
{
    $tasks = Task::with(['project.manager', 'assignedStaff','updates'])
        ->where('review_status', 'validated')
        ->get();

    return view('superadmin.task.validatedtasks', compact('tasks'));
}


public function completeTasks()
{
    $tasks = Task::with(['project.manager', 'assignedStaff'])
        ->where('status', 'done') // or 'completed' depending on your DB
        ->get();

    return view('superadmin.task.completedtask', compact('tasks'));
}



public function pendingTasks()
{
    $tasks = Task::with(['project.manager', 'assignedStaff','latestUpdate'])
        ->where('status', 'pending')
        ->get();

    return view('superadmin.task.pendingtask', compact('tasks'));
}




public function submittedTasks()
{
    $tasks = Task::with(['project.manager', 'assignedStaff'])
        ->where('status', 'Done')
        ->get();

    return view('superadmin.task.submittedtask', compact('tasks'));
}


public function totalProjects()
{
    $projects = Project::with(['manager', 'tasks'])->get();
    return view('superadmin.projects.projectpage', compact('projects'));
}




public function totalStaff()
{
    $staff = User::where('role', 'staff')
                 ->with(['assignedTasks', 'projects']) // eager load relationships
                 ->get();

    $totalStaff = $staff->count(); // optional, if you want to pass to dashboard cards

    return view('superadmin.staff.staffpage', compact('staff', 'totalStaff'));
}



public function totalAdmins()
{
    $admins = User::where('role', 'admin')
        ->with(['managedProjects.tasks'])
        ->get();

    return view('superadmin.admins.adminpage', compact('admins'));
}

public function viewAdminProjects(User $admin)
{
    // Get all projects assigned to this admin
    $projects = $admin->managedProjects()->get();

    // Pass both admin and projects to the view
    return view('superadmin.admins.admin_projects', compact('admin', 'projects'));
}



public function show($id) {
    $staff = User::with(['projects', 'assignedTasks.assignedBy'])->findOrFail($id);
    return view('superadmin.staff.show', compact('staff'));
}








public function viewStaff(User $staff)
{
    $staff->load(['projects', 'assignedTasks']); // eager load
    return view('superadmin.staff.view', compact('staff'));
}



public function stafftaskview($id)
{
    $task = Task::with(['project.manager', 'assignedStaff'])->findOrFail($id);
    return view('superadmin.task.viewtask', compact('task'));
}

public function tracktask($id)
{
    $task = Task::with([
        'project.manager',      // Project and its manager
        'assignedStaff',        // The staff assigned to this task
        'assignedBy'            // Who assigned the task
    ])->findOrFail($id);

    return view('superadmin.task.tracktask', compact('task'));
}



}







































































 // logi implementing normalizer_get_raw_decomposition



 

