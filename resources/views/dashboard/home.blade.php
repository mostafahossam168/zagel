@extends('dashboard.layouts.backend', ['title' => 'الرئيسية'])

@section('contant')
    <div class="main-side">
        <div class="main-title mb-4">
            <div class="small">الرئيسية</div>
            <div class="large">لوحة التحكم</div>
        </div>

        <div class="row g-3">

            @can('read_admins')
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="box-statistic blue">
                        <div class="right-side">
                            <h6 class="name">المشرفين</h6>
                            <h3 class="amount">
                                <span class="num-stat" data-goal="{{ \App\Models\User::admins()->count() }}">0</span>
                            </h3>
                            <a href="{{ route('dashboard.admins.index') }}" class="link-view">عرض جميع المشرفين</a>
                        </div>
                        <div class="left-side">
                            <div class="icon-holder blue">
                                <i class="fa-solid fa-users-gear"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('read_users')
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="box-statistic green">
                        <div class="right-side">
                            <h6 class="name">المستخدمون</h6>
                            <h3 class="amount">
                                <span class="num-stat" data-goal="{{ \App\Models\User::users()->count() }}">0</span>
                            </h3>
                            <a href="{{ route('dashboard.users.index') }}" class="link-view">عرض جميع المستخدمين</a>
                        </div>
                        <div class="left-side">
                            <div class="icon-holder green">
                                <i class="fa-solid fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('read_categories')
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="box-statistic purple">
                        <div class="right-side">
                            <h6 class="name">الأقسام</h6>
                            <h3 class="amount">
                                <span class="num-stat" data-goal="{{ \App\Models\Category::count() }}">0</span>
                            </h3>
                            <a href="{{ route('dashboard.categories.index') }}" class="link-view">عرض جميع الأقسام</a>
                        </div>
                        <div class="left-side">
                            <div class="icon-holder yellow">
                                <i class="fa-solid fa-sitemap"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('read_partners')
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="box-statistic yellow">
                        <div class="right-side">
                            <h6 class="name">شركاؤنا</h6>
                            <h3 class="amount">
                                <span class="num-stat" data-goal="{{ \App\Models\Partner::count() }}">0</span>
                            </h3>
                            <a href="{{ route('dashboard.partners.index') }}" class="link-view">عرض جميع الشركاء</a>
                        </div>
                        <div class="left-side">
                            <div class="icon-holder">
                                <i class="fa-solid fa-handshake"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('read_contacts')
                @php
                    $unread = \App\Models\Contact::where('status', \App\Enums\ContactStatus::UNREAD)->count();
                @endphp
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="box-statistic">
                        <div class="right-side">
                            <h6 class="name">
                                الرسائل
                                @if($unread > 0)
                                    <span class="badge bg-danger ms-1">{{ $unread }} جديدة</span>
                                @endif
                            </h6>
                            <h3 class="amount">
                                <span class="num-stat" data-goal="{{ \App\Models\Contact::count() }}">0</span>
                            </h3>
                            <a href="{{ route('dashboard.contacts.index') }}" class="link-view">عرض جميع الرسائل</a>
                        </div>
                        <div class="left-side">
                            <div class="icon-holder blue">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

            @can('read_roles')
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="box-statistic">
                        <div class="right-side">
                            <h6 class="name">الصلاحيات</h6>
                            <h3 class="amount">
                                <span class="num-stat" data-goal="{{ \Spatie\Permission\Models\Role::count() }}">0</span>
                            </h3>
                            <a href="{{ route('dashboard.roles.index') }}" class="link-view">عرض جميع الصلاحيات</a>
                        </div>
                        <div class="left-side">
                            <div class="icon-holder green">
                                <i class="fa-solid fa-user-shield"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan

        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.num-stat').forEach(function (el) {
        const goal = parseInt(el.dataset.goal) || 0;
        const duration = 1200;
        const start = performance.now();

        function update(now) {
            const progress = Math.min((now - start) / duration, 1);
            el.textContent = Math.floor(progress * goal);
            if (progress < 1) requestAnimationFrame(update);
        }

        requestAnimationFrame(update);
    });
});
</script>
@endpush
