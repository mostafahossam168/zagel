<?php

namespace App\Enums;

enum CategoryStatus: string
{
    case ACTIVE   = 'active';
    case INACTIVE = 'inactive';

    public function name(): string
    {
        return match($this) {
            CategoryStatus::ACTIVE   => 'نشط',
            CategoryStatus::INACTIVE => 'غير نشط',
        };
    }

    public function color(): string
    {
        return match($this) {
            CategoryStatus::ACTIVE   => 'bg-success',
            CategoryStatus::INACTIVE => 'bg-danger',
        };
    }
}
