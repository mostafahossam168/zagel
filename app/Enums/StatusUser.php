<?php

namespace App\Enums;

enum StatusUser: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public function name(): string
    {
        return match($this) {
            StatusUser::ACTIVE => 'مفعل',
            StatusUser::INACTIVE => 'غير مفعل',
        };
    }

    public function color(): string
    {
        return match($this) {
            StatusUser::ACTIVE => 'bg-success',
            StatusUser::INACTIVE => 'bg-danger',
        };
    }

    // public function __toString(): string
    // {
    //     return $this->value;
    // }
}
