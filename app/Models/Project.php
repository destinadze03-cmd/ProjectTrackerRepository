<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',            // required
        'description',      // required
        'duration',         // optional
        'start_date',       // optional
        'end_date',         // optional
        'manager_id',       // admin assigned to manage
        'client_id',        // optional, references Client
        'client_name',      // optional, convenience field
        'status',           // pending, active, completed
        'created_by',       // admin/superadmin who created
    ];

    /**
     * A project has many tasks
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * The admin assigned to manage this project
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * A project belongs to a client
     */
    public function clients()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * The admin/superadmin who created this project
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }



public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }






  

}
