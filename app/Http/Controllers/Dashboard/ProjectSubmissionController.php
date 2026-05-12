<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\ProjectSubmissionStatus;
use App\Models\ProjectSubmission;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProjectSubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_project_submissions', ['only' => ['index', 'show']]);
        $this->middleware('permission:update_project_submissions', ['only' => ['updateStatus']]);
        $this->middleware('permission:delete_project_submissions', ['only' => ['destroy']]);
    }

    public function index()
    {
        $search = request('search');
        $status = request('status');

        $items = ProjectSubmission::when($search, fn($q) => $q->where('name', 'LIKE', "%$search%")
                ->orWhere('project_title', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%"))
            ->when($status, fn($q) => $q->where('status', $status))
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $count_all      = ProjectSubmission::count();
        $count_new      = ProjectSubmission::where('status', ProjectSubmissionStatus::NEW->value)->count();
        $count_reviewed = ProjectSubmission::where('status', ProjectSubmissionStatus::REVIEWED->value)->count();
        $count_accepted = ProjectSubmission::where('status', ProjectSubmissionStatus::ACCEPTED->value)->count();
        $count_rejected = ProjectSubmission::where('status', ProjectSubmissionStatus::REJECTED->value)->count();

        if (request()->ajax()) {
            return response()->json([
                'html'           => view('dashboard.project-submissions._table', compact('items'))->render(),
                'pagination'     => (string) $items->links(),
                'count_all'      => $count_all,
                'count_new'      => $count_new,
                'count_reviewed' => $count_reviewed,
                'count_accepted' => $count_accepted,
                'count_rejected' => $count_rejected,
            ]);
        }

        return view('dashboard.project-submissions.index', compact(
            'items', 'count_all', 'count_new', 'count_reviewed', 'count_accepted', 'count_rejected'
        ));
    }

    public function show(string $id)
    {
        $item = ProjectSubmission::findOrFail($id);
        if ($item->status === ProjectSubmissionStatus::NEW) {
            $item->update(['status' => ProjectSubmissionStatus::REVIEWED->value]);
        }
        return view('dashboard.project-submissions.show', compact('item'));
    }

    public function updateStatus(Request $request, string $id)
    {
        $request->validate(['status' => 'required|in:new,reviewed,accepted,rejected']);
        $item = ProjectSubmission::findOrFail($id);
        $item->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);
        return back()->with('success', 'تم تحديث حالة المشروع بنجاح');
    }

    public function destroy(string $id)
    {
        ProjectSubmission::findOrFail($id)->delete();
        return back()->with('success', 'تم حذف المشروع بنجاح');
    }
}
