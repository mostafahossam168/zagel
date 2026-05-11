<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{
    public function index()
    {
        $search = request('search');
        $status = request('status');

        return [
            'items' => Category::when($search, fn($q) => $q->where('name', 'LIKE', "%$search%"))
                ->when($status == 'yes', fn($q) => $q->where('status', \App\Enums\CategoryStatus::ACTIVE->value))
                ->when($status == 'no', fn($q) => $q->where('status', \App\Enums\CategoryStatus::INACTIVE->value))
                ->orderBy('id', 'DESC')
                ->paginate(10),
            'count_all'      => Category::count(),
            'count_active'   => Category::where('status', \App\Enums\CategoryStatus::ACTIVE->value)->count(),
            'count_inactive' => Category::where('status', \App\Enums\CategoryStatus::INACTIVE->value)->count(),
        ];
    }

    public function store($validated)
    {
        return Category::create($validated);
    }

    public function edit($id)
    {
        return Category::findOrFail($id);
    }

    public function update($validated, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($validated);
        return $category;
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image) {
            delete_file($category->image);
        }
        $category->delete();
    }
}
