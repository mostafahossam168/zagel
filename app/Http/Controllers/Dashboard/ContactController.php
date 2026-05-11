<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\ContactStatus;
use App\Models\Contact;
use Illuminate\Routing\Controller;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_contacts', ['only' => ['index', 'show']]);
        $this->middleware('permission:delete_contacts', ['only' => ['destroy']]);
    }

    public function index()
    {
        $search = request('search');
        $status = request('status');

        $items = Contact::when($search, fn($q) => $q->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%"))
            ->when($status, fn($q) => $q->where('status', $status))
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $count_all    = Contact::count();
        $count_unread = Contact::where('status', ContactStatus::UNREAD->value)->count();
        $count_read   = Contact::where('status', ContactStatus::READ->value)->count();

        if (request()->ajax()) {
            return response()->json([
                'html'         => view('dashboard.contacts._table', compact('items'))->render(),
                'pagination'   => (string) $items->links(),
                'count_all'    => $count_all,
                'count_unread' => $count_unread,
                'count_read'   => $count_read,
            ]);
        }

        return view('dashboard.contacts.index', compact('items', 'count_all', 'count_unread', 'count_read'));
    }

    public function show(string $id)
    {
        $item = Contact::findOrFail($id);
        if ($item->status === ContactStatus::UNREAD) {
            $item->update(['status' => ContactStatus::READ->value]);
        }
        return view('dashboard.contacts.show', compact('item'));
    }

    public function destroy(string $id)
    {
        Contact::findOrFail($id)->delete();
        return back()->with('success', 'تم حذف الرسالة بنجاح');
    }
}
