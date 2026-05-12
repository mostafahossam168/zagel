<div class="modal fade" id="editTestimonial{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل الشهادة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.testimonials.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body row g-3">
                    <div class="col-12 col-md-6">
                        <label class="mb-1">الاسم <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mb-1">الشركة / المؤسسة</label>
                        <input type="text" name="company" class="form-control" value="{{ $item->company }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mb-1">المنصب / الوظيفة</label>
                        <input type="text" name="position" class="form-control" value="{{ $item->position }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mb-1">التقييم <span class="text-danger">*</span></label>
                        <select name="rating" class="form-select" required>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" @selected($item->rating == $i)>{{ $i }} نجوم</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mb-1">الحالة <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            @foreach (\App\Enums\TestimonialStatus::cases() as $status)
                                <option value="{{ $status->value }}" @selected($item->status === $status)>
                                    {{ $status->name() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="mb-1">الصورة</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        @if($item->image)
                            <img style="width:50px;height:50px;object-fit:cover;border-radius:50%;margin-top:6px"
                                src="{{ display_file($item->image) }}" alt="">
                        @endif
                    </div>
                    <div class="col-12">
                        <label class="mb-1">نص الشهادة <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control" rows="4" required>{{ $item->content }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary btn-sm px-3">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>
