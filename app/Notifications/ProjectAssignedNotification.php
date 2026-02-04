<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectAssignedNotification extends Notification
{
    use Queueable;

    public $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    // Send via email + database
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    // Email notification
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Project Assigned')
            ->greeting('Hello ' . $notifiable->name)
            ->line('A new project has been assigned to you.')
            ->line('Project Title: ' . $this->project->title)
            ->line('Project Description: ' . $this->project->description)
            ->line('Project start Date: ' . $this->project->start_date)
            ->line('Project End Date: ' . $this->project->end_date)
            ->action('View Project', url('/admin/projects/' . $this->project->id))
            ->line('Please login to see the details.');
    }

    // Dashboard notification
    public function toDatabase($notifiable)
    {
        return [
            'project_id' => $this->project->id,
            'title' => $this->project->title,
            'message' => 'You have been assigned a new project.',
        ];
    }
}
