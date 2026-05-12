<?php

namespace App\Enums;

enum ProviderListingStatus: string
{
    case PENDING  = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    public function name(): string
    {
        return match($this) {
            self::PENDING  => 'قيد المراجعة',
            self::APPROVED => 'معتمد',
            self::REJECTED => 'مرفوض',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::PENDING  => 'bg-warning text-dark',
            self::APPROVED => 'bg-success',
            self::REJECTED => 'bg-danger',
        };
    }
}
