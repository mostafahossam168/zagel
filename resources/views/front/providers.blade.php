@extends('front.layouts.app')
@section('title', 'مزودو الخدمة')

@section('content')

{{-- Page Header --}}
<section class="bg-surface-container-low py-10 border-b border-outline-variant">
    <div class="max-w-[1200px] mx-auto px-4">
        <nav class="flex items-center gap-1 text-xs text-on-surface-variant mb-3">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">الرئيسية</a>
            <span class="material-symbols-outlined" style="font-size:14px">chevron_left</span>
            <span class="text-primary font-semibold">مزودو الخدمة</span>
        </nav>
        <h1 class="text-display-md font-bold text-primary mb-2">مزودو الخدمة المعتمدون</h1>
        <p class="text-body-lg text-on-surface-variant max-w-2xl">
            اكتشف نخبة من المحترفين والشركات المعتمدة لتقديم أفضل الخدمات بجودة عالية واحترافية متناهية.
        </p>
    </div>
</section>

<div class="max-w-[1200px] mx-auto px-4 py-10">

    {{-- Category Filter Chips --}}
    @php $categories = \App\Models\Category::all(); @endphp
    @if($categories->count())
    <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-8 no-scrollbar">
        <a href="{{ route('providers.index') }}"
           class="flex-shrink-0 {{ !request('category') ? 'bg-primary text-on-primary' : 'bg-surface-container-highest text-on-surface-variant hover:bg-outline-variant' }} px-5 py-2 rounded-full text-label-lg font-semibold transition-colors">
            الكل
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('providers.index', ['category' => $cat->id]) }}"
           class="flex-shrink-0 {{ request('category') == $cat->id ? 'bg-primary text-on-primary' : 'bg-surface-container-highest text-on-surface-variant hover:bg-outline-variant' }} px-5 py-2 rounded-full text-label-lg font-semibold transition-colors">
            {{ $cat->name }}
        </a>
        @endforeach
    </div>
    @endif

    {{-- Providers Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($listings as $listing)
        <div class="bg-surface-container-lowest rounded-xl premium-shadow overflow-hidden flex flex-col border border-outline-variant/30 hover:border-primary/30 transition-all duration-300">
            <div class="relative h-48 overflow-hidden">
                @if($listing->image)
                    <img src="{{ display_file($listing->image) }}" alt="{{ $listing->title }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-primary-fixed flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary" style="font-size:56px">person</span>
                    </div>
                @endif
                <div class="absolute top-3 right-3 bg-secondary text-on-secondary px-2.5 py-0.5 rounded-lg text-xs font-semibold">
                    مقبول
                </div>
            </div>
            <div class="p-5 flex flex-col flex-grow text-right">
                <div class="flex items-start justify-between mb-1">
                    <h3 class="font-semibold text-on-surface" style="font-size:17px">{{ $listing->title }}</h3>
                </div>
                @if($listing->category)
                <span class="text-primary text-sm font-semibold mb-3">{{ $listing->category->name }}</span>
                @endif
                <p class="text-on-surface-variant text-sm mb-4 line-clamp-2 leading-relaxed">
                    {{ Str::limit($listing->description, 90) }}
                </p>
                <div class="flex items-center justify-between mt-auto pt-3 border-t border-outline-variant/30">
                    @if($listing->price)
                    <div class="font-bold text-on-surface" style="font-size:16px">
                        {{ number_format($listing->price) }} <span class="text-xs font-normal">{{ $listing->currency }}/ساعة</span>
                    </div>
                    @endif
                    <div class="flex gap-2">
                        @if($listing->contact_phone)
                        <a href="tel:{{ $listing->contact_phone }}"
                           class="w-9 h-9 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-primary hover:text-on-primary transition-colors">
                            <span class="material-symbols-outlined" style="font-size:16px">call</span>
                        </a>
                        @endif
                        @if($listing->contact_whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $listing->contact_whatsapp) }}" target="_blank"
                           class="w-9 h-9 flex items-center justify-center rounded-full bg-surface-container-high text-green-600 hover:bg-green-600 hover:text-white transition-colors">
                            <span class="material-symbols-outlined" style="font-size:16px">chat</span>
                        </a>
                        @endif
                        @if($listing->contact_email)
                        <a href="mailto:{{ $listing->contact_email }}"
                           class="w-9 h-9 flex items-center justify-center rounded-full bg-surface-container-high text-on-surface-variant hover:bg-primary hover:text-white transition-colors">
                            <span class="material-symbols-outlined" style="font-size:16px">mail</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center text-on-surface-variant py-20">
            <span class="material-symbols-outlined text-outline mb-3" style="font-size:48px">people_outline</span>
            <p class="text-sm">لا يوجد مزودو خدمة معتمدون حالياً</p>
        </div>
        @endforelse
    </div>

</div>

@endsection
