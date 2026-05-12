<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationLog extends Model
{
    protected $fillable = ['title', 'body', 'sent_by', 'target', 'target_ids', 'sent_count'];

    protected function casts(): array
    {
        return ['target_ids' => 'array'];
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
}
