<?php

namespace App\Http\Controllers;

use App\Models\User; // Make sure this is imported
use Illuminate\Http\Request;

class SuperAdminStaffController extends Controller
{
    public function view($id)
    {
        // Load staff with projects and tasks
        $staff = User::with(['projects', 'assignedTasks.assignedBy'])->findOrFail($id);

        return view('superadmin.staff.view', compact('staff'));
    }
}
