<div class="modal fade" id="editFaq{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل السؤال الشائع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.faqs.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body row g-3">
                    <div class="col-12">
                        <label class="mb-1">السؤال <span class="text-danger">*</span></label>
                        <input type="text" name="question" class="form-control" value="{{ $item->question }}" required>
                    </div>
                    <div class="col-12">
                        <label class="mb-1">الإجابة <span class="text-danger">*</span></label>
                        <textarea name="answer" class="form-control" rows="5" required>{{ $item->answer }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="mb-1">الحالة <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            @foreach (\App\Enums\FaqStatus::cases() as $status)
                                <option value="{{ $status->value }}" @selected($item->status === $status)>
                                    {{ $status->name() }}
                                </option>
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
