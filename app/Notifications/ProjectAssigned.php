<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectAssigned extends Notification
{
    use Queueable;

    public $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    // ✅ Channels
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    // ✅ Email Notification
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Project Assigned')
            ->greeting('Hello ' . $notifiable->name)
            ->line('A new project has been assigned to you.')
            ->line('Project: ' . $this->project->title)
            ->action('View Project', url('/admin/projects/' . $this->project->id))
            ->line('Thank you.');
    }

    // ✅ Dashboard Notification
    public function toDatabase($notifiable)
    {
        return [
            'project_id' => $this->project->id,
            'title'      => $this->project->title,
            'message'    => 'A new project has been assigned to you.',
        ];
    }
}
