<div class="modal fade" id="create" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة قسم جديد</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body row g-3">
                    @csrf
                    <div class="col-12">
                        <label class="mb-1">الاسم <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="mb-1">الوصف <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-12">
                        <label class="mb-1">الصورة</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-12">
                        <label class="mb-1">الحالة <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            @foreach (\App\Enums\CategoryStatus::cases() as $status)
                                <option value="{{ $status->value }}">{{ $status->name() }}</option>
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
