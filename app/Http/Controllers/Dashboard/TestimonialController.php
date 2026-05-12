<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\TestimonialRequest;
use App\Services\TestimonialService;
use Illuminate\Routing\Controller;

class TestimonialController extends Controller
{
    public function __construct(private TestimonialService $service)
    {
        $this->middleware('permission:create_testimonials', ['only' => ['store']]);
        $this->middleware('permission:update_testimonials', ['only' => ['update']]);
        $this->middleware('permission:delete_testimonials', ['only' => ['destroy']]);
        $this->middleware('permission:read_testimonials|create_testimonials|update_testimonials|delete_testimonials', ['only' => ['index']]);
    }

    public function index()
    {
        $data = $this->service->index();

        if (request()->ajax()) {
            return response()->json([
                'html'           => view('dashboard.testimonials._table', ['items' => $data['items']])->render(),
                'pagination'     => (string) $data['items']->links(),
                'count_all'      => $data['count_all'],
                'count_active'   => $data['count_active'],
                'count_inactive' => $data['count_inactive'],
            ]);
        }

        return view('dashboard.testimonials.index', $data);
    }

    public function store(TestimonialRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = store_file($request->file('image'), 'testimonials');
        }
        $this->service->store($data);
        return redirect()->route('dashboard.testimonials.index')->with('success', 'تم إضافة الشهادة بنجاح');
    }

    public function update(TestimonialRequest $request, string $id)
    {
        $data = $request->validated();
        $item = $this->service->edit($id);
        if ($request->hasFile('image')) {
            if ($item->image) {
                delete_file($item->image);
            }
            $data['image'] = store_file($request->file('image'), 'testimonials');
        } else {
            $data['image'] = $item->image;
        }
        $this->service->update($data, $id);
        return redirect()->route('dashboard.testimonials.index')->with('success', 'تم تعديل الشهادة بنجاح');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);
        return back()->with('success', 'تم حذف الشهادة بنجاح');
    }
}
