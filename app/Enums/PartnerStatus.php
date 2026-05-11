<?php

namespace App\Enums;

enum PartnerStatus: string
{
    case PUBLISHED = 'published';
    case DRAFT     = 'draft';

    public function name(): string
    {
        return match($this) {
            PartnerStatus::PUBLISHED => 'منشور',
            PartnerStatus::DRAFT     => 'مسودة',
        };
    }

    public function color(): string
    {
        return match($this) {
            PartnerStatus::PUBLISHED => 'bg-success',
            PartnerStatus::DRAFT     => 'bg-secondary',
        };
    }
}
