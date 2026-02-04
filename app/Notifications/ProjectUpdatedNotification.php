<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectUpdatedNotification extends Notification
{
    use Queueable;

    public $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    // ✅ Send via email + dashboard
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    // ✅ Email message
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Project Updated')
            ->greeting('Hello ' . $notifiable->name)
            ->line('A project assigned to you has been updated.')
            ->line('Project Title: ' . $this->project->title)
            ->line('Project Description: ' . $this->project->description)

            ->action('View Project', url('/admin/projects/' . $this->project->id))
            ->line('Please login to see the changes.');
    }

    // ✅ Dashboard notification
    public function toDatabase($notifiable)
    {
        return [
            'project_id' => $this->project->id,
            'title'      => $this->project->title,
            'message'    => 'A project assigned to you has been updated.',
        ];
    }
}
