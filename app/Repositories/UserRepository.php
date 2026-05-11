<?php

namespace App\Repositories;

use App\Enums\StatusUser;
use App\Enums\UserType;
use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    public function index()
    {
        $search = request('search');
        $status = request('status');

        return [
            'items' => User::users()
                ->when($search, fn($q) => $q->where('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%"))
                ->when($status == 'yes', fn($q) => $q->where('status', StatusUser::ACTIVE->value))
                ->when($status == 'no', fn($q) => $q->where('status', StatusUser::INACTIVE->value))
                ->orderBy('id', 'DESC')
                ->paginate(10),
            'count_all'      => User::users()->count(),
            'count_active'   => User::users()->where('status', StatusUser::ACTIVE->value)->count(),
            'count_inactive' => User::users()->where('status', StatusUser::INACTIVE->value)->count(),
        ];
    }

    public function store($validated)
    {
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'] ?? null,
            'password' => $validated['password'],
            'status'   => $validated['status'],
            'type'     => UserType::USER->value,
            'image'    => $validated['image'] ?? null,
        ]);
        return $user;
    }

    public function edit($id)
    {
        return User::users()->findOrFail($id);
    }

    public function update($validated, $id)
    {
        $user = User::users()->findOrFail($id);
        $data = [
            'name'   => $validated['name'],
            'email'  => $validated['email'],
            'phone'  => $validated['phone'] ?? null,
            'status' => $validated['status'],
            'image'  => $validated['image'] ?? $user->image,
        ];
        if (!empty($validated['password'])) {
            $data['password'] = $validated['password'];
        }
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::users()->findOrFail($id);
        if ($user->image) {
            delete_file($user->image);
        }
        $user->delete();
    }

    public function toggleStatus($id)
    {
        $user = User::users()->findOrFail($id);
        $user->status = $user->status === StatusUser::ACTIVE ? StatusUser::INACTIVE : StatusUser::ACTIVE;
        $user->save();
        return $user;
    }
}
