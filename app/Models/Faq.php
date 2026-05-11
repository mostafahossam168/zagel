<?php

namespace App\Models;

use App\Enums\FaqStatus;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question', 'answer', 'status'];

    protected function casts(): array
    {
        return [
            'status' => FaqStatus::class,
        ];
    }
}
