<div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">حذف خدمة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('dashboard.services.destroy', $item->id) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    هل أنت متأكد من حذف الخدمة "{{ $item->title_ar }}" ؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">نعم، احذف</button>
                </div>
            </form>
        </div>
    </div>
</div>
