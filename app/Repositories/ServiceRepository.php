<?php

namespace App\Repositories;

use App\Enums\ServiceStatus;
use App\Interfaces\ServiceInterface;
use App\Models\Service;

class ServiceRepository implements ServiceInterface
{
    public function index()
    {
        $search = request('search');
        $status = request('status');

        return [
            'items' => Service::with('category')
                ->when($search, fn($q) => $q->where('title_ar', 'LIKE', "%$search%")->orWhere('title_en', 'LIKE', "%$search%"))
                ->when($status == 'yes', fn($q) => $q->where('status', ServiceStatus::ACTIVE->value))
                ->when($status == 'no', fn($q) => $q->where('status', ServiceStatus::INACTIVE->value))
                ->orderBy('sort_order')
                ->orderBy('id', 'DESC')
                ->paginate(10),
            'count_all'      => Service::count(),
            'count_active'   => Service::where('status', ServiceStatus::ACTIVE->value)->count(),
            'count_inactive' => Service::where('status', ServiceStatus::INACTIVE->value)->count(),
        ];
    }

    public function store($validated)
    {
        return Service::create($validated);
    }

    public function edit($id)
    {
        return Service::findOrFail($id);
    }

    public function update($validated, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($validated);
        return $service;
    }

    public function delete($id)
    {
        $service = Service::findOrFail($id);
        if ($service->image) {
            delete_file($service->image);
        }
        $service->delete();
    }
}
