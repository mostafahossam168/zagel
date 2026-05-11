<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AuthRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $credenation = $request->only('email', 'password');
        $remember = $request->boolean('remember');
        if (auth()->attempt($credenation, $remember) && auth()->user()->type->value == 'admin') {
            return redirect()->route('dashboard.home');
        }

        return redirect()->back()->with('error', 'البيانات غير صحيحه');
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('dashboard.login')->with('success', 'تم تسجيل الخروج بنجاح');
    }
}
