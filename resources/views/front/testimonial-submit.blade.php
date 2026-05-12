@extends('front.layouts.app')
@section('title', 'شارك رأيك')

@section('content')

{{-- Page Header --}}
<section class="bg-surface-container-low py-10 border-b border-outline-variant">
    <div class="max-w-[1200px] mx-auto px-4">
        <h1 class="text-display-md font-bold text-primary mb-2">شارك رأيك</h1>
        <p class="text-body-lg text-on-surface-variant">تجربتك تهمنا — ساعد الآخرين بمشاركة تجربتك مع منصة زاجل</p>
    </div>
</section>

<div class="max-w-[720px] mx-auto px-4 py-12">

    {{-- Success --}}
    @if(session('success'))
    <div class="flex items-start gap-3 bg-secondary-container text-on-secondary-fixed-variant rounded-xl p-4 mb-6">
        <span class="material-symbols-outlined text-secondary flex-shrink-0">check_circle</span>
        <p class="text-sm">{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-surface-container-lowest rounded-xl premium-shadow border border-outline-variant/30 p-8">

        <div class="flex items-center gap-3 mb-7">
            <div class="w-10 h-10 rounded-xl bg-primary-fixed flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-primary" style="font-size:20px;font-variation-settings:'FILL' 1">star</span>
            </div>
            <h2 class="font-bold text-on-surface" style="font-size:18px">أضف شهادتك</h2>
        </div>

        <form action="{{ route('testimonials.submit.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Star Rating --}}
            <div>
                <label class="block text-label-lg text-on-surface mb-3">تقييمك <span class="text-error">*</span></label>
                <div class="flex items-center gap-1 flex-row-reverse justify-end" id="star-rating">
                    @for($i = 1; $i <= 5; $i++)
                    <button type="button" data-value="{{ $i }}"
                            class="star-btn text-3xl transition-colors duration-150 text-outline hover:text-yellow-400 focus:outline-none">
                        <span class="material-symbols-outlined" style="font-size:32px">star</span>
                    </button>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', 5) }}">
                @error('rating')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Name + Position --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-label-lg text-on-surface mb-1.5">الاسم <span class="text-error">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full bg-surface-container-low border-none rounded-xl h-12 px-4 text-sm focus:ring-2 focus:ring-primary text-right @error('name') ring-2 ring-error @enderror"
                           placeholder="اسمك الكريم">
                    @error('name')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-label-lg text-on-surface mb-1.5">المسمى الوظيفي</label>
                    <input type="text" name="position" value="{{ old('position') }}"
                           class="w-full bg-surface-container-low border-none rounded-xl h-12 px-4 text-sm focus:ring-2 focus:ring-primary text-right"
                           placeholder="مثال: مدير تنفيذي">
                </div>
            </div>

            {{-- Company + Image --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-label-lg text-on-surface mb-1.5">الشركة / المؤسسة</label>
                    <input type="text" name="company" value="{{ old('company') }}"
                           class="w-full bg-surface-container-low border-none rounded-xl h-12 px-4 text-sm focus:ring-2 focus:ring-primary text-right"
                           placeholder="اختياري">
                </div>
                <div>
                    <label class="block text-label-lg text-on-surface mb-1.5">صورتك الشخصية</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3 text-sm text-on-surface-variant">
                    <p class="text-outline text-xs mt-1">اختياري — حد أقصى 2 ميجابايت</p>
                </div>
            </div>

            {{-- Content --}}
            <div>
                <label class="block text-label-lg text-on-surface mb-1.5">رأيك في زاجل <span class="text-error">*</span></label>
                <textarea name="content" rows="5"
                          class="w-full bg-surface-container-low border-none rounded-xl p-4 text-sm focus:ring-2 focus:ring-primary text-right @error('content') ring-2 ring-error @enderror"
                          placeholder="شاركنا تجربتك مع المنصة...">{{ old('content') }}</textarea>
                @error('content')<p class="text-error text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Info Note --}}
            <div class="flex items-start gap-3 bg-primary-fixed rounded-xl p-4">
                <span class="material-symbols-outlined text-primary flex-shrink-0" style="font-size:18px">info</span>
                <p class="text-on-surface-variant text-sm">سيتم مراجعة شهادتك قبل نشرها على الموقع. نشكرك على مشاركتنا رأيك!</p>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-primary text-on-primary h-12 rounded-xl font-bold text-sm hover:bg-primary-container transition-colors premium-shadow flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined" style="font-size:18px">send</span>
                    إرسال الشهادة
                </button>
                <a href="{{ route('testimonials') }}"
                   class="flex-shrink-0 bg-surface-container-low text-on-surface-variant h-12 px-5 rounded-xl font-semibold text-sm hover:bg-surface-container transition-colors flex items-center justify-center">
                    إلغاء
                </a>
            </div>

        </form>
    </div>
</div>

@push('scripts')
<script>
(function () {
    const buttons = document.querySelectorAll('.star-btn');
    const input = document.getElementById('rating-input');

    function setRating(value) {
        input.value = value;
        buttons.forEach(btn => {
            const v = parseInt(btn.dataset.value);
            const icon = btn.querySelector('.material-symbols-outlined');
            if (v <= value) {
                icon.style.color = '#eab308';
                icon.style.fontVariationSettings = "'FILL' 1";
            } else {
                icon.style.color = '';
                icon.style.fontVariationSettings = '';
            }
        });
    }

    // Initialise with old/default value
    setRating(parseInt(input.value) || 5);

    buttons.forEach(btn => {
        btn.addEventListener('click', () => setRating(parseInt(btn.dataset.value)));
        btn.addEventListener('mouseenter', () => {
            buttons.forEach(b => {
                const v = parseInt(b.dataset.value);
                const icon = b.querySelector('.material-symbols-outlined');
                if (v <= parseInt(btn.dataset.value)) {
                    icon.style.color = '#eab308';
                } else {
                    icon.style.color = '';
                }
            });
        });
        btn.addEventListener('mouseleave', () => setRating(parseInt(input.value) || 5));
    });
})();
</script>
@endpush

@endsection
