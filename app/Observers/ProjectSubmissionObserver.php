<?php

namespace App\Observers;

use App\Models\ProjectSubmission;
use App\Models\User;
use App\Notifications\NewProjectSubmissionNotification;

class ProjectSubmissionObserver
{
    public function created(ProjectSubmission $submission): void
    {
        User::admins()->get()->each(
            fn($admin) => $admin->notify(new NewProjectSubmissionNotification($submission))
        );
    }
}
