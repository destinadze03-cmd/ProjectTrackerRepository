<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Task;

class TaskAssigned extends Notification
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
{
    return ['mail', 'database']; // add 'database' channel
}
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Task Assigned')
                    ->greeting('Hello ' . $notifiable->first_name)
                    ->line('A new task has been assigned to you.')
                    ->line('Task Title: ' . $this->task->title)
                    ->line('End Date: ' . ($this->task->end_date ? now()->parse($this->task->end_date)->format('d M Y') : 'N/A'))
                    ->action('View Task', url('/staff/tasks/'.$this->task->id))
                    ->line('Thank you for your hard work!');
    }

    public function toDatabase($notifiable)
{
    return [
        'task_id' => $this->task->id,
        'title' => $this->task->title,
        'Due_date' => $this->task->end_date ?now()->parse( $this->task->end_date)->format('d M Y') : null,
        'message' => 'A new task has been assigned to you.',
    ];
}
}
