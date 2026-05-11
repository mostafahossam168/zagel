@extends('dashboard.layouts.backend', ['title' => 'اضافة شريك'])

@section('contant')
    <div class="main-side">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="main-title">
                <div class="small">الرئيسية</div>/
                <div class="small">شركاؤنا</div>/
                <div class="large">اضافة شريك جديد</div>
            </div>
            <div class="btn-holder">
                <a class="main-btn btn-main-color fs-13px" href="{{ route('dashboard.partners.index') }}">
                    رجوع <i class="fa-solid fa-arrow-left fs-13px"></i>
                </a>
            </div>
        </div>

        <x-alert-component></x-alert-component>

        <form action="{{ route('dashboard.partners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>الاسم <span class="text-danger">*</span></span>
                        <div class="box-input">
                            <input type="text" name="name" value="{{ old('name') }}">
                        </div>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-label">حالة النشر <span class="text-danger">*</span></label>
                    <select name="status" class="form-select select-setting">
                        @foreach (\App\Enums\PartnerStatus::cases() as $status)
                            <option value="{{ $status->value }}" @selected(old('status') == $status->value)>
                                {{ $status->name() }}
                            </option>
                        @endforeach
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>الصورة</span>
                            <div class="box-input pe-0 border-0">
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>
                        </label>
                    </div>
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 col-md-8">
                    <label class="special-label">الوصف</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <button class="d-flex justify-content-center mt-4 mx-auto" type="submit">
                <a class="main-btn">حفظ</a>
            </button>
        </form>
    </div>
@endsection
