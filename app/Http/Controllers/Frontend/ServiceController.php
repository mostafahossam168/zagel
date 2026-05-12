<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\ServiceStatus;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::active()->with('category')->orderBy('sort_order');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('title_ar', 'like', "%{$q}%")
                    ->orWhere('description_ar', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', (float) $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', (float) $request->price_max);
        }

        $services   = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('front.services.index', compact('services', 'categories'));
    }

    public function show(Service $service)
    {
        abort_if($service->status !== ServiceStatus::ACTIVE, 404);
        return view('front.services.show', compact('service'));
    }
}
