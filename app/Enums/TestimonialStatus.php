<?php

namespace App\Enums;

enum TestimonialStatus: string
{
    case ACTIVE   = 'active';
    case INACTIVE = 'inactive';

    public function name(): string
    {
        return match($this) {
            TestimonialStatus::ACTIVE   => 'نشط',
            TestimonialStatus::INACTIVE => 'غير نشط',
        };
    }

    public function color(): string
    {
        return match($this) {
            TestimonialStatus::ACTIVE   => 'bg-success',
            TestimonialStatus::INACTIVE => 'bg-danger',
        };
    }
}
