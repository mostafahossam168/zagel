<?php

namespace App\Services;

use App\Interfaces\AuthInterface;
use App\Models\User;

class AuthService
{
    public function __construct(private AuthInterface $repository) {}

    public function profile($request)
    {
        return $this->repository->profile($request);
    }

    public function logout(User $user): void
    {
        $this->repository->logout($user);
    }
}
