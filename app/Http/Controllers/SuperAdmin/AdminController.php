<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
{
    $admins = User::where('role', 'admin')
        ->withCount('managedProjects') // counts total projects
        ->get();

    return view('superadmin.admins.adminpage', compact('admins'));
}

}
