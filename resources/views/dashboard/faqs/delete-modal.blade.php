<div class="modal fade" id="deleteFaq{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">حذف السؤال</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.faqs.destroy', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    هل أنت متأكد من حذف السؤال: <strong>{{ Str::limit($item->question, 60) }}</strong> ؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger btn-sm px-3">نعم، احذف</button>
                </div>
            </form>
        </div>
    </div>
</div>
