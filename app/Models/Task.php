<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

     protected $fillable = [
        'project_id', 'title', 'description', 'duration', 'start_date',
        'end_date', 'assigned_to', 'status', 'review_status',
        'review_note', 'reviewed_by','supervised_by','progress'
    ];

    // A task belongs to a project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // A task is assigned to a specific staff (user)
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // A task has many update records
    public function updates()
    {
        return $this->hasMany(TaskUpdate::class, 'task_id');
    }

    // Get the latest update
    public function latestUpdate()
    {
        return $this->hasOne(TaskUpdate::class, 'task_id')->latestOfMany();
    }



    public function reviewer()
    { 
    return $this->belongsTo(User::class, 'reviewed_by'); 
    }


    public function user()
    {
    return $this->belongsTo(User::class, 'assigned_to');
    }
    
public function staff()
{
    return $this->belongsTo(User::class, 'assigned_to');
}
   public function assignedStaff()
{
    return $this->belongsTo(User::class, 'assigned_to');
}

// Project.php
public function manager() {
    return $this->belongsTo(User::class, 'manager_id');
}

public function tasks() {
    return $this->hasMany(Task::class);
}


public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervised_by');
    }









public function assignedBy() {
    return $this->belongsTo(User::class, 'assigned_by'); // admin id
}

}
