@extends('dashboard.layouts.backend', ['title' => 'سجل الإشعارات'])

@section('contant')
    <div class="main-side">
        <x-alert-component></x-alert-component>

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="main-title">
                <div class="small">الرئيسية</div>/
                <div class="large">سجل الإشعارات المرسلة</div>
            </div>
            @can('create_notifications')
                <a href="{{ route('dashboard.notifications.create') }}" class="main-btn">
                    إشعار جديد <i class="fa-solid fa-plus"></i>
                </a>
            @endcan
        </div>

        <div class="table-responsive">
            <table class="main-table mb-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>الرسالة</th>
                        <th>المرسَل بواسطة</th>
                        <th>الهدف</th>
                        <th>عدد المستلمين</th>
                        <th>التاريخ</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $log->title }}</strong></td>
                            <td>{{ Str::limit($log->body, 60) }}</td>
                            <td>{{ $log->sender?->name ?? '---' }}</td>
                            <td>
                                @if($log->target === 'all')
                                    <span class="badge bg-primary">جميع المستخدمين</span>
                                @else
                                    <span class="badge bg-info text-dark">مستخدمين محددين</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-success">{{ $log->sent_count }}</span>
                            </td>
                            <td>{{ date('Y-m-d h:i a', strtotime($log->created_at)) }}</td>
                            <td>
                                @can('delete_notifications')
                                    <button type="button" class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#deleteLog{{ $log->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="deleteLog{{ $log->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">حذف سجل الإشعار</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('dashboard.notifications.destroy', $log->id) }}" method="POST">
                                                    <div class="modal-body">
                                                        @csrf @method('DELETE')
                                                        هل أنت متأكد من حذف سجل الإشعار "{{ $log->title }}" ؟
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                        <button type="submit" class="btn btn-danger">نعم، احذف</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">لا توجد إشعارات مرسلة بعد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>{{ $logs->links() }}</div>
        </div>
    </div>
@endsection
