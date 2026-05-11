<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل قسم</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.categories.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label class="mb-1">الاسم <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ $item->name }}" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="mb-1">الوصف <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="3" required>{{ $item->description }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="mb-1">الصورة</label>
                        @if($item->image)
                            <div class="mb-2">
                                <img src="{{ display_file($item->image) }}" style="height:50px;border-radius:4px" alt="">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-12">
                        <label class="mb-1">الحالة <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            @foreach (\App\Enums\CategoryStatus::cases() as $status)
                                <option value="{{ $status->value }}"
                                    @selected($item->status === $status)>
                                    {{ $status->name() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>
