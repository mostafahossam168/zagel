@extends('dashboard.layouts.backend', ['title' => 'الخدمات'])

@section('contant')
    <div class="main-side">
        <x-alert-component></x-alert-component>
        <div class="main-title">
            <div class="small">الرئيسية</div>/
            <div class="large">الخدمات</div>
        </div>

        <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
            <div class="btn-holder d-flex align-items-center justify-content-start gap-1 mb-2 flex-wrap">
                @can('create_services')
                    <a href="{{ route('dashboard.services.create') }}" class="main-btn">
                        اضافة <i class="fa-solid fa-plus"></i>
                    </a>
                @endcan
                <a href="#" class="main-btn btn-main-color filter-btn" data-status="">
                    الكل : <span id="count-all">{{ $count_all }}</span>
                </a>
                <a href="#" class="btn btn-success filter-btn" data-status="yes">
                    نشط : <span id="count-active">{{ $count_active }}</span>
                </a>
                <a href="#" class="btn btn-danger filter-btn" data-status="no">
                    غير نشط : <span id="count-inactive">{{ $count_inactive }}</span>
                </a>
            </div>
            <div class="box-search">
                <img src="{{ asset('dashboard/img/icons/search.png') }}" alt="icon" />
                <input type="search" id="search-input" value="{{ request('search') }}"
                    placeholder="@lang('Search')" autocomplete="off" />
            </div>
        </div>

        <div class="table-responsive">
            <table class="main-table mb-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الصورة</th>
                        <th>العنوان</th>
                        <th>القسم</th>
                        <th>السعر</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody id="services-tbody">
                    @include('dashboard.services._table', ['items' => $items])
                </tbody>
            </table>
            <div id="pagination-wrapper">
                {{ $items->links() }}
            </div>
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
        $('#services-tbody').html(
            '<tr><td colspan="7" class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary" role="status"></div></td></tr>'
        );
        $.ajax({
            url: '{{ route('dashboard.services.index') }}',
            data: { search: $('#search-input').val(), status: currentStatus, page: page || 1 },
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            success: function (res) {
                $('#services-tbody').html(res.html);
                $('#pagination-wrapper').html(res.pagination);
                $('#count-all').text(res.count_all);
                $('#count-active').text(res.count_active);
                $('#count-inactive').text(res.count_inactive);
            }
        });
    }
});
</script>
@endpush
