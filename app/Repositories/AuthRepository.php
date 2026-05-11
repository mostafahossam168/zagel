<?php

namespace App\Repositories;

use App\Interfaces\AuthInterface;
use App\Models\User;
use Carbon\Carbon;

class AuthRepository implements AuthInterface
{


    public function profile($request)
    {
        return $request->user();
    }

    public function logout(User $user): void
    {
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
    }
}