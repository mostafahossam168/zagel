@extends('dashboard.layouts.backend', ['title' => 'تفاصيل خدمة مزود'])

@section('contant')
<div class="main-side">
    <x-alert-component></x-alert-component>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="main-title">
            <div class="small">الرئيسية</div>/
            <a href="{{ route('dashboard.provider-listings.index') }}" class="small">خدمات المزودين</a>/
            <div class="large">{{ Str::limit($providerListing->title, 40) }}</div>
        </div>
        <a href="{{ route('dashboard.provider-listings.index') }}" class="main-btn btn-main-color fs-13px">
            رجوع <i class="fa-solid fa-arrow-left fs-13px"></i>
        </a>
    </div>

    <div class="row g-4">
        {{-- Details --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    @if($providerListing->image)
                        <img src="{{ display_file($providerListing->image) }}" style="width:80px;height:80px;border-radius:10px;object-fit:cover" alt="">
                    @endif
                    <div>
                        <h4 class="fw-bold mb-1">{{ $providerListing->title }}</h4>
                        <span class="badge {{ $providerListing->status->color() }}">{{ $providerListing->status->name() }}</span>
                        @if($providerListing->category)
                            <span class="badge bg-secondary ms-1">{{ $providerListing->category->name_ar }}</span>
                        @endif
                    </div>
                </div>
                <p class="text-muted">{{ $providerListing->description }}</p>
                @if($providerListing->price)
                    <div class="mt-2"><strong>السعر:</strong> {{ number_format($providerListing->price, 0) }} {{ $providerListing->currency ?? 'ر.س' }}</div>
                @endif
            </div>

            {{-- Contact Info --}}
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
                <h6 class="fw-bold mb-3">بيانات التواصل</h6>
                <div class="row g-2">
                    <div class="col-md-4"><strong>الجوال:</strong> {{ $providerListing->contact_phone }}</div>
                    @if($providerListing->contact_whatsapp)
                    <div class="col-md-4"><strong>واتساب:</strong> {{ $providerListing->contact_whatsapp }}</div>
                    @endif
                    @if($providerListing->contact_email)
                    <div class="col-md-4"><strong>البريد:</strong> {{ $providerListing->contact_email }}</div>
                    @endif
                </div>
                @if($providerListing->contact_links)
                <div class="mt-2 d-flex gap-2 flex-wrap">
                    @foreach($providerListing->contact_links as $platform => $url)
                        <a href="{{ $url }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                            <i class="fab fa-{{ $platform }} me-1"></i> {{ ucfirst($platform) }}
                        </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        {{-- Actions --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 p-4 mb-3">
                <h6 class="fw-bold mb-3">مقدم الخدمة</h6>
                <div><strong>الاسم:</strong> {{ $providerListing->user?->name }}</div>
                <div><strong>البريد:</strong> {{ $providerListing->user?->email }}</div>
                <div><strong>الجوال:</strong> {{ $providerListing->user?->phone ?? '---' }}</div>
            </div>

            @can('update_provider_listings')
            <div class="card border-0 shadow-sm rounded-3 p-4">
                <h6 class="fw-bold mb-3">تحديث الحالة</h6>
                <form action="{{ route('dashboard.provider-listings.update-status', $providerListing->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">الحالة</label>
                        <select name="status" class="form-select">
                            <option value="approved" @selected($providerListing->status->value === 'approved')>اعتماد ✓</option>
                            <option value="rejected" @selected($providerListing->status->value === 'rejected')>رفض ✗</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">ملاحظات (تُرسل للمزود)</label>
                        <textarea name="admin_notes" rows="3" class="form-control" placeholder="سبب الرفض أو ملاحظات الاعتماد...">{{ $providerListing->admin_notes }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">حفظ الحالة</button>
                </form>
            </div>
            @endcan
        </div>
    </div>
</div>
@endsection
