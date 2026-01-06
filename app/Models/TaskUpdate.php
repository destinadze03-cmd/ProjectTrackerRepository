<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskUpdate extends Model
{
    use HasFactory;

     protected $table = 'task_updates';

    protected $fillable = [
        'task_id',
        'user_id',
        'status',
        'note',
        'screenshot',
        'end_date'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function latestUpdate()
{
    return $this->hasOne(TaskUpdate::class)->latestOfMany();
}

}