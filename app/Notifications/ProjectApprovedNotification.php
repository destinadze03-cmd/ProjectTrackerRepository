<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectApprovedNotification extends Notification
{
    use Queueable;

    public $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $superadminName = $this->project->creator ? $this->project->creator->name : 'SuperAdmin';
        $adminName = $this->project->manager ? $this->project->manager->name : 'Admin';

        return (new MailMessage)
            ->subject('Project Approved')
            ->greeting("Hello {$adminName},")
            ->line("Your submitted project has been approved by {$superadminName}.")
            ->line('Project: ' . $this->project->title)
            ->line('Project Description: ' . $this->project->description)
            ->action('View Project', url('/admin/projects/' . $this->project->id))
            ->line('Good job!');
    }

    public function toDatabase($notifiable)
    {
        $superadminName = $this->project->creator ? $this->project->creator->name : 'SuperAdmin';
        $adminName = $this->project->manager ? $this->project->manager->name : 'Admin';

        return [
            'project_id' => $this->project->id,
            'title' => $this->project->title,
            'message' => "Your submitted project has been approved by {$superadminName}.",
        ];
    }
}
