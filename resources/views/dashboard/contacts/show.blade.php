@extends('dashboard.layouts.backend', ['title' => 'عرض الرسالة'])

@section('contant')
    <div class="main-side">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="main-title">
                <div class="small">الرئيسية</div>/
                <div class="small">الرسائل</div>/
                <div class="large">عرض الرسالة</div>
            </div>
            <div class="btn-holder">
                <a class="main-btn btn-main-color fs-13px" href="{{ route('dashboard.contacts.index') }}">
                    رجوع <i class="fa-solid fa-arrow-left fs-13px"></i>
                </a>
            </div>
        </div>

        <div class="row w-100 mx-0 p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">تفاصيل الرسالة</h5>
                <span class="badge {{ $item->status->color() }} fs-6">{{ $item->status->name() }}</span>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded">
                        <small class="text-muted d-block mb-1">الاسم</small>
                        <strong>{{ $item->name }}</strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded">
                        <small class="text-muted d-block mb-1">البريد الالكتروني</small>
                        <strong>{{ $item->email }}</strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded">
                        <small class="text-muted d-block mb-1">الهاتف</small>
                        <strong>{{ $item->phone ?? 'غير متوفر' }}</strong>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 bg-light rounded">
                        <small class="text-muted d-block mb-1">تاريخ الإرسال</small>
                        <strong>{{ date('Y-m-d h:ia', strtotime($item->created_at)) }}</strong>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3 bg-light rounded">
                        <small class="text-muted d-block mb-2">الرسالة</small>
                        <p class="mb-0" style="line-height:1.9">{{ $item->message }}</p>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <a href="mailto:{{ $item->email }}" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-envelope me-1"></i> رد بالبريد
                </a>
                @if($item->phone)
                    <a href="tel:{{ $item->phone }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-phone me-1"></i> اتصال
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
