<?php

namespace App\Models;

use App\Enums\ServiceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = [
        'title_ar', 'title_en', 'description_ar', 'description_en',
        'image', 'category_id', 'price', 'currency', 'is_purchasable', 'sort_order', 'status',
    ];

    protected function casts(): array
    {
        return [
            'status'         => ServiceStatus::class,
            'is_purchasable' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', ServiceStatus::ACTIVE->value);
    }
}
