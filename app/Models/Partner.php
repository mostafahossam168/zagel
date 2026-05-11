<?php

namespace App\Models;

use App\Enums\PartnerStatus;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['name', 'image', 'description', 'status'];

    protected function casts(): array
    {
        return ['status' => PartnerStatus::class];
    }

    public function scopePublished($query)
    {
        return $query->where('status', PartnerStatus::PUBLISHED->value);
    }
}
