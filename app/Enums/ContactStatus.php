<?php

namespace App\Enums;

enum ContactStatus: string
{
    case UNREAD = 'unread';
    case READ   = 'read';

    public function name(): string
    {
        return match($this) {
            ContactStatus::UNREAD => 'غير مقروء',
            ContactStatus::READ   => 'مقروء',
        };
    }

    public function color(): string
    {
        return match($this) {
            ContactStatus::UNREAD => 'bg-warning text-dark',
            ContactStatus::READ   => 'bg-success',
        };
    }
}
