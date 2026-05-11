<?php

namespace App\Repositories;

use App\Enums\StatusUser;
use App\Enums\UserType;
use App\Interfaces\AdminInterface;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminRepository implements AdminInterface
{
    public function index()
    {
        $search = request('search');
        $status = request('status');

        return [
            'items' => User::admins()
                ->when($search, fn($q) => $q->where('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%"))
                ->when($status == 'yes', fn($q) => $q->where('status', StatusUser::ACTIVE->value))
                ->when($status == 'no', fn($q) => $q->where('status', StatusUser::INACTIVE->value))
                ->orderBy('id', 'DESC')
                ->paginate(10),
            'count_all'      => User::admins()->count(),
            'count_active'   => User::admins()->where('status', StatusUser::ACTIVE->value)->count(),
            'count_inactive' => User::admins()->where('status', StatusUser::INACTIVE->value)->count(),
        ];
    }

    public function create()
    {
        return ['roles' => Role::all()];
    }

    public function store($validated)
    {
        $admin = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'] ?? null,
            'password' => $validated['password'],
            'status'   => $validated['status'],
            'type'     => UserType::ADMIN->value,
            'image'    => $validated['image'] ?? null,
        ]);
        $admin->syncRoles($validated['role']);
        return $admin;
    }

    public function edit($id)
    {
        return [
            'item'  => User::admins()->findOrFail($id),
            'roles' => Role::all(),
        ];
    }

    public function update($validated, $id)
    {
        $admin = User::admins()->findOrFail($id);
        $data = [
            'name'   => $validated['name'],
            'email'  => $validated['email'],
            'phone'  => $validated['phone'] ?? null,
            'status' => $validated['status'],
            'image'  => $validated['image'] ?? $admin->image,
        ];
        if (!empty($validated['password'])) {
            $data['password'] = $validated['password'];
        }
        $admin->update($data);
        $admin->syncRoles($validated['role']);
        return $admin;
    }

    public function delete($id)
    {
        $admin = User::admins()->findOrFail($id);
        if ($admin->image) {
            delete_file($admin->image);
        }
        $admin->delete();
    }

    public function export()
    {
        $search = request('search');
        $status = request('status');

        return User::admins()
            ->when($search, fn($q) => $q->where('name', 'LIKE', "%$search%")->orWhere('email', 'LIKE', "%$search%"))
            ->when($status == 'yes', fn($q) => $q->where('status', StatusUser::ACTIVE->value))
            ->when($status == 'no', fn($q) => $q->where('status', StatusUser::INACTIVE->value))
            ->get();
    }

    public function toggleStatus($id)
    {
        $admin = User::admins()->findOrFail($id);
        $admin->status = $admin->status === StatusUser::ACTIVE ? StatusUser::INACTIVE : StatusUser::ACTIVE;
        $admin->save();
        return $admin;
    }
}
