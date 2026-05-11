<?php

namespace App\Enums;

enum FaqStatus: string
{
    case ACTIVE   = 'active';
    case INACTIVE = 'inactive';

    public function name(): string
    {
        return match($this) {
            FaqStatus::ACTIVE   => 'مفعل',
            FaqStatus::INACTIVE => 'غير مفعل',
        };
    }

    public function color(): string
    {
        return match($this) {
            FaqStatus::ACTIVE   => 'bg-success',
            FaqStatus::INACTIVE => 'bg-danger',
        };
    }
}
