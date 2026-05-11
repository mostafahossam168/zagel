<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service)
    {
        $this->middleware('permission:create_categories', ['only' => ['create', 'store']]);
        $this->middleware('permission:update_categories', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_categories', ['only' => ['destroy']]);
        $this->middleware('permission:read_categories|create_categories|update_categories|delete_categories', ['only' => ['index']]);
    }

    public function index()
    {
        $data = $this->service->index();

        if (request()->ajax()) {
            return response()->json([
                'html'           => view('dashboard.categories._table', ['items' => $data['items']])->render(),
                'pagination'     => (string) $data['items']->links(),
                'count_all'      => $data['count_all'],
                'count_active'   => $data['count_active'],
                'count_inactive' => $data['count_inactive'],
            ]);
        }

        return view('dashboard.categories.index', $data);
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = store_file($request->file('image'), 'categories');
        }
        $this->service->store($data);
        return redirect()->route('dashboard.categories.index')->with('success', 'تم حفظ البيانات بنجاح');
    }

    public function edit(string $id)
    {
        $item = $this->service->edit($id);
        return view('dashboard.categories.edit', compact('item'));
    }

    public function update(CategoryRequest $request, string $id)
    {
        $data = $request->validated();
        $item = $this->service->edit($id);
        if ($request->hasFile('image')) {
            if ($item->image) {
                delete_file($item->image);
            }
            $data['image'] = store_file($request->file('image'), 'categories');
        } else {
            $data['image'] = $item->image;
        }
        $this->service->update($data, $id);
        return redirect()->route('dashboard.categories.index')->with('success', 'تم تعديل البيانات بنجاح');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);
        return back()->with('success', 'تم حذف القسم بنجاح');
    }
}
