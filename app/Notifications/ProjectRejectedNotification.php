<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectRejectedNotification extends Notification
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
        $superadminName = $this->project->creator ? $this->project->creator->name : 'SuperAdmin';
        $adminName = $this->project->manager ? $this->project->manager->name : 'Admin';

        return (new MailMessage)
            ->subject('Project Rejected')
            ->greeting("Hello {$adminName},")
            ->line("Your submitted project has been rejected by {$superadminName}.")
            ->line('Project: ' . $this->project->title)
            ->line('Reason/Note: ' . $this->project->review_note)
            ->action('View Project', url('/admin/projects/' . $this->project->id))
            ->line('Please review the note and resubmit if necessary.');
    }

    // Dashboard notification
    public function toDatabase($notifiable)
    {
        $superadminName = $this->project->creator ? $this->project->creator->name : 'SuperAdmin';
        $adminName = $this->project->manager ? $this->project->manager->name : 'Admin';

        return [
            'project_id' => $this->project->id,
            'title' => $this->project->title,
            'message' => "Your submitted project has been rejected by {$superadminName}. Reason: {$this->project->review_note}",
        ];
    }
}
