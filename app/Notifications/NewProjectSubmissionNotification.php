<?php

namespace App\Notifications;

use App\Models\ProjectSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewProjectSubmissionNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    public function __construct(public ProjectSubmission $submission) {}

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'مشروع جديد بانتظار المراجعة',
            'body'  => '"' . $this->submission->project_title . '" — مقدم من: ' . $this->submission->name,
            'type'  => 'project_submission',
            'url'   => route('dashboard.project-submissions.show', $this->submission->id),
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title'      => 'مشروع جديد بانتظار المراجعة',
            'body'       => '"' . $this->submission->project_title . '" — مقدم من: ' . $this->submission->name,
            'type'       => 'project_submission',
            'url'        => route('dashboard.project-submissions.show', $this->submission->id),
            'created_at' => now()->toISOString(),
        ]);
    }


}
