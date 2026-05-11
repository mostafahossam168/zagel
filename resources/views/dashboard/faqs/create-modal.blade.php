<div class="modal fade" id="create" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة سؤال شائع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.faqs.store') }}" method="POST">
                @csrf
                <div class="modal-body row g-3">
                    <div class="col-12">
                        <label class="mb-1">السؤال <span class="text-danger">*</span></label>
                        <input type="text" name="question" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="mb-1">الإجابة <span class="text-danger">*</span></label>
                        <textarea name="answer" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="col-12">
                        <label class="mb-1">الحالة <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            @foreach (\App\Enums\FaqStatus::cases() as $status)
                                <option value="{{ $status->value }}">{{ $status->name() }}</option>
                            @endforeach
                        </select>
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
