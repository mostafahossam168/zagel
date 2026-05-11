<?php

namespace App\Interfaces;

use App\Models\User;

interface AuthInterface
{
    public function profile($request);
    public function logout(User $user): void;
}