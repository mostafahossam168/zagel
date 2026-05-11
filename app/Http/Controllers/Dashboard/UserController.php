<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\UserRequest;
use App\Services\UserService;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    public function __construct(private UserService $service)
    {
        $this->middleware('permission:create_users', ['only' => ['create', 'store']]);
        $this->middleware('permission:update_users', ['only' => ['edit', 'update', 'toggleStatus']]);
        $this->middleware('permission:delete_users', ['only' => ['destroy']]);
        $this->middleware('permission:read_users|create_users|update_users|delete_users', ['only' => ['index']]);
    }

    public function index()
    {
        $data = $this->service->index();

        if (request()->ajax()) {
            return response()->json([
                'html'           => view('dashboard.users._table', ['items' => $data['items']])->render(),
                'pagination'     => (string) $data['items']->links(),
                'count_all'      => $data['count_all'],
                'count_active'   => $data['count_active'],
                'count_inactive' => $data['count_inactive'],
            ]);
        }

        return view('dashboard.users.index', $data);
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = store_file($request->file('image'), 'users');
        }
        $this->service->store($data);
        return redirect()->route('dashboard.users.index')->with('success', 'تم حفظ البيانات بنجاح');
    }

    public function edit(string $id)
    {
        $item = $this->service->edit($id);
        return view('dashboard.users.edit', compact('item'));
    }

    public function update(UserRequest $request, string $id)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $item = $this->service->edit($id);
            if ($item->image) {
                delete_file($item->image);
            }
            $data['image'] = store_file($request->file('image'), 'users');
        }
        $this->service->update($data, $id);
        return redirect()->route('dashboard.users.index')->with('success', 'تم تعديل البيانات بنجاح');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);
        return back()->with('success', 'تم حذف المستخدم بنجاح');
    }

    public function toggleStatus(string $id)
    {
        $user   = $this->service->toggleStatus($id);
        $counts = $this->service->index();
        return response()->json([
            'status'         => $user->status->value,
            'label'          => $user->status->name(),
            'color'          => $user->status->color(),
            'count_all'      => $counts['count_all'],
            'count_active'   => $counts['count_active'],
            'count_inactive' => $counts['count_inactive'],
        ]);
    }
}
