<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\StatusUser;
use App\Enums\UserType;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'password',
        'status',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'type'     => UserType::class,
            'status'   => StatusUser::class,
        ];
    }

    public function isAdmin(): bool
    {
        return $this->type == UserType::ADMIN;
    }

    public function scopeUsers($query)
    {
        return $query->where('type', UserType::USER);
    }

    public function scopeAdmins($query)
    {
        return $query->where('type', UserType::ADMIN);
    }
    public function scopeActive($query)
    {
        return $query->where('status', StatusUser::ACTIVE->value);
    }

    public function scopeInActive($query)
    {
        return $query->where('status', StatusUser::INACTIVE->value);
    }
}
