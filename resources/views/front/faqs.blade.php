@extends('front.layouts.app')
@section('title', 'الأسئلة الشائعة')

@section('content')

{{-- Page Header --}}
<section class="bg-surface-container-low py-10 border-b border-outline-variant">
    <div class="max-w-[1200px] mx-auto px-4">
        <h1 class="text-display-md font-bold text-primary mb-2">الأسئلة الشائعة</h1>
        <p class="text-body-lg text-on-surface-variant">إجابات على أكثر الأسئلة شيوعاً</p>
    </div>
</section>

<div class="max-w-[800px] mx-auto px-4 py-12">

    @if($faqs->count())
    <div class="space-y-3">
        @foreach($faqs as $i => $faq)
        <div class="bg-surface-container-lowest rounded-xl premium-shadow overflow-hidden">
            <button type="button"
                class="faq-trigger w-full flex items-center justify-between gap-4 px-6 py-4 text-right hover:bg-surface-container-low transition-colors">
                <span class="font-semibold text-on-surface text-sm leading-relaxed">{{ $faq->question }}</span>
                <span class="material-symbols-outlined text-primary flex-shrink-0 faq-icon" style="font-size:20px">
                    {{ $i === 0 ? 'remove' : 'add' }}
                </span>
            </button>
            <div class="faq-body {{ $i === 0 ? 'open' : '' }}">
                <div class="px-6 pb-5 text-on-surface-variant text-sm leading-relaxed border-t border-outline-variant pt-4">
                    {{ $faq->answer }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @else
    <div class="text-center py-20">
        <span class="material-symbols-outlined text-outline mb-4" style="font-size:56px">help_outline</span>
        <p class="text-on-surface-variant text-sm">لا توجد أسئلة شائعة بعد</p>
    </div>
    @endif

    {{-- Contact prompt --}}
    <div class="mt-10 bg-primary-fixed rounded-xl p-6 text-center">
        <span class="material-symbols-outlined text-primary mb-3 block" style="font-size:36px">support_agent</span>
        <h3 class="font-bold text-on-surface mb-2" style="font-size:17px">لم تجد إجابة لسؤالك؟</h3>
        <p class="text-on-surface-variant text-sm mb-4">تواصل مع فريق الدعم وسنرد عليك في أقرب وقت</p>
        <a href="{{ route('contact') }}"
           class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-2.5 rounded-xl font-semibold text-sm hover:bg-primary-container transition-colors premium-shadow">
            <span class="material-symbols-outlined" style="font-size:16px">mail</span>
            تواصل معنا
        </a>
    </div>

</div>

@endsection
