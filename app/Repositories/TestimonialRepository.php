<?php

namespace App\Repositories;

use App\Enums\TestimonialStatus;
use App\Interfaces\TestimonialInterface;
use App\Models\Testimonial;

class TestimonialRepository implements TestimonialInterface
{
    public function index()
    {
        $search = request('search');
        $status = request('status');

        return [
            'items' => Testimonial::when($search, fn($q) => $q->where('name', 'LIKE', "%$search%")->orWhere('company', 'LIKE', "%$search%"))
                ->when($status == 'yes', fn($q) => $q->where('status', TestimonialStatus::ACTIVE->value))
                ->when($status == 'no', fn($q) => $q->where('status', TestimonialStatus::INACTIVE->value))
                ->orderBy('id', 'DESC')
                ->paginate(10),
            'count_all'      => Testimonial::count(),
            'count_active'   => Testimonial::where('status', TestimonialStatus::ACTIVE->value)->count(),
            'count_inactive' => Testimonial::where('status', TestimonialStatus::INACTIVE->value)->count(),
        ];
    }

    public function store($validated)
    {
        return Testimonial::create($validated);
    }

    public function edit($id)
    {
        return Testimonial::findOrFail($id);
    }

    public function update($validated, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update($validated);
        return $testimonial;
    }

    public function delete($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        if ($testimonial->image) {
            delete_file($testimonial->image);
        }
        $testimonial->delete();
    }
}
