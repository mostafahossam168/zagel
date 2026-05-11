<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\PartnerRequest;
use App\Services\PartnerService;
use Illuminate\Routing\Controller;

class PartnerController extends Controller
{
    public function __construct(private PartnerService $service)
    {
        $this->middleware('permission:create_partners', ['only' => ['create', 'store']]);
        $this->middleware('permission:update_partners', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_partners', ['only' => ['destroy']]);
        $this->middleware('permission:read_partners|create_partners|update_partners|delete_partners', ['only' => ['index']]);
    }

    public function index()
    {
        $data = $this->service->index();

        if (request()->ajax()) {
            return response()->json([
                'html'            => view('dashboard.partners._table', ['items' => $data['items']])->render(),
                'pagination'      => (string) $data['items']->links(),
                'count_all'       => $data['count_all'],
                'count_published' => $data['count_published'],
                'count_draft'     => $data['count_draft'],
            ]);
        }

        return view('dashboard.partners.index', $data);
    }

    public function create()
    {
        return view('dashboard.partners.create');
    }

    public function store(PartnerRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = store_file($request->file('image'), 'partners');
        }
        $this->service->store($data);
        return redirect()->route('dashboard.partners.index')->with('success', 'تم حفظ البيانات بنجاح');
    }

    public function edit(string $id)
    {
        $item = $this->service->edit($id);
        return view('dashboard.partners.edit', compact('item'));
    }

    public function update(PartnerRequest $request, string $id)
    {
        $data = $request->validated();
        $item = $this->service->edit($id);
        if ($request->hasFile('image')) {
            if ($item->image) {
                delete_file($item->image);
            }
            $data['image'] = store_file($request->file('image'), 'partners');
        } else {
            $data['image'] = $item->image;
        }
        $this->service->update($data, $id);
        return redirect()->route('dashboard.partners.index')->with('success', 'تم تعديل البيانات بنجاح');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);
        return back()->with('success', 'تم حذف الشريك بنجاح');
    }
}
