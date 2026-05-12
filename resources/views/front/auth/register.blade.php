@extends('front.layouts.app')
@section('title', 'إنشاء حساب')

@section('content')

<div class="min-h-screen flex items-center justify-center py-12 px-4 bg-background">
    <div class="w-full max-w-[440px]">

        <div class="bg-surface-container-lowest rounded-2xl premium-shadow p-8 border border-outline-variant/30">

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-fixed mb-4">
                    <span class="material-symbols-outlined text-primary" style="font-size:32px">person_add</span>
                </div>
                <h1 class="text-headline-lg font-bold text-on-surface mb-1">إنشاء حساب جديد</h1>
                <p class="text-body-md text-on-surface-variant">انضم إلى مجتمع {{ setting('website_name', 'زاجل') }} للخدمات الموثوقة</p>
            </div>

            {{-- Errors --}}
            @if($errors->any())
            <div class="bg-error-container text-on-error-container rounded-xl p-4 mb-5 text-sm">
                @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
            </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('user.register.post') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-label-lg text-on-surface-variant mb-1.5">الاسم الكامل</label>
                    <div class="relative">
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full bg-surface-container-low border-none rounded-xl py-3 pr-10 pl-4 text-sm focus:ring-2 focus:ring-primary transition-all text-right @error('name') ring-2 ring-error @enderror"
                               placeholder="أدخل اسمك بالكامل">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline" style="font-size:18px">person</span>
                    </div>
                    @error('name')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-label-lg text-on-surface-variant mb-1.5">البريد الإلكتروني</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old('email') }}" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl py-3 pr-10 pl-4 text-sm focus:ring-2 focus:ring-primary transition-all text-right @error('email') ring-2 ring-error @enderror"
                               placeholder="example@mail.com">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline" style="font-size:18px">mail</span>
                    </div>
                    @error('email')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-label-lg text-on-surface-variant mb-1.5">كلمة المرور</label>
                    <div class="relative">
                        <input type="password" name="password" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl py-3 pr-10 pl-4 text-sm focus:ring-2 focus:ring-primary transition-all @error('password') ring-2 ring-error @enderror"
                               placeholder="••••••••">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline" style="font-size:18px">lock</span>
                    </div>
                    @error('password')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-label-lg text-on-surface-variant mb-1.5">تأكيد كلمة المرور</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl py-3 pr-10 pl-4 text-sm focus:ring-2 focus:ring-primary transition-all"
                               placeholder="••••••••">
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline" style="font-size:18px">verified_user</span>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-primary text-on-primary py-3.5 rounded-xl font-bold text-sm hover:bg-primary-container transition-colors premium-shadow mt-2">
                    إنشاء الحساب
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-outline-variant text-center">
                <p class="text-on-surface-variant text-sm">
                    لديك حساب بالفعل؟
                    <a href="{{ route('user.login') }}" class="text-primary font-bold hover:underline">تسجيل الدخول</a>
                </p>
            </div>

        </div>
    </div>
</div>

@endsection
