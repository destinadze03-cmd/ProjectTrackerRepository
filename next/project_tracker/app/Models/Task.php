<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'assigned_to',
        'title',
        'description',
        'duration',
        'start_date',
        'end_date',
        'status',
    ];

    // Task belongs to project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Task assigned to staff
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Task has many updates
    public function updates()
    {
        return $this->hasMany(TaskUpdate::class);
    }
}
