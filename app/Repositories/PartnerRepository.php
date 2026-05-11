<?php

namespace App\Repositories;

use App\Interfaces\PartnerInterface;
use App\Models\Partner;

class PartnerRepository implements PartnerInterface
{
    public function index()
    {
        $search = request('search');
        $status = request('status');

        return [
            'items' => Partner::when($search, fn($q) => $q->where('name', 'LIKE', "%$search%"))
                ->when($status, fn($q) => $q->where('status', $status))
                ->orderBy('id', 'DESC')
                ->paginate(10),
            'count_all'       => Partner::count(),
            'count_published' => Partner::where('status', \App\Enums\PartnerStatus::PUBLISHED->value)->count(),
            'count_draft'     => Partner::where('status', \App\Enums\PartnerStatus::DRAFT->value)->count(),
        ];
    }

    public function store($validated)
    {
        return Partner::create($validated);
    }

    public function edit($id)
    {
        return Partner::findOrFail($id);
    }

    public function update($validated, $id)
    {
        $partner = Partner::findOrFail($id);
        $partner->update($validated);
        return $partner;
    }

    public function delete($id)
    {
        $partner = Partner::findOrFail($id);
        if ($partner->image) {
            delete_file($partner->image);
        }
        $partner->delete();
    }
}
