<?php

namespace App\Enums;

enum ServiceStatus: string
{
    case ACTIVE   = 'active';
    case INACTIVE = 'inactive';

    public function name(): string
    {
        return match($this) {
            ServiceStatus::ACTIVE   => 'نشط',
            ServiceStatus::INACTIVE => 'غير نشط',
        };
    }

    public function color(): string
    {
        return match($this) {
            ServiceStatus::ACTIVE   => 'bg-success',
            ServiceStatus::INACTIVE => 'bg-danger',
        };
    }
}
