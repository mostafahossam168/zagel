@extends('dashboard.layouts.backend', ['title' => 'خدمات المزودين'])

@section('contant')
    <div class="main-side">
        <x-alert-component></x-alert-component>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="main-title">
                <div class="small">الرئيسية</div>/
                <div class="large">خدمات المزودين</div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="main-table mb-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الخدمة</th>
                        <th>مقدم الخدمة</th>
                        <th>التصنيف</th>
                        <th>السعر</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($listings as $listing)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if ($listing->image)
                                        <img src="{{ display_file($listing->image) }}"
                                            style="width:40px;height:40px;border-radius:6px;object-fit:cover" alt="">
                                    @endif
                                    <strong>{{ Str::limit($listing->title, 40) }}</strong>
                                </div>
                            </td>
                            <td>{{ $listing->user?->name ?? '---' }}</td>
                            <td>{{ $listing->category?->name ?? '---' }}</td>
                            <td>{{ $listing->price ? number_format($listing->price, 0) . ' ' . ($listing->currency ?? 'ر.س') : '---' }}</td>
                            <td><span class="badge {{ $listing->status->color() }}">{{ $listing->status->name() }}</span>
                            </td>
                            <td>{{ date('Y-m-d', strtotime($listing->created_at)) }}</td>
                            <td>
                                <a href="{{ route('dashboard.provider-listings.show', $listing->id) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @can('delete_provider_listings')
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#del{{ $listing->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <div class="modal fade" id="del{{ $listing->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">حذف خدمة</h5><button type="button"
                                                        class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('dashboard.provider-listings.destroy', $listing->id) }}"
                                                    method="POST">
                                                    <div class="modal-body">@csrf @method('DELETE') هل تريد حذف
                                                        "{{ $listing->title }}" ؟</div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">إلغاء</button>
                                                        <button type="submit" class="btn btn-danger">حذف</button>
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
                            <td colspan="8" class="text-center py-4 text-muted">لا توجد خدمات بعد</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>{{ $listings->links() }}</div>
        </div>
    </div>
@endsection
