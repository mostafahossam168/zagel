<?php

namespace App\Repositories;

use App\Enums\FaqStatus;
use App\Interfaces\FaqInterface;
use App\Models\Faq;

class FaqRepository implements FaqInterface
{
    public function index(): array
    {
        $query = Faq::query();

        if (request('search')) {
            $query->where('question', 'like', '%' . request('search') . '%');
        }

        if (request('status')) {
            $status = request('status') === 'yes' ? FaqStatus::ACTIVE->value : FaqStatus::INACTIVE->value;
            $query->where('status', $status);
        }

        return [
            'items'         => $query->latest()->paginate(10),
            'count_all'     => Faq::count(),
            'count_active'  => Faq::where('status', FaqStatus::ACTIVE->value)->count(),
            'count_inactive'=> Faq::where('status', FaqStatus::INACTIVE->value)->count(),
        ];
    }

    public function store(array $data)
    {
        return Faq::create($data);
    }

    public function edit(string $id)
    {
        return Faq::findOrFail($id);
    }

    public function update(array $data, string $id)
    {
        return Faq::findOrFail($id)->update($data);
    }

    public function delete(string $id)
    {
        Faq::findOrFail($id)->delete();
    }
}
