<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Relationship: User has many tasks assigned
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }
}
