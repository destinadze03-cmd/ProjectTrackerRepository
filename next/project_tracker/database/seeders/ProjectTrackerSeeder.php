<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class ProjectTrackerSeeder extends Seeder
{
    public function run()
    {
        // Admin
        $admin = User::create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Staff
        $staff = User::create([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => bcrypt('password'),
            'role' => 'staff',
        ]);

        // Project
        $project = Project::create([
            'title' => 'Website Development',
            'description' => 'Full website redesign',
            'start_date' => '2025-01-01',
            'end_date' => '2025-03-01',
            'status' => 'ongoing',
        ]);

        // Task
        Task::create([
            'project_id' => $project->id,
            'assigned_to' => $staff->id,
            'title' => 'Build Landing Page',
            'description' => 'Design and develop landing page',
            'duration' => 5,
            'start_date' => '2025-01-05',
            'end_date' => '2025-01-10',
            'status' => 'pending',
        ]);
    }
}
