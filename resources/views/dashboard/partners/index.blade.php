@extends('dashboard.layouts.backend', ['title' => 'شركاؤنا'])

@section('contant')
    <div class="main-side">
        <div class="main-title">
            <div class="small">الرئيسية</div>
            <div class="large">شركاؤنا</div>
        </div>

        <div class="bar-obtions d-flex align-items-end justify-content-between flex-wrap gap-3 mb-4">
            <div class="row flex-fill g-3">
                <div class="d-flex align-items-center gap-2 mt-2 flex-wrap">
                    @can('create_partners')
                        <a href="{{ route('dashboard.partners.create') }}" class="main-btn">
                            <i class="fas fa-plus"></i> اضافة
                        </a>
                    @endcan
                    <a href="#" class="main-btn btn-main-color filter-btn" data-status="">
                        الكل : <span id="count-all">{{ $count_all }}</span>
                    </a>
                    <a href="#" class="main-btn btn-sm bg-success filter-btn" data-status="published">
                        منشور : <span id="count-published">{{ $count_published }}</span>
                    </a>
                    <a href="#" class="main-btn btn-sm bg-secondary filter-btn" data-status="draft">
                        مسودة : <span id="count-draft">{{ $count_draft }}</span>
                    </a>
                </div>
            </div>
            <div class="box-search">
                <img src="{{ asset('dashboard/img/icons/search.png') }}" alt="icon" />
                <input type="search" id="search-input" value="{{ request('search') }}"
                    placeholder="@lang('Search')" autocomplete="off" />
            </div>
        </div>

        <x-alert-component></x-alert-component>

        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>الوصف</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody id="partners-tbody">
                    @include('dashboard.partners._table', ['items' => $items])
                </tbody>
            </table>
        </div>
        <br>
        <div id="pagination-wrapper">
            {{ $items->links() }}
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    let searchTimeout;
    let currentStatus = '{{ request('status', '') }}';

    $('#search-input').on('input', function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(fetchTable, 400);
    });

    $(document).on('click', '.filter-btn', function (e) {
        e.preventDefault();
        currentStatus = $(this).data('status');
        fetchTable();
    });

    $(document).on('click', '#pagination-wrapper a', function (e) {
        e.preventDefault();
        const url = new URL($(this).attr('href'), window.location.origin);
        fetchTable(url.searchParams.get('page'));
    });

    function fetchTable(page) {
        $('#partners-tbody').html(
            '<tr><td colspan="6" class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary" role="status"></div></td></tr>'
        );
        $.ajax({
            url: '{{ route('dashboard.partners.index') }}',
            data: { search: $('#search-input').val(), status: currentStatus, page: page || 1 },
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (res) {
                $('#partners-tbody').html(res.html);
                $('#pagination-wrapper').html(res.pagination);
                $('#count-all').text(res.count_all);
                $('#count-published').text(res.count_published);
                $('#count-draft').text(res.count_draft);
            }
        });
    }
});
</script>
@endpush
