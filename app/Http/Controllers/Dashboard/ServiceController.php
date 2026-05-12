<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\ServiceRequest;
use App\Models\Category;
use App\Services\ServiceService;
use Illuminate\Routing\Controller;

class ServiceController extends Controller
{
    public function __construct(private ServiceService $service)
    {
        $this->middleware('permission:create_services', ['only' => ['create', 'store']]);
        $this->middleware('permission:update_services', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_services', ['only' => ['destroy']]);
        $this->middleware('permission:read_services|create_services|update_services|delete_services', ['only' => ['index']]);
    }

    public function index()
    {
        $data = $this->service->index();

        if (request()->ajax()) {
            return response()->json([
                'html'           => view('dashboard.services._table', ['items' => $data['items']])->render(),
                'pagination'     => (string) $data['items']->links(),
                'count_all'      => $data['count_all'],
                'count_active'   => $data['count_active'],
                'count_inactive' => $data['count_inactive'],
            ]);
        }

        return view('dashboard.services.index', $data);
    }

    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();
        return view('dashboard.services.create', compact('categories'));
    }

    public function store(ServiceRequest $request)
    {
        $data = $request->validated();
        $data['is_purchasable'] = $request->boolean('is_purchasable');
        if ($request->hasFile('image')) {
            $data['image'] = store_file($request->file('image'), 'services');
        }
        $this->service->store($data);
        return redirect()->route('dashboard.services.index')->with('success', 'تم حفظ الخدمة بنجاح');
    }

    public function edit(string $id)
    {
        $item       = $this->service->edit($id);
        $categories = Category::active()->orderBy('name')->get();
        return view('dashboard.services.edit', compact('item', 'categories'));
    }

    public function update(ServiceRequest $request, string $id)
    {
        $data = $request->validated();
        $data['is_purchasable'] = $request->boolean('is_purchasable');
        $item = $this->service->edit($id);
        if ($request->hasFile('image')) {
            if ($item->image) {
                delete_file($item->image);
            }
            $data['image'] = store_file($request->file('image'), 'services');
        } else {
            $data['image'] = $item->image;
        }
        $this->service->update($data, $id);
        return redirect()->route('dashboard.services.index')->with('success', 'تم تعديل الخدمة بنجاح');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);
        return back()->with('success', 'تم حذف الخدمة بنجاح');
    }
}
