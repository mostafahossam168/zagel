@extends('dashboard.layouts.backend', ['title' => 'المشاريع المقدمة'])

@section('contant')
    <div class="main-side">
        <div class="main-title">
            <div class="small">الرئيسية</div>
            <div class="large">المشاريع المقدمة</div>
        </div>

        <div class="bar-obtions d-flex align-items-end justify-content-between flex-wrap gap-3 mb-4">
            <div class="row flex-fill g-3">
                <div class="d-flex align-items-center gap-2 mt-2 flex-wrap">
                    <a href="#" class="main-btn btn-main-color filter-btn" data-status="">
                        الكل : <span id="count-all">{{ $count_all }}</span>
                    </a>
                    <a href="#" class="main-btn btn-sm bg-info text-dark filter-btn" data-status="new">
                        جديد : <span id="count-new">{{ $count_new }}</span>
                    </a>
                    <a href="#" class="main-btn btn-sm bg-warning text-dark filter-btn" data-status="reviewed">
                        تمت المراجعة : <span id="count-reviewed">{{ $count_reviewed }}</span>
                    </a>
                    <a href="#" class="main-btn btn-sm bg-success filter-btn" data-status="accepted">
                        مقبول : <span id="count-accepted">{{ $count_accepted }}</span>
                    </a>
                    <a href="#" class="main-btn btn-sm bg-danger filter-btn" data-status="rejected">
                        مرفوض : <span id="count-rejected">{{ $count_rejected }}</span>
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
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>عنوان المشروع</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody id="submissions-tbody">
                    @include('dashboard.project-submissions._table', ['items' => $items])
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
        $('#submissions-tbody').html(
            '<tr><td colspan="7" class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary" role="status"></div></td></tr>'
        );
        $.ajax({
            url: '{{ route('dashboard.project-submissions.index') }}',
            data: { search: $('#search-input').val(), status: currentStatus, page: page || 1 },
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (res) {
                $('#submissions-tbody').html(res.html);
                $('#pagination-wrapper').html(res.pagination);
                $('#count-all').text(res.count_all);
                $('#count-new').text(res.count_new);
                $('#count-reviewed').text(res.count_reviewed);
                $('#count-accepted').text(res.count_accepted);
                $('#count-rejected').text(res.count_rejected);
            }
        });
    }
});
</script>
@endpush
