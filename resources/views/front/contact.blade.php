@extends('front.layouts.app')
@section('title', 'تواصل معنا')

@section('content')

<section class="bg-surface-container-low py-10 border-b border-outline-variant">
    <div class="max-w-[1200px] mx-auto px-4">
        <h1 class="text-display-md font-bold text-primary mb-2">تواصل معنا</h1>
        <p class="text-body-lg text-on-surface-variant">نحن هنا للإجابة على استفساراتك ومساعدتك</p>
    </div>
</section>

<div class="max-w-[1200px] mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

        {{-- Form --}}
        <div class="lg:col-span-3">
            @if(session('success'))
            <div class="flex items-start gap-3 bg-secondary-container text-on-secondary-fixed-variant rounded-xl p-4 mb-6">
                <span class="material-symbols-outlined text-secondary flex-shrink-0">check_circle</span>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
            @endif

            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-7">
                <h2 class="font-semibold text-primary mb-6" style="font-size:20px">أرسل لنا رسالة</h2>
                <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-label-lg text-on-surface-variant mb-1.5">الاسم <span class="text-error">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-primary text-right @error('name') ring-2 ring-error @enderror">
                            @error('name')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-label-lg text-on-surface-variant mb-1.5">البريد الإلكتروني <span class="text-error">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" dir="ltr"
                                   class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-primary text-right @error('email') ring-2 ring-error @enderror">
                            @error('email')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-label-lg text-on-surface-variant mb-1.5">رقم الجوال</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-primary text-right">
                    </div>
                    <div>
                        <label class="block text-label-lg text-on-surface-variant mb-1.5">الرسالة <span class="text-error">*</span></label>
                        <textarea name="message" rows="5"
                                  class="w-full bg-surface-container-low border-none rounded-xl p-3 text-sm focus:ring-2 focus:ring-primary text-right @error('message') ring-2 ring-error @enderror"
                                  placeholder="اكتب رسالتك هنا...">{{ old('message') }}</textarea>
                        @error('message')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit"
                        class="w-full bg-primary text-on-primary py-3.5 rounded-xl font-bold text-sm hover:bg-primary-container transition-colors premium-shadow">
                        إرسال الرسالة
                    </button>
                </form>
            </div>
        </div>

        {{-- Contact Info --}}
        <div class="lg:col-span-2 space-y-4">
            @if(setting('email'))
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-5 flex items-start gap-4">
                <div class="w-10 h-10 bg-primary-fixed flex items-center justify-center rounded-xl flex-shrink-0">
                    <span class="material-symbols-outlined text-primary" style="font-size:20px">mail</span>
                </div>
                <div class="text-right">
                    <h4 class="font-semibold text-on-surface text-sm mb-0.5">البريد الإلكتروني</h4>
                    <p class="text-on-surface-variant text-sm">{{ setting('email') }}</p>
                </div>
            </div>
            @endif
            @if(setting('phone'))
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-5 flex items-start gap-4">
                <div class="w-10 h-10 bg-primary-fixed flex items-center justify-center rounded-xl flex-shrink-0">
                    <span class="material-symbols-outlined text-primary" style="font-size:20px">call</span>
                </div>
                <div class="text-right">
                    <h4 class="font-semibold text-on-surface text-sm mb-0.5">رقم الهاتف</h4>
                    <p class="text-on-surface-variant text-sm">{{ setting('phone') }}</p>
                </div>
            </div>
            @endif
            @if(setting('address'))
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-5 flex items-start gap-4">
                <div class="w-10 h-10 bg-primary-fixed flex items-center justify-center rounded-xl flex-shrink-0">
                    <span class="material-symbols-outlined text-primary" style="font-size:20px">location_on</span>
                </div>
                <div class="text-right">
                    <h4 class="font-semibold text-on-surface text-sm mb-0.5">العنوان</h4>
                    <p class="text-on-surface-variant text-sm">{{ setting('address') }}</p>
                </div>
            </div>
            @endif
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-5 flex items-start gap-4">
                <div class="w-10 h-10 bg-primary-fixed flex items-center justify-center rounded-xl flex-shrink-0">
                    <span class="material-symbols-outlined text-primary" style="font-size:20px">schedule</span>
                </div>
                <div class="text-right">
                    <h4 class="font-semibold text-on-surface text-sm mb-0.5">ساعات العمل</h4>
                    <p class="text-on-surface-variant text-sm">الأحد – الخميس: 9 صباحاً – 6 مساءً</p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
