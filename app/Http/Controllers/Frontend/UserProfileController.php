<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        $user     = auth()->user();
        $listings = $user->providerListings()->latest()->get();
        return view('front.user.profile', compact('user', 'listings'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'image' => 'nullable|image|max:2048',
            'password'              => 'nullable|string|min:8|confirmed',
            'current_password'      => 'nullable|required_with:password',
        ]);

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
            }
        }

        $data = $request->only('name', 'email', 'phone');

        if ($request->hasFile('image')) {
            if ($user->image) delete_file($user->image);
            $data['image'] = store_file($request->file('image'), 'users');
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}
