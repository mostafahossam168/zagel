@extends('front.layouts.app')
@section('title', $service->title_ar)

@section('content')

<div class="max-w-[1200px] mx-auto px-4 py-10">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-1 text-xs text-on-surface-variant mb-8">
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">الرئيسية</a>
        <span class="material-symbols-outlined" style="font-size:14px">chevron_left</span>
        <a href="{{ route('services.index') }}" class="hover:text-primary transition-colors">الخدمات</a>
        <span class="material-symbols-outlined" style="font-size:14px">chevron_left</span>
        <span class="text-primary font-semibold">{{ $service->title_ar }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Main Content --}}
        <div class="lg:col-span-2">
            {{-- Hero Image --}}
            @if($service->image)
            <div class="rounded-2xl overflow-hidden mb-6 h-72 md:h-96">
                <img src="{{ display_file($service->image) }}" alt="{{ $service->title_ar }}"
                     class="w-full h-full object-cover">
            </div>
            @endif

            {{-- Title & Meta --}}
            <div class="flex flex-wrap items-center gap-3 mb-4">
                @if($service->category)
                <span class="bg-secondary text-on-secondary text-xs font-semibold px-3 py-1 rounded-full">
                    {{ $service->category->name }}
                </span>
                @endif
                @if($service->is_purchasable)
                <span class="bg-tertiary-fixed text-tertiary text-xs font-semibold px-3 py-1 rounded-full">
                    قابل للشراء
                </span>
                @endif
            </div>

            <h1 class="text-display-md font-bold text-primary mb-4 text-right">{{ $service->title_ar }}</h1>

            @if($service->title_en)
            <h2 class="text-headline-md text-on-surface-variant mb-6 text-left" dir="ltr">{{ $service->title_en }}</h2>
            @endif

            {{-- Description --}}
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-6 mb-6 text-right">
                <h3 class="font-semibold text-primary mb-4 text-headline-md">وصف الخدمة</h3>
                <div class="text-on-surface text-body-md leading-relaxed prose prose-sm max-w-none">
                    {!! nl2br(e($service->description_ar)) !!}
                </div>
            </div>

            @if($service->description_en)
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-6 text-left">
                <h3 class="font-semibold text-primary mb-4 text-headline-md">Service Description</h3>
                <div class="text-on-surface text-body-md leading-relaxed" dir="ltr">
                    {!! nl2br(e($service->description_en)) !!}
                </div>
            </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-6 text-right sticky top-24">
                {{-- Price --}}
                @if($service->price)
                <div class="mb-5 pb-5 border-b border-outline-variant">
                    <div class="text-on-surface-variant text-xs mb-1">تبدأ من</div>
                    <div class="text-primary font-bold" style="font-size:30px">
                        {{ number_format($service->price) }}
                        <span class="text-sm font-normal">{{ $service->currency }}</span>
                    </div>
                </div>
                @endif

                {{-- CTA --}}
                <a href="{{ route('project.create') }}"
                   class="block w-full text-center bg-primary text-on-primary py-3.5 rounded-xl font-bold text-sm hover:bg-primary-container transition-colors mb-3">
                    اطلب هذه الخدمة
                </a>
                <a href="{{ route('contact') }}"
                   class="block w-full text-center border-2 border-primary text-primary py-3 rounded-xl font-semibold text-sm hover:bg-primary hover:text-on-primary transition-colors">
                    تواصل معنا
                </a>

                {{-- Features --}}
                <div class="mt-6 space-y-3">
                    <div class="flex items-center gap-3 text-on-surface-variant text-sm">
                        <span class="material-symbols-outlined text-secondary" style="font-size:18px">verified_user</span>
                        ضمان جودة الخدمة
                    </div>
                    <div class="flex items-center gap-3 text-on-surface-variant text-sm">
                        <span class="material-symbols-outlined text-secondary" style="font-size:18px">support_agent</span>
                        دعم فني متواصل
                    </div>
                    <div class="flex items-center gap-3 text-on-surface-variant text-sm">
                        <span class="material-symbols-outlined text-secondary" style="font-size:18px">speed</span>
                        تنفيذ سريع واحترافي
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
