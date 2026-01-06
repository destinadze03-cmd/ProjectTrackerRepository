<?php

namespace App\Models;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // keep role here because your users table migration has it
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /*
      Tasks assigned to this user (via tasks.assigned_to).
     
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    /**
     * Task updates made by this user.
     */
    public function taskUpdates()
    {
        return $this->hasMany(TaskUpdate::class, 'user_id');
    }

 /**
     * Helper: is this user a superadmin?
     */
 public function isSuperAdmin():bool
 { 
    return $this->role === 'super_admin'; 
}



    /**
     * Helper: is this user an admin?
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Helper: is this user a staff?
     */
    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }



    /* User.php
public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }*/

    /*
      Projects assigned to this staff (optional)
     
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user', 'user_id', 'project_id');
    }*/



    public function managedProjects()
    {
        return $this->hasMany(Project::class, 'manager_id');
    }

    // Tasks an admin creates
   public function createdAssignedTasks()
{
    return $this->hasMany(Task::class, 'created_by')
                ->whereNotNull('assigned_to');
}


    /* ================= STAFF ================= */

    // Tasks assigned to staff
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    // Projects assigned to staff
    public function projects()
{
    return $this->hasMany(Project::class, 'manager_id');
}


    // Task.php
public function assignedBy() {
    return $this->belongsTo(User::class, 'assigned_by'); // 'assigned_by' is the admin's user_id
}



}
