<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class AdminTaskReviewController extends Controller
{
    /**
     * Show staff updates for tasks created by this admin
     */
    public function index()
    {
        $tasks = Task::where('created_by', Auth::id())
            ->with(['assignedUser'])
            ->latest()
            ->get();

        return view('admin.tasks.reviews', compact('tasks'));
    }

    /**
     * View a single task update
     */
    public function show(Task $task)
    {
        // Security check
        if ($task->created_by !== Auth::id()) {
            abort(403);
        }

        return view('admin.tasks.review-show', compact('task'));
    }
}
