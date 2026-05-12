<?php

namespace App\Models;

use App\Enums\ProjectSubmissionStatus;
use Illuminate\Database\Eloquent\Model;

class ProjectSubmission extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'project_title',
        'project_description', 'needs', 'status', 'admin_notes',
    ];

    protected function casts(): array
    {
        return ['status' => ProjectSubmissionStatus::class];
    }

    public function scopeNew($query)
    {
        return $query->where('status', ProjectSubmissionStatus::NEW->value);
    }
}
