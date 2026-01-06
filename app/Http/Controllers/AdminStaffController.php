<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminStaffController extends Controller
{
    /**
     * Display all staff users
     */
    public function index()
    {
        $staff = User::where('role', 'staff')->get();
        return view('admin.staff.index', compact('staff'));
    }

    /**
     * Show the staff creation form
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store new staff user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:4'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'staff', // 👈 most important part
        ]);

        return redirect()->route('admin.staff.index')
                         ->with('success', 'Staff created successfully!');
    }
//am dding this 
    public function edit($id)
{
    $staff = User::findOrFail($id);
    return view('admin.staff.edit', compact('staff'));
}

public function update(Request $request, $id)
{
    $staff = User::findOrFail($id);

    $staff->update([
        'name'  => $request->name,
        'email' => $request->email,
        'role'  => $request->role,
    ]);

    return redirect()->route('admin.staff.index')
                     ->with('success', 'Staff updated successfully!');
}

public function destroy($id)
{
    $staff = User::findOrFail($id);
    $staff->delete();

    return redirect()->route('admin.staff.index')
                     ->with('success', 'Staff deleted successfully');
}

}
