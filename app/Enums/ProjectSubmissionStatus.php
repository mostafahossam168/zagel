<?php

namespace App\Enums;

enum ProjectSubmissionStatus: string
{
    case NEW      = 'new';
    case REVIEWED = 'reviewed';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    public function name(): string
    {
        return match($this) {
            ProjectSubmissionStatus::NEW      => 'جديد',
            ProjectSubmissionStatus::REVIEWED => 'تمت المراجعة',
            ProjectSubmissionStatus::ACCEPTED => 'مقبول',
            ProjectSubmissionStatus::REJECTED => 'مرفوض',
        };
    }

    public function color(): string
    {
        return match($this) {
            ProjectSubmissionStatus::NEW      => 'bg-info',
            ProjectSubmissionStatus::REVIEWED => 'bg-warning',
            ProjectSubmissionStatus::ACCEPTED => 'bg-success',
            ProjectSubmissionStatus::REJECTED => 'bg-danger',
        };
    }
}
