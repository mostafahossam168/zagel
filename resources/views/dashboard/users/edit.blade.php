@extends('dashboard.layouts.backend', ['title' => 'تعديل مستخدم'])

@section('contant')
    <div class="main-side">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="main-title">
                <div class="small">الرئيسية</div>/
                <div class="small">المستخدمون</div>/
                <div class="large">تعديل مستخدم</div>
            </div>
            <div class="btn-holder">
                <a class="main-btn btn-main-color fs-13px" href="{{ route('dashboard.users.index') }}">
                    رجوع <i class="fa-solid fa-arrow-left fs-13px"></i>
                </a>
            </div>
        </div>

        <x-alert-component></x-alert-component>

        <form action="{{ route('dashboard.users.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>الاسم</span>
                        <div class="box-input">
                            <input type="text" name="name" value="{{ $item->name }}">
                        </div>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>البريد الالكتروني</span>
                        <div class="box-input">
                            <input type="email" name="email" value="{{ $item->email }}">
                        </div>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>الهاتف</span>
                        <div class="box-input">
                            <input type="text" name="phone" value="{{ $item->phone }}">
                        </div>
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-label">الحالة</label>
                    <select name="status" class="form-select select-setting">
                        @foreach (\App\Enums\StatusUser::cases() as $status)
                            <option value="{{ $status->value }}" @selected($item->status === $status)>
                                {{ $status->name() }}
                            </option>
                        @endforeach
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>صورة</span>
                            <div class="box-input pe-0 border-0">
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>
                        </label>
                    </div>
                    @if($item->image)
                        <img style="width:70px;height:70px;object-fit:cover;border-radius:6px;margin-top:6px"
                            src="{{ display_file($item->image) }}" alt="">
                    @endif
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>كلمة المرور الجديدة</span>
                        <div class="box-input">
                            <input type="password" name="password" placeholder="اتركه فارغ إن لم ترد تغييره">
                        </div>
                    </label>
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>تأكيد كلمة المرور</span>
                        <div class="box-input">
                            <input type="password" name="password_confirmation">
                        </div>
                    </label>
                </div>
            </div>

            <button class="d-flex justify-content-center mt-4 mx-auto" type="submit">
                <a class="main-btn">حفظ</a>
            </button>
        </form>
    </div>
@endsection
