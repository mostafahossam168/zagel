<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\StatusUser;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('front.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->where('type', UserType::USER)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة'])->withInput();
        }

        if ($user->status !== StatusUser::ACTIVE) {
            return back()->withErrors(['email' => 'حسابك موقوف، تواصل مع الدعم'])->withInput();
        }

        Auth::login($user, $request->boolean('remember'));

        return redirect()->intended(route('user.profile'));
    }

    public function showRegister()
    {
        return view('front.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'type'     => UserType::USER->value,
            'status'   => StatusUser::ACTIVE->value,
        ]);

        Auth::login($user);

        return redirect()->route('user.profile')->with('success', 'مرحباً بك في زاجل!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
