@extends('dashboard.layouts.backend', ['title' => 'الملف الشخصي'])

@section('contant')
    <div class="main-side">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="main-title">
                <div class="small">الرئيسية</div>/
                <div class="large">الملف الشخصي</div>
            </div>
        </div>

        <x-alert-component></x-alert-component>

        <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>الاسم</span>
                        <div class="box-input">
                            <input type="text" name="name" value="{{ old('name', $item->name) }}">
                        </div>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>البريد الالكتروني</span>
                        <div class="box-input">
                            <input type="email" name="email" value="{{ old('email', $item->email) }}">
                        </div>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>الهاتف</span>
                        <div class="box-input">
                            <input type="text" name="phone" value="{{ old('phone', $item->phone) }}">
                        </div>
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>الصورة الشخصية</span>
                            <div class="box-input pe-0 border-0">
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>
                        </label>
                    </div>
                    @if($item->image)
                        <img style="width:70px;height:70px;object-fit:cover;border-radius:50%;margin-top:6px"
                            src="{{ display_file($item->image) }}" alt="">
                    @endif
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-12">
                    <hr class="my-1">
                    <p class="text-muted small mb-3">اتركهما فارغين إن لم ترد تغيير كلمة المرور</p>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>كلمة المرور الجديدة</span>
                        <div class="box-input">
                            <input type="password" name="password" placeholder="••••••••">
                        </div>
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>تأكيد كلمة المرور</span>
                        <div class="box-input">
                            <input type="password" name="password_confirmation" placeholder="••••••••">
                        </div>
                    </label>
                </div>
            </div>

            <button class="d-flex justify-content-center mt-4 mx-auto" type="submit">
                <a class="main-btn">حفظ التعديلات</a>
            </button>
        </form>
    </div>
@endsection
