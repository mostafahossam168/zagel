<nav class="main-navbar">
    <div
        class="container-fluid d-flex align-items-lg-center align-items-stretch flex-column flex-xl-row gap-3 justify-content-between">
        <div class="logo">
            <div class="tog-active d-block d-lg-none" data-tog="true" data-active=".app">
                <i class="fas fa-bars"></i>
            </div>
            <img src="{{ asset('dashboard/img/logo.svg') }}" class="img" alt="" />
            <div class="text d-none d-lg-block">
                زاجل
            </div>
        </div>
        <div class="d-flex align-items-center gap-2rem">
            {{-- <div class="list-item d-none d-lg-flex">
                    <div class="main-btn btn-purple">
                        <span class="main-badge">3</span>
                        طلبات تفعيل الاستشارة
                        <img src="{{ asset('dashboard/img/icons/contract-white.svg') }}" alt=""
                            class="icon" />
                    </div>
                    <div class="main-btn btn-orange">
                        <span class="main-badge">3</span>
                        تراخيص وسجلات بانتظار التحقق
                        <img src="{{ asset('dashboard/img/icons/user-white.svg') }}" alt=""
                            class="icon" />
                    </div>
                    <div class="main-btn">
                        الطلبات الحديثة
                        <img src="{{ asset('dashboard/img/icons/bell-white.svg') }}" alt=""
                            class="icon" />
                    </div>
                </div> --}}
            <div class="d-flex align-items-center gap-2rem">
                {{-- <div class="dropdown icon-nav">

                    <div class="main-badge badge-info " id="count-converstion-icon"> 10</div>
                    <a class="dropdown-toggle icon-nav" t href="#">
                        <img src="{{ asset('dashboard/img/icons/msg.svg') }}" alt="" class="icon" />
                    </a>
                </div> --}}
                @php
                    $navLatestNotifications = auth()->user()->unreadNotifications()->latest()->take(5)->get();
                    $navUnreadCount = auth()->user()->unreadNotifications()->count();
                @endphp
                <div class="dropdown icon-nav">
                    <div class="main-badge {{ $navUnreadCount > 0 ? '' : 'd-none' }}" id="bell-badge">
                        {{ $navUnreadCount }}</div>
                    <button class="dropdown-toggle icon-nav" type="button" id="bellDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ asset('dashboard/img/icons/bell.svg') }}" alt="" class="icon" />
                    </button>
                    <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="bellDropdown"
                        style="min-width:300px;max-height:420px;overflow-y:auto">
                        <li class="d-flex justify-content-between align-items-center px-3 py-2">
                            <strong class="small">الإشعارات</strong>
                            @if ($navUnreadCount > 0)
                                <form action="{{ route('dashboard.notifications.mark-all-read') }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-sm btn-link text-decoration-none p-0 small">تحديد الكل
                                        مقروء</button>
                                </form>
                            @endif
                        </li>
                        <li>
                            <hr class="dropdown-divider m-0">
                        </li>
                        @forelse($navLatestNotifications as $notif)
                            <li>
                                <a class="dropdown-item py-2 px-3"
                                    href="{{ $notif->data['url'] ?? route('dashboard.notifications.index') }}">
                                    <div class="small fw-semibold">{{ $notif->data['title'] ?? '' }}</div>
                                    <div class="small text-muted">{{ Str::limit($notif->data['body'] ?? '', 55) }}</div>
                                    <div class="text-muted" style="font-size:11px">
                                        {{ $notif->created_at->diffForHumans() }}</div>
                                </a>
                            </li>
                        @empty
                            <li>
                                <p class="text-center text-muted small py-3 mb-0">لا توجد إشعارات جديدة</p>
                            </li>
                        @endforelse
                        <li>
                            <hr class="dropdown-divider m-0">
                        </li>
                        <li>
                            <a class="dropdown-item text-center small py-2"
                                href="{{ route('dashboard.notifications.inbox') }}">
                                عرض كل الإشعارات
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dropdown info-user ms-auto">
                <button class="dropdown-toggle d-flex align-items-center gap-2 content" type="button"
                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="text">
                        <div class="name">
                            <i class="fas fa-angle-down"></i>
                            {{ auth()->user()->name }}
                        </div>
                        <div class="dic"> {{ auth()->user()->type }}</div>
                    </div>
                    <div class="img">
                        <img src="{{ asset('dashboard/img/icons/user-black.svg') }}" alt="" class="icon" />
                    </div>
                </button>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard.profile.index') }}">
                            الملف الشخصي
                        </a>
                    </li>
                    <li>
                        <form id="logoutForm" action="{{ route('dashboard.logout') }}" method="post">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#"
                            onclick="document.getElementById('logoutForm').submit()">
                            تسجيل الخروج
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
