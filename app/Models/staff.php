<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    use HasFactory;

    public function assignedTasks() {
    return $this->hasMany(Task::class, 'assigned_to');
}

public function projects() {
    return $this->belongsToMany(Project::class, 'project_user', 'user_id', 'project_id');
}
}
