<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProjectSubmission;
use Illuminate\Http\Request;

class ProjectSubmissionController extends Controller
{
    public function create()
    {
        return view('front.project-submission');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'email'               => 'required|email|max:255',
            'phone'               => 'required|string|max:20',
            'project_title'       => 'required|string|max:255',
            'project_description' => 'required|string',
            'needs'               => 'nullable|string',
        ]);

        ProjectSubmission::create([
            'name'                => $request->name,
            'email'               => $request->email,
            'phone'               => $request->phone,
            'project_title'       => $request->project_title,
            'project_description' => $request->project_description,
            'needs'               => $request->needs,
        ]);

        return back()->with('success', 'تم إرسال مشروعك بنجاح، سيقوم فريقنا بمراجعته والتواصل معك قريباً');
    }
}
