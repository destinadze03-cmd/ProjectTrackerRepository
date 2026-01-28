<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class TaskSubmitted extends Notification
{
    use Queueable;

    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject('Task Submitted by Staff')
        ->greeting('Hello ' . $notifiable->name)
        ->line('A staff member has submitted the task you supervise.')
        ->line('Task Title: ' . $this->task->title)
        ->line('Submitted By: ' . $this->task->assignedTo->name)
        ->line('Staff Report: ' . ($this->task->staff_comment ?? 'No comment'))
        ->action('View Task', url('/admin/tasks/' . $this->task->id))
        ->line('Thank you for using Project Tracker.');
}

}
