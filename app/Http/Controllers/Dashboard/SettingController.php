<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        return view('dashboard.settings');
    }
    public function update(Request $request)
    {
        $current_file = ['logo', 'fav'];
        $files = $request->file();
        $data  = $request->except(array_keys($files), '_token');
        if (empty($files)) {
            foreach ($current_file as $ele) {
                $data[$ele] = setting($ele);
            }
        }
        $color_defaults = [
            'primary_color'   => '#2E5789',
            'secondary_color' => '#0FC859',
            'accent_color'    => '#F99132',
            'dark_color'      => '#243848',
        ];
        foreach ($color_defaults as $key => $default) {
            if (empty($data[$key])) {
                $data[$key] = setting($key, $default);
            }
        }
        foreach ($files as $file => $value) {
            if (!empty(setting($file))) {
                delete_file(setting($file));
            }
            $data[$file] = store_file($value, 'settings');
        }
        DB::table('settings')->delete();
        setting($data)->save();
        return redirect()->back()->with('success', 'تم حفظ التعديلات بنجاح');
    }
}
