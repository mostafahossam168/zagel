@extends('front.layouts.app')
@section('title', 'تسجيل الدخول')

@section('content')

<div class="min-h-screen flex items-center justify-center py-12 px-4 bg-background">
    <div class="w-full max-w-[440px]">

        {{-- Card --}}
        <div class="bg-surface-container-lowest rounded-2xl premium-shadow p-8 border border-outline-variant/30">

            {{-- Logo --}}
            <div class="flex flex-col items-center gap-3 mb-8">
                <div class="w-16 h-16 bg-primary-fixed flex items-center justify-center rounded-full">
                    @if(setting('logo'))
                        <img src="{{ display_file(setting('logo')) }}" alt="" class="w-10 h-10 object-contain">
                    @else
                        <span class="material-symbols-outlined text-primary" style="font-size:32px">send</span>
                    @endif
                </div>
                <h1 class="text-headline-lg font-bold text-primary">تسجيل الدخول</h1>
                <p class="text-body-md text-on-surface-variant">أهلاً بك مجدداً في منصة {{ setting('website_name', 'زاجل') }}</p>
            </div>

            {{-- Errors --}}
            @if($errors->any())
            <div class="bg-error-container text-on-error-container rounded-xl p-4 mb-5 text-sm">
                @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
            </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('user.login.post') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-label-lg text-on-surface mb-1.5">البريد الإلكتروني</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old('email') }}" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-lg px-4 py-3 text-on-surface focus:ring-2 focus:ring-primary transition-all text-right text-sm @error('email') ring-2 ring-error @enderror"
                               placeholder="example@domain.com" autocomplete="email">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant" style="font-size:18px">mail</span>
                    </div>
                </div>

                <div>
                    <label class="block text-label-lg text-on-surface mb-1.5">كلمة المرور</label>
                    <div class="relative">
                        <input type="password" name="password" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-lg px-4 py-3 text-on-surface focus:ring-2 focus:ring-primary transition-all text-sm @error('password') ring-2 ring-error @enderror"
                               placeholder="••••••••" autocomplete="current-password">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline-variant" style="font-size:18px">lock</span>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded text-primary focus:ring-primary">
                        <span class="text-on-surface-variant text-sm">تذكرني</span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-primary text-on-primary py-3.5 rounded-xl font-bold text-sm hover:bg-primary-container transition-colors premium-shadow">
                    تسجيل الدخول
                </button>
            </form>

            <div class="relative flex items-center py-4">
                <div class="flex-grow border-t border-outline-variant"></div>
                <span class="mx-4 text-outline text-xs">أو</span>
                <div class="flex-grow border-t border-outline-variant"></div>
            </div>

            <p class="text-center text-on-surface-variant text-sm">
                ليس لديك حساب؟
                <a href="{{ route('user.register') }}" class="text-primary font-bold hover:underline">سجل الآن</a>
            </p>

        </div>
    </div>
</div>

@endsection
