@extends('dashboard.layouts.backend', ['title' => 'المشرفين'])

@section('contant')
    <div class="main-side">
        <div class="main-title">
            <div class="small">الرئيسية</div>
            <div class="large">المشرفين</div>
        </div>

        <div class="bar-obtions d-flex align-items-end justify-content-between flex-wrap gap-3 mb-4">
            <div class="row flex-fill g-3">
                <div class="d-flex align-items-center gap-2 mt-2 flex-wrap">
                    @can('create_admins')
                        <a href="{{ route('dashboard.admins.create') }}" class="main-btn">
                            <i class="fas fa-plus"></i> اضافة
                        </a>
                    @endcan
                    <a href="#" class="main-btn btn-main-color filter-btn" data-status="">
                        الكل : <span id="count-all">{{ $count_all }}</span>
                    </a>
                    <a href="#" class="main-btn btn-sm bg-success filter-btn" data-status="yes">
                        مفعلين : <span id="count-active">{{ $count_active }}</span>
                    </a>
                    <a href="#" class="main-btn btn-sm bg-danger filter-btn" data-status="no">
                        غير مفعلين : <span id="count-inactive">{{ $count_inactive }}</span>
                    </a>
                    <a href="{{ route('dashboard.admins.export', ['status' => request('status'), 'search' => request('search')]) }}"
                        class="main-btn btn-sm bg-warning" id="export-btn">
                        <i class="fa-solid fa-file-excel fs-5"></i> تصدير Excel
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
                        <th>الصوره</th>
                        <th>الاسم</th>
                        <th>البريد الالكتروني</th>
                        <th>الهاتف</th>
                        <th>الحالة</th>
                        <th>الصلاحيه</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody id="admins-tbody">
                    @include('dashboard.admins._table', ['items' => $items])
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
    let currentSearch = '{{ request('search', '') }}';

    // ── Search (debounced) ──────────────────────────────────────
    $('#search-input').on('input', function () {
        currentSearch = $(this).val();
        updateExportLink();
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => fetchTable(), 400);
    });

    // ── Filter buttons ──────────────────────────────────────────
    $(document).on('click', '.filter-btn', function (e) {
        e.preventDefault();
        currentStatus = $(this).data('status');
        updateExportLink();
        fetchTable();
    });

    // ── Pagination (AJAX) ───────────────────────────────────────
    $(document).on('click', '#pagination-wrapper a', function (e) {
        e.preventDefault();
        const url = new URL($(this).attr('href'), window.location.origin);
        fetchTable(url.searchParams.get('page'));
    });

    // ── Status toggle ───────────────────────────────────────────
    $(document).on('change', '.status-toggle', function () {
        const toggle = $(this);
        const url    = toggle.data('url');

        $.ajax({
            url: url,
            method: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function (res) {
                const badge = toggle.closest('td').find('.status-badge');
                badge.removeClass('bg-success bg-danger').addClass(res.color).text(res.label);
                $('#count-all').text(res.count_all);
                $('#count-active').text(res.count_active);
                $('#count-inactive').text(res.count_inactive);
            },
            error: function () {
                toggle.prop('checked', !toggle.prop('checked'));
            }
        });
    });

    // ── Core fetch ──────────────────────────────────────────────
    function fetchTable(page) {
        $('#admins-tbody').html(
            '<tr><td colspan="8" class="text-center py-4">' +
            '<div class="spinner-border spinner-border-sm text-primary" role="status"></div>' +
            '</td></tr>'
        );
        $.ajax({
            url: '{{ route('dashboard.admins.index') }}',
            data: { search: currentSearch, status: currentStatus, page: page || 1 },
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (res) {
                $('#admins-tbody').html(res.html);
                $('#pagination-wrapper').html(res.pagination);
                $('#count-all').text(res.count_all);
                $('#count-active').text(res.count_active);
                $('#count-inactive').text(res.count_inactive);
            }
        });
    }

    function updateExportLink() {
        const params = new URLSearchParams({ status: currentStatus, search: currentSearch });
        $('#export-btn').attr('href', '{{ route('dashboard.admins.export') }}?' + params.toString());
    }
});
</script>
@endpush
