<?php

namespace App\Models;

use App\Enums\ProviderListingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderListing extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'image',
        'category_id', 'price', 'currency', 'contact_phone',
        'contact_whatsapp', 'contact_email', 'contact_links',
        'status', 'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'status'        => ProviderListingStatus::class,
            'contact_links' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', ProviderListingStatus::APPROVED->value);
    }
}
