<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PageController extends Controller
{
    public function aboutUs()
    {
        $page = Page::firstOrCreate(['slug' => 'about_us'], ['content' => '']);
        return view('dashboard.pages.about-us', compact('page'));
    }

    public function updateAboutUs(Request $request)
    {
        $request->validate(['content' => ['nullable', 'string']]);

        Page::updateOrCreate(
            ['slug' => 'about_us'],
            ['content' => $request->content]
        );

        return redirect()->back()->with('success', 'تم حفظ المحتوى بنجاح');
    }

    public function uploadImage(Request $request)
    {
        $request->validate(['file' => ['required', 'image', 'max:3072']]);
        $path = store_file($request->file('file'), 'pages');
        return response()->json(['url' => display_file($path)]);
    }
}
