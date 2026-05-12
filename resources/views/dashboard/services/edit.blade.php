@extends('dashboard.layouts.backend', ['title' => 'تعديل خدمة'])

@section('contant')
    <div class="main-side">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="main-title">
                <div class="small">الرئيسية</div>/
                <div class="small">الخدمات</div>/
                <div class="large">تعديل خدمة</div>
            </div>
            <div class="btn-holder">
                <a class="main-btn btn-main-color fs-13px" href="{{ route('dashboard.services.index') }}">
                    رجوع <i class="fa-solid fa-arrow-left fs-13px"></i>
                </a>
            </div>
        </div>

        <x-alert-component></x-alert-component>

        <form action="{{ route('dashboard.services.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-4">
                <div class="col-12 col-md-6">
                    <label class="special-input">
                        <span>العنوان بالعربي <span class="text-danger">*</span></span>
                        <div class="box-input">
                            <input type="text" name="title_ar" value="{{ old('title_ar', $item->title_ar) }}">
                        </div>
                        @error('title_ar') <span class="text-danger">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-12 col-md-6">
                    <label class="special-input">
                        <span>العنوان بالإنجليزي</span>
                        <div class="box-input">
                            <input type="text" name="title_en" value="{{ old('title_en', $item->title_en) }}">
                        </div>
                        @error('title_en') <span class="text-danger">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-12 col-md-4">
                    <label class="special-label">القسم</label>
                    <select name="category_id" class="form-select select-setting">
                        <option value="">-- بدون قسم --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $item->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 col-md-4">
                    <label class="special-label">الحالة <span class="text-danger">*</span></label>
                    <select name="status" class="form-select select-setting">
                        @foreach (\App\Enums\ServiceStatus::cases() as $status)
                            <option value="{{ $status->value }}" @selected($item->status === $status)>
                                {{ $status->name() }}
                            </option>
                        @endforeach
                    </select>
                    @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 col-md-4">
                    <label class="special-input">
                        <span>الترتيب</span>
                        <div class="box-input">
                            <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0">
                        </div>
                        @error('sort_order') <span class="text-danger">{{ $message }}</span> @enderror
                    </label>
                </div>

                <div class="col-12 col-md-4">
                    <label class="special-label">السعر</label>
                    <div class="input-group">
                        <select name="currency" class="form-select" style="max-width:80px">
                            <option value="ر.س" @selected(old('currency', $item->currency ?? 'ر.س') == 'ر.س')>ر.س</option>
                            <option value="ج.م" @selected(old('currency', $item->currency ?? 'ر.س') == 'ج.م')>ج.م</option>
                            <option value="$"   @selected(old('currency', $item->currency ?? 'ر.س') == '$')>$</option>
                        </select>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $item->price) }}" min="0" step="0.01" placeholder="0">
                    </div>
                    @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 col-md-4 d-flex align-items-center">
                    <div class="form-check form-switch mt-3">
                        <input class="form-check-input" type="checkbox" name="is_purchasable" value="1" id="isPurchasable"
                            @checked(old('is_purchasable', $item->is_purchasable))>
                        <label class="form-check-label" for="isPurchasable">قابل للشراء</label>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>الصورة</span>
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

                <div class="col-12 col-md-6">
                    <label class="special-label">الوصف بالعربي</label>
                    <textarea name="description_ar" class="form-control" rows="4">{{ old('description_ar', $item->description_ar) }}</textarea>
                    @error('description_ar') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label class="special-label">الوصف بالإنجليزي</label>
                    <textarea name="description_en" class="form-control" rows="4">{{ old('description_en', $item->description_en) }}</textarea>
                    @error('description_en') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>

            <button class="d-flex justify-content-center mt-4 mx-auto" type="submit">
                <a class="main-btn">حفظ التعديلات</a>
            </button>
        </form>
    </div>
@endsection
