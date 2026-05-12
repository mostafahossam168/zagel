@extends('front.layouts.app')
@section('title', 'ملفي الشخصي')

@section('content')

<div class="max-w-[1200px] mx-auto px-4 py-10">

    {{-- Success --}}
    @if(session('success'))
    <div class="flex items-start gap-3 bg-secondary-container text-on-secondary-fixed-variant rounded-xl p-4 mb-6">
        <span class="material-symbols-outlined text-secondary flex-shrink-0">check_circle</span>
        <p class="text-sm">{{ session('success') }}</p>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

        {{-- Sidebar --}}
        <aside class="md:col-span-4 lg:col-span-3">
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-6 flex flex-col items-center text-center">
                <div class="relative mb-4">
                    @if($user->image)
                        <img src="{{ display_file($user->image) }}" alt="{{ $user->name }}"
                             class="w-28 h-28 rounded-full object-cover border-4 border-surface-container">
                    @else
                        <div class="w-28 h-28 rounded-full bg-primary-fixed flex items-center justify-center border-4 border-surface-container">
                            <span class="material-symbols-outlined text-primary" style="font-size:48px">person</span>
                        </div>
                    @endif
                </div>
                <h2 class="font-semibold text-on-surface mb-1" style="font-size:18px">{{ $user->name }}</h2>
                <p class="text-on-surface-variant text-sm mb-6">{{ $user->email }}</p>

                <nav class="w-full space-y-1 text-right">
                    <a href="{{ route('user.profile') }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl bg-primary-fixed text-primary font-semibold text-sm">
                        <span class="material-symbols-outlined" style="font-size:18px;font-variation-settings:'FILL' 1">person</span>
                        ملفي
                    </a>
                    <a href="{{ route('user.listings.index') }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-on-surface-variant hover:bg-surface-container-low transition-colors text-sm">
                        <span class="material-symbols-outlined" style="font-size:18px">work</span>
                        خدماتي
                    </a>
                    <a href="{{ route('user.listings.create') }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-on-surface-variant hover:bg-surface-container-low transition-colors text-sm">
                        <span class="material-symbols-outlined" style="font-size:18px">add_circle</span>
                        أضف خدمة
                    </a>
                    <a href="{{ route('user.notifications.index') }}"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-on-surface-variant hover:bg-surface-container-low transition-colors text-sm">
                        <span class="material-symbols-outlined" style="font-size:18px">notifications</span>
                        الإشعارات
                    </a>
                    <form action="{{ route('user.logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-error hover:bg-error-container transition-colors text-sm">
                            <span class="material-symbols-outlined" style="font-size:18px">logout</span>
                            تسجيل الخروج
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

        {{-- Main Content --}}
        <section class="md:col-span-8 lg:col-span-9 space-y-6">

            {{-- Edit Profile Form --}}
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-6">
                <h3 class="font-semibold text-primary mb-6 border-r-4 border-primary pr-3 leading-none" style="font-size:18px">
                    تعديل الملف الشخصي
                </h3>
                <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-label-lg text-on-surface-variant mb-1.5">الاسم الكامل</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                   class="w-full bg-surface-container-low border-none rounded-xl p-3 focus:ring-2 focus:ring-primary text-sm text-right @error('name') ring-2 ring-error @enderror">
                            @error('name')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-label-lg text-on-surface-variant mb-1.5">البريد الإلكتروني</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" dir="ltr"
                                   class="w-full bg-surface-container-low border-none rounded-xl p-3 focus:ring-2 focus:ring-primary text-sm text-right @error('email') ring-2 ring-error @enderror">
                            @error('email')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-label-lg text-on-surface-variant mb-1.5">رقم الجوال</label>
                            <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" dir="ltr"
                                   class="w-full bg-surface-container-low border-none rounded-xl p-3 focus:ring-2 focus:ring-primary text-sm text-right @error('phone') ring-2 ring-error @enderror">
                            @error('phone')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-label-lg text-on-surface-variant mb-1.5">الصورة الشخصية</label>
                            <label for="avatarInput" class="relative flex flex-col items-center justify-center gap-2 bg-surface-container-low rounded-xl p-4 cursor-pointer hover:bg-surface-container transition-colors border-2 border-dashed border-outline-variant hover:border-primary group">
                                <div id="avatarPreviewWrap">
                                    @if($user->image)
                                        <img id="avatarPreview" src="{{ display_file($user->image) }}"
                                             class="w-16 h-16 rounded-full object-cover ring-2 ring-primary" alt="">
                                    @else
                                        <div id="avatarPreview" class="w-16 h-16 rounded-full bg-primary-fixed flex items-center justify-center">
                                            <span class="material-symbols-outlined text-primary" style="font-size:28px">person</span>
                                        </div>
                                    @endif
                                </div>
                                <span class="text-xs text-on-surface-variant group-hover:text-primary transition-colors">انقر لتغيير الصورة</span>
                                <input id="avatarInput" type="file" name="image" accept="image/*" class="hidden">
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-outline-variant">
                        <h4 class="text-on-surface-variant text-sm font-semibold mb-4">تغيير كلمة المرور (اختياري)</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-label-lg text-on-surface-variant mb-1.5">كلمة المرور الحالية</label>
                                <input type="password" name="current_password" dir="ltr"
                                       class="w-full bg-surface-container-low border-none rounded-xl p-3 focus:ring-2 focus:ring-primary text-sm @error('current_password') ring-2 ring-error @enderror"
                                       placeholder="••••••••">
                                @error('current_password')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-label-lg text-on-surface-variant mb-1.5">كلمة المرور الجديدة</label>
                                <input type="password" name="password" dir="ltr"
                                       class="w-full bg-surface-container-low border-none rounded-xl p-3 focus:ring-2 focus:ring-primary text-sm"
                                       placeholder="••••••••">
                            </div>
                            <div>
                                <label class="block text-label-lg text-on-surface-variant mb-1.5">تأكيد كلمة المرور</label>
                                <input type="password" name="password_confirmation" dir="ltr"
                                       class="w-full bg-surface-container-low border-none rounded-xl p-3 focus:ring-2 focus:ring-primary text-sm"
                                       placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-start">
                        <button type="submit"
                            class="bg-primary text-on-primary px-8 py-2.5 rounded-xl font-semibold text-sm hover:bg-primary-container transition-colors premium-shadow">
                            حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>

            {{-- Quick link to services page --}}
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-5 flex items-center justify-between">
                <div>
                    <h4 class="font-semibold text-on-surface text-sm mb-0.5">إدارة خدماتي</h4>
                    <p class="text-on-surface-variant text-xs">عرض وتعديل وحذف خدماتك المقدمة</p>
                </div>
                <a href="{{ route('user.listings.index') }}"
                   class="flex items-center gap-1.5 bg-primary text-on-primary px-4 py-2 rounded-xl text-sm font-semibold hover:bg-primary-container transition-colors flex-shrink-0">
                    <span class="material-symbols-outlined" style="font-size:16px">work</span>
                    خدماتي
                </a>
            </div>

        </section>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('avatarInput').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function (e) {
        const wrap = document.getElementById('avatarPreviewWrap');
        wrap.innerHTML = '<img id="avatarPreview" src="' + e.target.result + '" class="w-16 h-16 rounded-full object-cover ring-2 ring-primary" alt="">';
    };
    reader.readAsDataURL(file);
});
</script>
@endpush

@endsection
