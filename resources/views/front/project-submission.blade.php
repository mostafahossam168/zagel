@extends('front.layouts.app')
@section('title', 'اطلب مشروعك')

@section('content')

    <div class="min-h-screen py-12 px-4 bg-background">
        <div class="max-w-[680px] mx-auto">

            {{-- Header --}}
            <div class="text-center mb-10">
                <h1 class="text-display-md font-bold text-primary mb-2">اطلب مشروعك</h1>
                <p class="text-body-lg text-on-surface-variant">
                    شاركنا تفاصيل مشروعك وسنقوم بربطك بأفضل المحترفين في المنطقة
                </p>
            </div>

            {{-- Success --}}
            @if (session('success'))
                <div
                    class="flex items-start gap-3 bg-secondary-container text-on-secondary-fixed-variant rounded-xl p-4 mb-6">
                    <span class="material-symbols-outlined text-secondary flex-shrink-0">check_circle</span>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            @endif

            {{-- Form --}}
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-8 border border-outline-variant">
                <form method="POST" action="{{ route('project.store') }}" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-label-lg text-on-surface-variant mb-1.5">الاسم الكامل <span
                                    class="text-error">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full bg-surface-container-low border-none rounded-lg p-3 text-sm focus:ring-2 focus:ring-primary transition-all text-right @error('name') ring-2 ring-error @enderror"
                                placeholder="أدخل اسمك الثلاثي">
                            @error('name')
                                <p class="text-error text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-label-lg text-on-surface-variant mb-1.5">البريد الإلكتروني <span
                                    class="text-error">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full bg-surface-container-low border-none rounded-lg p-3 text-sm focus:ring-2 focus:ring-primary transition-all text-right @error('email') ring-2 ring-error @enderror"
                                placeholder="example@mail.com" dir="ltr">
                            @error('email')
                                <p class="text-error text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-label-lg text-on-surface-variant mb-1.5">رقم الجوال <span
                                    class="text-error">*</span></label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                class="w-full bg-surface-container-low border-none rounded-lg p-3 text-sm focus:ring-2 focus:ring-primary transition-all text-right @error('phone') ring-2 ring-error @enderror"
                                placeholder="05xxxxxxxx" dir="ltr">
                            @error('phone')
                                <p class="text-error text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-label-lg text-on-surface-variant mb-1.5">عنوان المشروع <span
                                    class="text-error">*</span></label>
                            <input type="text" name="project_title" value="{{ old('project_title') }}"
                                class="w-full bg-surface-container-low border-none rounded-lg p-3 text-sm focus:ring-2 focus:ring-primary transition-all text-right @error('project_title') ring-2 ring-error @enderror"
                                placeholder="مثلاً: تطوير تطبيق متجر إلكتروني">
                            @error('project_title')
                                <p class="text-error text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-label-lg text-on-surface-variant mb-1.5">وصف المشروع <span
                                class="text-error">*</span></label>
                        <textarea name="project_description" rows="5"
                            class="w-full bg-surface-container-low border-none rounded-lg p-3 text-sm focus:ring-2 focus:ring-primary transition-all text-right @error('project_description') ring-2 ring-error @enderror"
                            placeholder="اشرح تفاصيل مشروعك، أهدافه، والنتائج المتوقعة...">{{ old('project_description') }}</textarea>
                        @error('project_description')
                            <p class="text-error text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-label-lg text-on-surface-variant mb-1.5">احتياجاتك الإضافية</label>
                        <input type="text" name="needs" value="{{ old('needs') }}"
                            class="w-full bg-surface-container-low border-none rounded-lg p-3 text-sm focus:ring-2 focus:ring-primary transition-all text-right"
                            placeholder="ملفات، تصاميم سابقة، أو مواعيد نهائية">
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-primary text-on-primary py-4 rounded-xl font-bold text-sm hover:bg-primary-container transition-colors premium-shadow">
                            إرسال المشروع
                        </button>
                    </div>
                </form>
            </div>

            {{-- Trust Badges --}}
            <div class="mt-8 grid grid-cols-3 gap-4 text-center">
                <div class="flex flex-col items-center p-3">
                    <span class="material-symbols-outlined text-secondary mb-1" style="font-size:28px">verified_user</span>
                    <h3 class="font-semibold text-on-surface text-xs">أمان تام</h3>
                    <p class="text-on-surface-variant text-xs mt-0.5">بياناتك في أيدي أمينة</p>
                </div>
                <div class="flex flex-col items-center p-3">
                    <span class="material-symbols-outlined text-secondary mb-1" style="font-size:28px">speed</span>
                    <h3 class="font-semibold text-on-surface text-xs">استجابة سريعة</h3>
                    <p class="text-on-surface-variant text-xs mt-0.5">تحليل المشروع خلال 24 ساعة</p>
                </div>
                <div class="flex flex-col items-center p-3">
                    <span class="material-symbols-outlined text-secondary mb-1" style="font-size:28px">groups</span>
                    <h3 class="font-semibold text-on-surface text-xs">خبراء متخصصون</h3>
                    <p class="text-on-surface-variant text-xs mt-0.5">أفضل الكفاءات في خدمتك</p>
                </div>
            </div>

        </div>
    </div>

@endsection
