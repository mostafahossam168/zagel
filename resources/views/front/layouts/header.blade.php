@php
    $isAuthUser = auth()->check() && auth()->user()->type->value === 'user';
    $userUnread = $isAuthUser ? auth()->user()->unreadNotifications()->count() : 0;
    $userNotifs = $isAuthUser ? auth()->user()->unreadNotifications()->latest()->take(6)->get() : collect();
@endphp

{{-- RTL Fix: dir="rtl" on <html> makes flex go RIGHT→LEFT naturally. No flex-row-reverse needed. --}}
<header class="bg-surface-container-lowest sticky top-0 z-50" style="box-shadow:0 2px 12px rgba(0,0,0,.07)">
    <div class="max-w-[1200px] mx-auto px-4 h-20 flex items-center justify-between gap-4">

        {{-- Logo (rightmost in RTL) --}}
        <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2">
            @if (setting('logo'))
                <img src="{{ display_file(setting('logo')) }}" alt="{{ setting('website_name', 'زاجل') }}"
                    class="h-10 w-auto">
            @else
                <span class="text-headline-md font-bold text-primary" style="font-size:26px;font-weight:800">
                    {{ setting('website_name', 'زاجل') }}
                </span>
            @endif
        </a>

        {{-- Desktop Nav --}}
        <nav class="hidden lg:flex items-center gap-6">
            <a href="{{ route('home') }}"
                class="text-label-lg font-medium transition-colors duration-200 {{ request()->routeIs('home') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">
                الرئيسية
            </a>
            <a href="{{ route('services.index') }}"
                class="text-label-lg font-medium transition-colors duration-200 {{ request()->routeIs('services.*') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">
                الخدمات
            </a>
            <a href="{{ route('providers.index') }}"
                class="text-label-lg font-medium transition-colors duration-200 {{ request()->routeIs('providers.index') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">
                مزودو الخدمة
            </a>
            <a href="{{ route('project.create') }}"
                class="text-label-lg font-medium transition-colors duration-200 {{ request()->routeIs('project.create') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">
                اطلب مشروعك
            </a>
            <a href="{{ route('about') }}"
                class="text-label-lg font-medium transition-colors duration-200 {{ request()->routeIs('about') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">
                عن زاجل
            </a>
            <a href="{{ route('contact') }}"
                class="text-label-lg font-medium transition-colors duration-200 {{ request()->routeIs('contact') ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}">
                تواصل معنا
            </a>
        </nav>

        {{-- Actions (leftmost in RTL) --}}
        <div class="flex items-center gap-3 flex-shrink-0">

            @if ($isAuthUser)
                {{-- Notification Bell --}}
                <div class="relative" id="notif-wrapper">
                    <button id="notif-btn"
                        class="relative w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container transition-colors text-on-surface-variant"
                        onclick="document.getElementById('notif-dropdown').classList.toggle('hidden')">
                        <span class="material-symbols-outlined">notifications</span>
                        @if ($userUnread > 0)
                            <span id="user-bell-badge"
                                class="absolute top-0.5 left-0.5 w-5 h-5 flex items-center justify-center bg-error text-on-error text-[10px] font-bold rounded-full">
                                {{ $userUnread > 9 ? '9+' : $userUnread }}
                            </span>
                        @else
                            <span id="user-bell-badge"
                                class="absolute top-0.5 left-0.5 w-5 h-5 flex items-center justify-center bg-error text-on-error text-[10px] font-bold rounded-full hidden">0</span>
                        @endif
                    </button>
                    <div id="notif-dropdown"
                        class="hidden absolute left-0 top-12 w-80 bg-surface-container-lowest rounded-xl premium-shadow border border-outline-variant z-50 overflow-hidden">
                        <div class="flex items-center justify-between px-4 py-3 border-b border-outline-variant">
                            <span class="font-semibold text-on-surface text-sm">الإشعارات</span>
                            @if ($userUnread > 0)
                                <form action="{{ route('user.notifications.mark-read') }}" method="POST"
                                    class="inline">
                                    @csrf
                                    <button type="submit" class="text-primary text-xs hover:underline">تحديد
                                        كمقروء</button>
                                </form>
                            @endif
                        </div>
                        <div id="user-notif-list" class="max-h-72 overflow-y-auto">
                            @forelse($userNotifs as $notif)
                                <div
                                    class="p-3 border-b border-outline-variant text-right hover:bg-surface-container-low">
                                    <div class="font-semibold text-on-surface text-sm">
                                        {{ $notif->data['title'] ?? '' }}</div>
                                    <div class="text-on-surface-variant text-xs mt-0.5">
                                        {{ $notif->data['body'] ?? '' }}</div>
                                    <div class="text-outline text-xs mt-1">{{ $notif->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @empty
                                <div class="notif-empty p-4 text-center text-on-surface-variant text-sm">لا توجد إشعارات
                                    جديدة</div>
                            @endforelse
                        </div>
                        <a href="{{ route('user.notifications.index') }}"
                            class="block text-center text-primary text-sm font-medium py-2 hover:bg-surface-container-low border-t border-outline-variant">
                            عرض الكل
                        </a>
                    </div>
                </div>

                {{-- User dropdown --}}
                <div class="relative" id="user-wrapper">
                    <button id="user-btn"
                        class="flex items-center gap-2 px-2 py-1.5 rounded-lg hover:bg-surface-container transition-colors"
                        onclick="document.getElementById('user-dropdown').classList.toggle('hidden')">
                        @if (auth()->user()->image)
                            <img src="{{ display_file(auth()->user()->image) }}"
                                class="w-8 h-8 rounded-full object-cover ring-2 ring-primary-fixed" alt="">
                        @else
                            <span class="material-symbols-outlined text-primary">account_circle</span>
                        @endif
                        <span
                            class="hidden md:inline text-label-lg text-on-surface font-medium">{{ Str::limit(auth()->user()->name, 14) }}</span>
                        <span class="material-symbols-outlined text-on-surface-variant"
                            style="font-size:18px">expand_more</span>
                    </button>
                    <div id="user-dropdown"
                        class="hidden absolute left-0 top-12 w-52 bg-surface-container-lowest rounded-xl premium-shadow border border-outline-variant z-50 py-1 overflow-hidden">
                        <a href="{{ route('user.profile') }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-on-surface hover:bg-surface-container-low text-sm">
                            <span class="material-symbols-outlined text-primary" style="font-size:18px">person</span>
                            ملفي الشخصي
                        </a>
                        <a href="{{ route('user.listings.index') }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-on-surface hover:bg-surface-container-low text-sm">
                            <span class="material-symbols-outlined text-secondary" style="font-size:18px">work</span>
                            خدماتي
                        </a>
                        <a href="{{ route('user.notifications.index') }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-on-surface hover:bg-surface-container-low text-sm">
                            <span class="material-symbols-outlined text-[#f99132]"
                                style="font-size:18px">notifications</span>
                            إشعاراتي
                            @if ($userUnread > 0)
                                <span
                                    class="mr-auto bg-error text-on-error text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ $userUnread }}</span>
                            @endif
                        </a>
                        <a href="{{ route('user.listings.create') }}"
                            class="flex items-center gap-3 px-4 py-2.5 text-on-surface hover:bg-surface-container-low text-sm">
                            <span class="material-symbols-outlined text-outline"
                                style="font-size:18px">add_circle</span>
                            أضف خدمة
                        </a>
                        <hr class="border-outline-variant my-1">
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-2.5 text-error hover:bg-error-container text-sm">
                                <span class="material-symbols-outlined" style="font-size:18px">logout</span>
                                تسجيل الخروج
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('project.create') }}"
                    class="hidden md:flex items-center gap-1.5 bg-[#0fc859] text-white px-4 py-2 rounded-lg text-label-lg font-semibold hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined" style="font-size:16px">add</span>
                    اطلب مشروع
                </a>
                <a href="{{ route('user.login') }}"
                    class="flex items-center gap-1.5 bg-primary text-on-primary px-4 py-2 rounded-lg text-label-lg font-semibold hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined" style="font-size:16px">login</span>
                    دخول
                </a>
                <a href="{{ route('user.register') }}"
                    class="hidden md:flex items-center gap-1.5 border border-primary text-primary px-4 py-2 rounded-lg text-label-lg font-semibold hover:bg-primary hover:text-on-primary transition-colors">
                    تسجيل
                </a>
            @endif

            {{-- Mobile hamburger --}}
            <button id="mobile-menu-btn"
                class="lg:hidden flex items-center justify-center w-10 h-10 rounded-lg hover:bg-surface-container transition-colors text-primary">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden lg:hidden bg-surface-container-lowest border-t border-outline-variant">
        <nav class="max-w-[1200px] mx-auto px-4 py-3 flex flex-col gap-1">
            <a href="{{ route('home') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant hover:bg-surface-container' }}">الرئيسية</a>
            <a href="{{ route('services.index') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('services.*') ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant hover:bg-surface-container' }}">الخدمات</a>
            <a href="{{ route('providers.index') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('providers.index') ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant hover:bg-surface-container' }}">مزودو
                الخدمة</a>
            <a href="{{ route('project.create') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('project.create') ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant hover:bg-surface-container' }}">أضف
                مشروعك</a>
            <a href="{{ route('about') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('about') ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant hover:bg-surface-container' }}">عن
                زاجل</a>
            <a href="{{ route('contact') }}"
                class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('contact') ? 'bg-primary-fixed text-primary' : 'text-on-surface-variant hover:bg-surface-container' }}">تواصل
                معنا</a>
            @if ($isAuthUser)
                <div class="pt-2 border-t border-outline-variant mt-1 space-y-1">
                    <a href="{{ route('user.listings.index') }}"
                        class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-on-surface-variant hover:bg-surface-container">خدماتي</a>
                    <a href="{{ route('user.notifications.index') }}"
                        class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-on-surface-variant hover:bg-surface-container">الإشعارات</a>
                </div>
            @else
                <div class="flex gap-2 pt-2 border-t border-outline-variant mt-1">
                    <a href="{{ route('project.create') }}"
                        class="flex-1 text-center bg-[#0fc859] text-white py-2 rounded-lg text-sm font-semibold">اطلب
                        مشروع</a>
                    <a href="{{ route('user.login') }}"
                        class="flex-1 text-center bg-primary text-on-primary py-2 rounded-lg text-sm font-semibold">دخول</a>
                    <a href="{{ route('user.register') }}"
                        class="flex-1 text-center border border-primary text-primary py-2 rounded-lg text-sm font-semibold">تسجيل</a>
                </div>
            @endif
        </nav>
    </div>
</header>

<script>
    document.addEventListener('click', function(e) {
        ['notif-wrapper', 'user-wrapper'].forEach(id => {
            const el = document.getElementById(id);
            if (el && !el.contains(e.target)) {
                const drop = el.querySelector('[id$="-dropdown"]');
                if (drop) drop.classList.add('hidden');
            }
        });
    });
</script>
