<?php

namespace App\Models;

use App\Enums\ContactStatus;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'message', 'status'];

    protected function casts(): array
    {
        return ['status' => ContactStatus::class];
    }

    public function scopeUnread($query)
    {
        return $query->where('status', ContactStatus::UNREAD->value);
    }

    public function scopeRead($query)
    {
        return $query->where('status', ContactStatus::READ->value);
    }
}
