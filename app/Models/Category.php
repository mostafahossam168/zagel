<?php

namespace App\Models;

use App\Enums\CategoryStatus;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description', 'image', 'status'];

    protected function casts(): array
    {
        return ['status' => CategoryStatus::class];
    }

    public function scopeActive($query)
    {
        return $query->where('status', CategoryStatus::ACTIVE->value);
    }
}
