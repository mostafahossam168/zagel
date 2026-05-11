<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\FaqRequest;
use App\Services\FaqService;
use Illuminate\Routing\Controller;

class FaqController extends Controller
{
    public function __construct(private FaqService $service)
    {
        $this->middleware('permission:create_faqs', ['only' => ['store']]);
        $this->middleware('permission:update_faqs', ['only' => ['update']]);
        $this->middleware('permission:delete_faqs', ['only' => ['destroy']]);
        $this->middleware('permission:read_faqs|create_faqs|update_faqs|delete_faqs', ['only' => ['index']]);
    }

    public function index()
    {
        $data = $this->service->index();

        if (request()->ajax()) {
            return response()->json([
                'html'           => view('dashboard.faqs._table', ['items' => $data['items']])->render(),
                'pagination'     => (string) $data['items']->links(),
                'count_all'      => $data['count_all'],
                'count_active'   => $data['count_active'],
                'count_inactive' => $data['count_inactive'],
            ]);
        }

        return view('dashboard.faqs.index', $data);
    }

    public function store(FaqRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->route('dashboard.faqs.index')->with('success', 'تم إضافة السؤال بنجاح');
    }

    public function update(FaqRequest $request, string $id)
    {
        $this->service->update($request->validated(), $id);
        return redirect()->route('dashboard.faqs.index')->with('success', 'تم تعديل السؤال بنجاح');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);
        return back()->with('success', 'تم حذف السؤال بنجاح');
    }
}
