<?php

namespace App\Models;

use App\Enums\TestimonialStatus;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'company', 'position', 'content', 'image', 'rating', 'status'];

    protected function casts(): array
    {
        return ['status' => TestimonialStatus::class];
    }

    public function scopeActive($query)
    {
        return $query->where('status', TestimonialStatus::ACTIVE->value);
    }
}
