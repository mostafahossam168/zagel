@extends('front.layouts.app')
@section('title', 'أضف خدمتك')

@section('content')

<div class="py-12 px-4 flex flex-col items-center">

    {{-- Header --}}
    <div class="w-full max-w-[720px] mb-8 text-center">
        <h1 class="text-display-md font-bold text-primary mb-2">أضف خدمتك</h1>
        <p class="text-body-lg text-on-surface-variant">شارك مهاراتك مع مجتمع زاجل وابدأ رحلة نجاحك المهني</p>
    </div>

    {{-- Success --}}
    @if(session('success'))
    <div class="w-full max-w-[720px] mb-6">
        <div class="flex items-start gap-3 bg-secondary-container text-on-secondary-fixed-variant rounded-xl p-4">
            <span class="material-symbols-outlined text-secondary flex-shrink-0">check_circle</span>
            <p class="text-sm">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    {{-- Form Card --}}
    <div class="w-full max-w-[720px] bg-surface-container-lowest rounded-xl premium-shadow border border-outline-variant/30 p-8">
        <form method="POST" action="{{ route('user.listings.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label class="block text-label-lg text-on-surface mb-1.5">عنوان الخدمة <span class="text-error">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full bg-surface-container-low border-none rounded-xl h-12 px-4 text-sm focus:ring-2 focus:ring-primary text-right @error('title') ring-2 ring-error @enderror"
                       placeholder="مثلاً: تصميم هوية بصرية متكاملة">
                @error('title')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-label-lg text-on-surface mb-1.5">الوصف <span class="text-error">*</span></label>
                <textarea name="description" rows="4"
                          class="w-full bg-surface-container-low border-none rounded-xl p-4 text-sm focus:ring-2 focus:ring-primary text-right @error('description') ring-2 ring-error @enderror"
                          placeholder="اشرح تفاصيل الخدمة والمميزات التي ستقدمها للعميل...">{{ old('description') }}</textarea>
                @error('description')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Image Upload --}}
            <div>
                <label class="block text-label-lg text-on-surface mb-1.5">صورة الخدمة</label>
                <div class="relative border-2 border-dashed border-outline-variant rounded-xl p-8 flex flex-col items-center justify-center bg-surface-container-low hover:bg-surface-container transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-primary mb-3" style="font-size:40px">cloud_upload</span>
                    <p class="text-on-surface-variant text-sm">اسحب الصورة هنا أو <span class="text-primary underline">تصفح ملفاتك</span></p>
                    <p class="text-outline text-xs mt-1">PNG, JPG حتى 3 ميجابايت</p>
                    <input type="file" name="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>

            {{-- Category & Price --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-label-lg text-on-surface mb-1.5">التصنيف</label>
                    <select name="category_id" class="w-full bg-surface-container-low border-none rounded-xl h-12 px-4 text-sm focus:ring-2 focus:ring-primary">
                        <option value="">اختر التصنيف...</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-label-lg text-on-surface mb-1.5">السعر</label>
                    <div class="flex gap-0">
                        <input type="number" name="price" value="{{ old('price') }}"
                               class="flex-1 bg-surface-container-low border-none rounded-r-xl h-12 px-4 text-sm focus:ring-2 focus:ring-primary"
                               placeholder="0.00" min="0" step="0.01">
                        <select name="currency" class="w-20 bg-surface-container-high border-none rounded-l-xl h-12 px-2 text-sm focus:ring-2 focus:ring-primary">
                            <option value="ر.س" {{ old('currency', 'ر.س') == 'ر.س' ? 'selected' : '' }}>ر.س</option>
                            <option value="$" {{ old('currency') == '$' ? 'selected' : '' }}>$</option>
                            <option value="€" {{ old('currency') == '€' ? 'selected' : '' }}>€</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Contact Info --}}
            <div class="pt-4 border-t border-outline-variant/30">
                <h3 class="font-semibold text-primary mb-5" style="font-size:17px">معلومات التواصل</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-label-lg text-on-surface mb-1.5">رقم الهاتف <span class="text-error">*</span></label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline" style="font-size:16px">call</span>
                            <input type="tel" name="contact_phone" value="{{ old('contact_phone') }}" dir="ltr"
                                   class="w-full bg-surface-container-low border-none rounded-xl h-12 px-4 pl-9 text-sm focus:ring-2 focus:ring-primary @error('contact_phone') ring-2 ring-error @enderror"
                                   placeholder="05xxxxxxxx">
                        </div>
                        @error('contact_phone')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-label-lg text-on-surface mb-1.5">واتساب (اختياري)</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline" style="font-size:16px">chat</span>
                            <input type="tel" name="contact_whatsapp" value="{{ old('contact_whatsapp') }}" dir="ltr"
                                   class="w-full bg-surface-container-low border-none rounded-xl h-12 px-4 pl-9 text-sm focus:ring-2 focus:ring-primary"
                                   placeholder="05xxxxxxxx">
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-label-lg text-on-surface mb-1.5">البريد الإلكتروني (اختياري)</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline" style="font-size:16px">mail</span>
                            <input type="email" name="contact_email" value="{{ old('contact_email') }}" dir="ltr"
                                   class="w-full bg-surface-container-low border-none rounded-xl h-12 px-4 pl-9 text-sm focus:ring-2 focus:ring-primary"
                                   placeholder="example@domain.com">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Links --}}
            <div>
                <label class="block text-label-lg text-on-surface mb-3">روابط الشبكات الاجتماعية (اختيارية)</label>
                <div class="space-y-3">
                    <div class="relative">
                        <span class="text-outline absolute right-3 top-1/2 -translate-y-1/2 text-xs font-bold">in</span>
                        <input type="url" name="contact_linkedin" value="{{ old('contact_linkedin') }}" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl h-12 px-4 text-sm focus:ring-2 focus:ring-primary"
                               placeholder="LinkedIn URL">
                    </div>
                    <div class="relative">
                        <span class="text-outline absolute right-3 top-1/2 -translate-y-1/2 text-xs font-bold">X</span>
                        <input type="url" name="contact_twitter" value="{{ old('contact_twitter') }}" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl h-12 px-4 text-sm focus:ring-2 focus:ring-primary"
                               placeholder="X (Twitter) URL">
                    </div>
                    <div class="relative">
                        <span class="text-outline absolute right-3 top-1/2 -translate-y-1/2 text-xs font-bold">fb</span>
                        <input type="url" name="contact_facebook" value="{{ old('contact_facebook') }}" dir="ltr"
                               class="w-full bg-surface-container-low border-none rounded-xl h-12 px-4 text-sm focus:ring-2 focus:ring-primary"
                               placeholder="Facebook URL">
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit"
                    class="w-full bg-primary text-on-primary h-14 rounded-xl font-bold text-sm hover:bg-primary-container transition-colors premium-shadow flex items-center justify-center gap-2">
                    إرسال الخدمة للمراجعة
                    <span class="material-symbols-outlined" style="font-size:18px">send</span>
                </button>
                <p class="text-center text-outline text-xs mt-3">
                    بالنقر على الإرسال، فإنك توافق على شروط الخدمة وسياسة الخصوصية الخاصة بنا.
                </p>
            </div>

        </form>
    </div>
</div>

@endsection
