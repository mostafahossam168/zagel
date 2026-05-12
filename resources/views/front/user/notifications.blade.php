@extends('front.layouts.app')
@section('title', 'إشعاراتي')

@section('content')

<div class="max-w-[1200px] mx-auto px-4 py-10 min-h-screen">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-headline-lg font-bold text-primary">إشعاراتي</h1>
        @if($notifications->where('read_at', null)->count() > 0)
        <form action="{{ route('user.notifications.mark-read') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center gap-2 text-primary border border-primary/20 hover:bg-primary-fixed px-4 py-2 rounded-xl transition-colors text-sm font-semibold">
                <span class="material-symbols-outlined" style="font-size:18px">done_all</span>
                تحديد الكل كمقروء
            </button>
        </form>
        @endif
    </div>

    {{-- Notifications List --}}
    <div class="space-y-3">
        @forelse($notifications as $notification)
        @php
            $isUnread = is_null($notification->read_at);
            $title = $notification->data['title'] ?? '';
            $body  = $notification->data['body']  ?? '';
        @endphp
        <div class="bg-surface-container-lowest rounded-xl premium-shadow border-r-4 {{ $isUnread ? 'border-primary' : 'border-transparent' }} flex items-start gap-4 p-4 transition-transform hover:scale-[1.005] duration-200 {{ !$isUnread ? 'opacity-80 hover:opacity-100' : '' }}">
            <div class="{{ $isUnread ? 'bg-primary-fixed' : 'bg-surface-variant' }} w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined {{ $isUnread ? 'text-primary' : 'text-on-surface-variant' }}"
                      style="font-size:22px;{{ $isUnread ? 'font-variation-settings:\'FILL\' 1' : '' }}">
                    notifications
                </span>
            </div>
            <div class="flex-grow text-right">
                <div class="flex items-center justify-between mb-1">
                    @if($isUnread)
                    <span class="text-primary text-xs font-bold">جديد</span>
                    @else
                    <span class="text-on-surface-variant text-xs">مقروء</span>
                    @endif
                    <span class="text-outline text-xs">{{ $notification->created_at->diffForHumans() }}</span>
                </div>
                @if($title)
                <p class="font-semibold text-on-surface text-sm mb-0.5">{{ $title }}</p>
                @endif
                @if($body)
                <p class="text-on-surface-variant text-sm leading-relaxed">{{ $body }}</p>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-20">
            <span class="material-symbols-outlined text-outline mb-3" style="font-size:56px">notifications_none</span>
            <p class="text-on-surface-variant text-sm">لا توجد إشعارات حتى الآن</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($notifications->hasPages())
    <div class="flex justify-center items-center gap-2 mt-10">
        @if($notifications->onFirstPage())
        <span class="w-10 h-10 flex items-center justify-center rounded-xl border border-outline-variant text-outline cursor-not-allowed">
            <span class="material-symbols-outlined" style="font-size:18px">chevron_right</span>
        </span>
        @else
        <a href="{{ $notifications->previousPageUrl() }}"
           class="w-10 h-10 flex items-center justify-center rounded-xl border border-outline-variant text-primary hover:bg-primary hover:text-on-primary transition-colors">
            <span class="material-symbols-outlined" style="font-size:18px">chevron_right</span>
        </a>
        @endif

        @foreach($notifications->getUrlRange(1, $notifications->lastPage()) as $page => $url)
        @if($page == $notifications->currentPage())
        <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary text-on-primary font-bold text-sm">{{ $page }}</span>
        @else
        <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-xl border border-outline-variant text-on-surface hover:bg-surface-container transition-colors text-sm">{{ $page }}</a>
        @endif
        @endforeach

        @if($notifications->hasMorePages())
        <a href="{{ $notifications->nextPageUrl() }}"
           class="w-10 h-10 flex items-center justify-center rounded-xl border border-outline-variant text-primary hover:bg-primary hover:text-on-primary transition-colors">
            <span class="material-symbols-outlined" style="font-size:18px">chevron_left</span>
        </a>
        @else
        <span class="w-10 h-10 flex items-center justify-center rounded-xl border border-outline-variant text-outline cursor-not-allowed">
            <span class="material-symbols-outlined" style="font-size:18px">chevron_left</span>
        </span>
        @endif
    </div>
    @endif

</div>

@endsection
