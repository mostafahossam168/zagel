<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\AdminRequest;
use App\Services\AdminService;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function __construct(private AdminService $service)
    {
        $this->middleware('permission:create_admins', ['only' => ['create', 'store']]);
        $this->middleware('permission:update_admins', ['only' => ['edit', 'update', 'toggleStatus']]);
        $this->middleware('permission:delete_admins', ['only' => ['destroy']]);
        $this->middleware('permission:read_admins|create_admins|update_admins|delete_admins', ['only' => ['index']]);
    }

    public function index()
    {
        $data = $this->service->index();

        if (request()->ajax()) {
            return response()->json([
                'html'           => view('dashboard.admins._table', ['items' => $data['items']])->render(),
                'pagination'     => (string) $data['items']->links(),
                'count_all'      => $data['count_all'],
                'count_active'   => $data['count_active'],
                'count_inactive' => $data['count_inactive'],
            ]);
        }

        return view('dashboard.admins.index', $data);
    }

    public function create()
    {
        return view('dashboard.admins.create', $this->service->create());
    }

    public function store(AdminRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = store_file($request->file('image'), 'admins');
        }
        $this->service->store($data);
        return redirect()->route('dashboard.admins.index')->with('success', 'تم حفظ البيانات بنجاح');
    }

    public function edit(string $id)
    {
        return view('dashboard.admins.edit', $this->service->edit($id));
    }

    public function update(AdminRequest $request, string $id)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = store_file($request->file('image'), 'admins');
        }
        $this->service->update($data, $id);
        return redirect()->route('dashboard.admins.index')->with('success', 'تم تعديل البيانات بنجاح');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);
        return back()->with('success', 'تم حذف المشرف بنجاح');
    }

    public function toggleStatus(string $id)
    {
        $admin   = $this->service->toggleStatus($id);
        $counts  = $this->service->index();
        return response()->json([
            'status'         => $admin->status->value,
            'label'          => $admin->status->name(),
            'color'          => $admin->status->color(),
            'count_all'      => $counts['count_all'],
            'count_active'   => $counts['count_active'],
            'count_inactive' => $counts['count_inactive'],
        ]);
    }

    public function export()
    {
        $admins   = $this->service->export();
        $filename = 'admins_' . now()->format('Y_m_d') . '.csv';
        $headers  = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
        $callback = function () use ($admins) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, ['#', 'الاسم', 'البريد الالكتروني', 'الهاتف', 'الحالة']);
            foreach ($admins as $i => $admin) {
                fputcsv($file, [$i + 1, $admin->name, $admin->email, $admin->phone, $admin->status->name()]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
