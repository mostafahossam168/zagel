@extends('dashboard.layouts.backend', ['title' => 'الإشعارات الواردة'])

@section('contant')
    <div class="main-side">
        <x-alert-component></x-alert-component>

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="main-title">
                <div class="small">الرئيسية</div>/
                <div class="large">الإشعارات الواردة</div>
            </div>
            @can('create_notifications')
                <a href="{{ route('dashboard.notifications.create') }}" class="main-btn">
                    إشعار جديد <i class="fa-solid fa-plus"></i>
                </a>
            @endcan
        </div>

        @if($notifications->count())
            <div class="d-flex flex-column gap-2 mb-4">
                @foreach($notifications as $notif)
                    @php
                        $type  = $notif->data['type']  ?? 'broadcast';
                        $title = $notif->data['title'] ?? '';
                        $body  = $notif->data['body']  ?? '';
                        $url   = $notif->data['url']   ?? null;
                        $typeLabels = [
                            'project_submission' => ['label' => 'مشروع جديد',    'class' => 'bg-warning text-dark'],
                            'provider_listing'   => ['label' => 'خدمة جديدة',   'class' => 'bg-info text-dark'],
                            'contact'            => ['label' => 'رسالة تواصل',  'class' => 'bg-primary'],
                            'broadcast'          => ['label' => 'إشعار عام',    'class' => 'bg-secondary'],
                            'listing_status'     => ['label' => 'حالة خدمة',   'class' => 'bg-success'],
                        ];
                        $badge = $typeLabels[$type] ?? ['label' => $type, 'class' => 'bg-secondary'];
                    @endphp
                    <div class="card border-0 shadow-sm {{ is_null($notif->read_at) ? 'border-start border-primary border-3' : '' }}"
                        style="{{ is_null($notif->read_at) ? 'border-right:4px solid var(--main-color) !important;background:#f8f9ff' : 'background:#fff' }}">
                        <div class="card-body py-3 px-4">
                            <div class="d-flex align-items-start justify-content-between gap-3">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="badge {{ $badge['class'] }} rounded-pill" style="font-size:.75rem">{{ $badge['label'] }}</span>
                                        @if(is_null($notif->read_at))
                                            <span class="badge bg-danger rounded-pill" style="font-size:.7rem">جديد</span>
                                        @endif
                                    </div>
                                    <div class="fw-bold mb-1">{{ $title }}</div>
                                    <div class="text-muted small">{{ $body }}</div>
                                </div>
                                <div class="text-end text-nowrap">
                                    <div class="text-muted small mb-2">{{ $notif->created_at->diffForHumans() }}</div>
                                    @if($url)
                                        <a href="{{ $url }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i> عرض
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div>{{ $notifications->links() }}</div>
        @else
            <div class="text-center py-5 text-muted">
                <i class="fas fa-bell-slash" style="font-size:3rem;display:block;margin-bottom:1rem;opacity:.4"></i>
                لا توجد إشعارات بعد
            </div>
        @endif
    </div>
@endsection
