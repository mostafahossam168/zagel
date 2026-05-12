@extends('front.layouts.app')
@section('title', 'آراء عملائنا')

@section('content')

{{-- Page Header --}}
<section class="bg-surface-container-low py-10 border-b border-outline-variant">
    <div class="max-w-[1200px] mx-auto px-4">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h1 class="text-display-md font-bold text-primary mb-2">آراء عملائنا</h1>
                <p class="text-body-lg text-on-surface-variant">قصص نجاح حقيقية من عملائنا الكرام</p>
            </div>
            <a href="{{ route('testimonials.submit') }}"
               class="flex items-center gap-2 bg-primary text-on-primary px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-primary-container transition-colors premium-shadow flex-shrink-0">
                <span class="material-symbols-outlined" style="font-size:16px">star</span>
                شارك رأيك
            </a>
        </div>
    </div>
</section>

<div class="max-w-[1200px] mx-auto px-4 py-12">

    @if($testimonials->count())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($testimonials as $t)
        <div class="bg-surface-container-lowest rounded-xl premium-shadow p-6 flex flex-col">

            {{-- Stars --}}
            <div class="flex items-center gap-0.5 mb-4">
                @for($i = 1; $i <= 5; $i++)
                <span class="material-symbols-outlined {{ $i <= $t->rating ? 'text-yellow-500' : 'text-outline' }}"
                      style="font-size:18px;{{ $i <= $t->rating ? 'font-variation-settings:\'FILL\' 1' : '' }}">
                    star
                </span>
                @endfor
            </div>

            {{-- Content --}}
            <p class="text-on-surface-variant text-sm leading-relaxed mb-5 flex-grow">
                "{{ $t->content }}"
            </p>

            {{-- Author --}}
            <div class="flex items-center gap-3 pt-4 border-t border-outline-variant">
                @if($t->image)
                    <img src="{{ display_file($t->image) }}" alt="{{ $t->name }}"
                         class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                @else
                    <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-primary" style="font-size:22px">person</span>
                    </div>
                @endif
                <div class="text-right">
                    <div class="font-semibold text-on-surface text-sm">{{ $t->name }}</div>
                    @if($t->position || $t->company)
                    <div class="text-on-surface-variant text-xs mt-0.5">
                        {{ $t->position }}{{ ($t->position && $t->company) ? ' — ' : '' }}{{ $t->company }}
                    </div>
                    @endif
                </div>
            </div>

        </div>
        @endforeach
    </div>

    @else
    <div class="text-center py-20">
        <span class="material-symbols-outlined text-outline mb-4" style="font-size:56px">star_outline</span>
        <p class="text-on-surface-variant text-sm mb-6">لا توجد شهادات بعد</p>
        <a href="{{ route('testimonials.submit') }}"
           class="inline-flex items-center gap-2 bg-primary text-on-primary px-6 py-2.5 rounded-xl font-semibold text-sm hover:bg-primary-container transition-colors premium-shadow">
            <span class="material-symbols-outlined" style="font-size:16px">add</span>
            كن أول من يشارك رأيه
        </a>
    </div>
    @endif

</div>

@endsection
