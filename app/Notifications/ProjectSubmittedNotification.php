<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectSubmittedNotification extends Notification
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

    // Email notification
    public function toMail($notifiable)
    {
        $adminName = $this->project->manager ? $this->project->manager->name : 'Admin';

        return (new MailMessage)
            ->subject('Project Submitted')
            ->greeting('Hello ' . $notifiable->name)
            ->line("The project you assigned has been submitted by admin: {$adminName}.")
            ->line('Project: ' . $this->project->title)
            ->line('Project Description: ' . $this->project->description)
            ->line('Project Start Date: ' . $this->project->start_date)
            ->line('Project End Date: ' . $this->project->end_date)
            ->action('View Project', url('/superadmin/projects/' . $this->project->id))
            ->line('Please review the submission.');
    }

    // Dashboard notification
    public function toDatabase($notifiable)
    {
        $adminName = $this->project->manager ? $this->project->manager->name : 'Admin';

        return [
            'project_id' => $this->project->id,
            'title' => $this->project->title,
            'message' => "The project has been submitted by admin: {$adminName}.",
        ];
    }
}
