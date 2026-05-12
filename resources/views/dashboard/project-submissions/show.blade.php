@extends('dashboard.layouts.backend', ['title' => 'تفاصيل المشروع'])

@section('contant')
    <div class="main-side">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="main-title">
                <div class="small">الرئيسية</div>/
                <div class="small">المشاريع المقدمة</div>/
                <div class="large">تفاصيل المشروع</div>
            </div>
            <div class="btn-holder">
                <a class="main-btn btn-main-color fs-13px" href="{{ route('dashboard.project-submissions.index') }}">
                    رجوع <i class="fa-solid fa-arrow-left fs-13px"></i>
                </a>
            </div>
        </div>

        <x-alert-component></x-alert-component>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="row w-100 mx-0 p-4 bg-white rounded">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">{{ $item->project_title }}</h5>
                        <span class="badge {{ $item->status->color() }} fs-6">{{ $item->status->name() }}</span>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded">
                                <small class="text-muted d-block mb-1">الاسم</small>
                                <strong>{{ $item->name }}</strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded">
                                <small class="text-muted d-block mb-1">البريد الإلكتروني</small>
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
                                <small class="text-muted d-block mb-1">تاريخ التقديم</small>
                                <strong>{{ date('Y-m-d h:ia', strtotime($item->created_at)) }}</strong>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <small class="text-muted d-block mb-2">وصف المشروع</small>
                                <p class="mb-0" style="line-height:1.9">{{ $item->project_description }}</p>
                            </div>
                        </div>
                        @if($item->needs)
                            <div class="col-12">
                                <div class="p-3 bg-light rounded">
                                    <small class="text-muted d-block mb-2">الاحتياجات</small>
                                    <p class="mb-0" style="line-height:1.9">{{ $item->needs }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex gap-2">
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

            @can('update_project_submissions')
            <div class="col-lg-4">
                <div class="p-4 bg-white rounded">
                    <h6 class="mb-3">تحديث الحالة</h6>
                    <form action="{{ route('dashboard.project-submissions.update-status', $item->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">الحالة</label>
                            <select name="status" class="form-select">
                                @foreach (\App\Enums\ProjectSubmissionStatus::cases() as $status)
                                    <option value="{{ $status->value }}" @selected($item->status === $status)>
                                        {{ $status->name() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ملاحظات الإدارة</label>
                            <textarea name="admin_notes" class="form-control" rows="4">{{ $item->admin_notes }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">حفظ</button>
                    </form>
                </div>
            </div>
            @endcan
        </div>
    </div>
@endsection
