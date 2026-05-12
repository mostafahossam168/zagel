<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\NotificationLog;
use App\Models\User;
use App\Notifications\AdminBroadcastNotification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_notifications', ['only' => ['create', 'store']]);
        $this->middleware('permission:read_notifications',   ['only' => ['index']]);
        $this->middleware('permission:delete_notifications', ['only' => ['destroy']]);
    }

    public function index()
    {
        $logs = NotificationLog::with('sender')
            ->orderBy('id', 'DESC')
            ->paginate(15);

        return view('dashboard.notifications.index', compact('logs'));
    }

    public function create()
    {
        $users = User::users()->active()->orderBy('name')->get();
        return view('dashboard.notifications.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'body'       => 'required|string',
            'target'     => 'required|in:all,specific',
            'target_ids' => 'required_if:target,specific|array',
            'target_ids.*' => 'exists:users,id',
        ]);

        $targets = $request->target === 'all'
            ? User::users()->active()->get()
            : User::whereIn('id', $request->target_ids)->get();

        $targets->each(fn($user) => $user->notify(
            new AdminBroadcastNotification($request->title, $request->body)
        ));

        NotificationLog::create([
            'title'      => $request->title,
            'body'       => $request->body,
            'sent_by'    => auth()->id(),
            'target'     => $request->target,
            'target_ids' => $request->target === 'specific' ? $request->target_ids : null,
            'sent_count' => $targets->count(),
        ]);

        return redirect()->route('dashboard.notifications.index')
            ->with('success', 'تم إرسال الإشعار بنجاح إلى ' . $targets->count() . ' مستخدم');
    }

    public function destroy(string $id)
    {
        NotificationLog::findOrFail($id)->delete();
        return back()->with('success', 'تم حذف سجل الإشعار بنجاح');
    }

    public function inbox()
    {
        $notifications = auth()->user()->notifications()->latest()->paginate(20);
        auth()->user()->unreadNotifications->markAsRead();
        return view('dashboard.notifications.inbox', compact('notifications'));
    }

    public function markAllRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }
}
