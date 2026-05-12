@extends('front.layouts.app')
@section('title', 'الخدمات')

@section('content')

{{-- Page Header --}}
<section class="bg-surface-container-low py-10 border-b border-outline-variant">
    <div class="max-w-[1200px] mx-auto px-4">
        <nav class="flex items-center gap-1 text-xs text-on-surface-variant mb-3">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">الرئيسية</a>
            <span class="material-symbols-outlined" style="font-size:14px">chevron_left</span>
            <span class="text-primary font-semibold">الخدمات</span>
        </nav>
        <h1 class="text-display-md font-bold text-primary mb-2">استكشف الخدمات المتميزة</h1>
        <p class="text-body-lg text-on-surface-variant max-w-2xl">
            اختر من بين مئات الخدمات الاحترافية المقدمة من أفضل الخبراء في السوق.
        </p>
    </div>
</section>

<div class="max-w-[1200px] mx-auto px-4 py-10">

    {{-- Filter Bar --}}
    <form id="filter-form" method="GET" action="{{ route('services.index') }}"
          class="bg-surface-container-lowest rounded-xl premium-shadow p-5 mb-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">

            {{-- Search --}}
            <div class="md:col-span-4">
                <label class="block text-label-lg text-on-surface-variant mb-1.5">بحث عن خدمة</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none" style="font-size:18px">search</span>
                    <input type="text" name="q" id="search-input" value="{{ request('q') }}"
                           class="w-full pr-10 pl-4 py-2.5 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary text-sm"
                           placeholder="ما الذي تبحث عنه؟" autocomplete="off">
                </div>
            </div>

            {{-- Category --}}
            <div class="md:col-span-3">
                <label class="block text-label-lg text-on-surface-variant mb-1.5">الفئة</label>
                <div class="relative">
                    <select name="category" id="category-select"
                            class="w-full appearance-none pr-4 pl-9 py-2.5 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary text-sm text-right">
                        <option value="">كل الفئات</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none" style="font-size:18px">expand_more</span>
                </div>
            </div>

            {{-- Price Range --}}
            <div class="md:col-span-4">
                <label class="block text-label-lg text-on-surface-variant mb-1.5">نطاق السعر (ر.س)</label>
                <div class="flex items-center gap-2">
                    <input type="number" name="price_min" id="price-min" value="{{ request('price_min') }}"
                           class="flex-1 px-3 py-2.5 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary text-sm text-center"
                           placeholder="من" min="0" step="1">
                    <span class="text-on-surface-variant text-xs font-semibold flex-shrink-0">—</span>
                    <input type="number" name="price_max" id="price-max" value="{{ request('price_max') }}"
                           class="flex-1 px-3 py-2.5 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary text-sm text-center"
                           placeholder="إلى" min="0" step="1">
                </div>
            </div>

            {{-- Actions --}}
            <div class="md:col-span-1 flex items-end gap-2">
                <button type="submit" id="filter-btn"
                    class="flex-1 h-10 flex items-center justify-center rounded-xl bg-primary text-on-primary hover:bg-primary-container transition-colors">
                    <span class="material-symbols-outlined" style="font-size:20px">filter_list</span>
                </button>
                @if(request()->hasAny(['q','category','price_min','price_max']))
                <a href="{{ route('services.index') }}" id="reset-btn"
                   class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-xl bg-surface-container-low text-on-surface-variant hover:bg-error-container hover:text-error transition-colors">
                    <span class="material-symbols-outlined" style="font-size:20px">close</span>
                </a>
                @endif
            </div>
        </div>

        {{-- Active filter badges --}}
        <div id="active-filters" class="flex flex-wrap gap-2 mt-3 {{ request()->hasAny(['q','category','price_min','price_max']) ? '' : 'hidden' }}">
            @if(request('q'))
            <span class="inline-flex items-center gap-1 bg-primary-fixed text-primary text-xs font-semibold px-2.5 py-1 rounded-full">
                <span class="material-symbols-outlined" style="font-size:13px">search</span>
                {{ request('q') }}
            </span>
            @endif
            @if(request('category'))
            @php $activeCat = $categories->firstWhere('id', request('category')); @endphp
            @if($activeCat)
            <span class="inline-flex items-center gap-1 bg-secondary-container text-on-secondary-fixed-variant text-xs font-semibold px-2.5 py-1 rounded-full">
                <span class="material-symbols-outlined" style="font-size:13px">category</span>
                {{ $activeCat->name }}
            </span>
            @endif
            @endif
            @if(request('price_min') || request('price_max'))
            <span class="inline-flex items-center gap-1 bg-tertiary-fixed text-tertiary text-xs font-semibold px-2.5 py-1 rounded-full">
                <span class="material-symbols-outlined" style="font-size:13px">payments</span>
                {{ request('price_min', '0') }} — {{ request('price_max', '∞') }} ر.س
            </span>
            @endif
        </div>
    </form>

    {{-- Results count --}}
    <div class="flex items-center justify-between mb-6">
        <p class="text-on-surface-variant text-sm" id="results-count">
            {{ $services->total() }} خدمة
            @if($services->total() !== $services->total() || request()->hasAny(['q','category','price_min','price_max']))
            — نتائج البحث
            @endif
        </p>
        <div id="loading-spinner" class="hidden">
            <div class="w-5 h-5 border-2 border-primary border-t-transparent rounded-full animate-spin"></div>
        </div>
    </div>

    {{-- Services Grid --}}
    <div id="services-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10 transition-opacity duration-200">
        @forelse($services as $service)
        <article class="bg-surface-container-lowest rounded-xl premium-shadow overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
            <div class="h-52 w-full relative overflow-hidden">
                @if($service->image)
                    <img src="{{ display_file($service->image) }}" alt="{{ $service->title_ar }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <div class="w-full h-full bg-primary-fixed flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary" style="font-size:48px">business_center</span>
                    </div>
                @endif
                @if($service->category)
                <div class="absolute top-3 right-3">
                    <span class="bg-secondary text-on-secondary text-xs font-semibold px-3 py-0.5 rounded-full">{{ $service->category->name }}</span>
                </div>
                @endif
            </div>
            <div class="p-5 text-right">
                <h3 class="font-semibold text-primary mb-1" style="font-size:17px">{{ $service->title_ar }}</h3>
                <p class="text-on-surface-variant text-sm mb-4 line-clamp-2">{{ Str::limit($service->description_ar, 90) }}</p>
                <div class="flex items-center justify-between pt-4 border-t border-outline-variant">
                    <div>
                        @if($service->price)
                        <div class="text-outline text-xs">تبدأ من</div>
                        <div class="text-primary font-bold" style="font-size:17px">{{ number_format($service->price) }} {{ $service->currency }}</div>
                        @else
                        <div class="text-outline text-xs">السعر عند التواصل</div>
                        @endif
                    </div>
                    <a href="{{ route('services.show', $service) }}"
                       class="w-9 h-9 flex items-center justify-center rounded-lg bg-primary-fixed text-primary hover:bg-primary hover:text-on-primary transition-colors">
                        <span class="material-symbols-outlined" style="font-size:18px">chevron_left</span>
                    </a>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-3 text-center py-20">
            <span class="material-symbols-outlined text-outline mb-3" style="font-size:56px">search_off</span>
            <p class="text-on-surface-variant text-sm">لا توجد خدمات تطابق بحثك</p>
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-1 text-primary text-sm hover:underline mt-3">
                <span class="material-symbols-outlined" style="font-size:16px">refresh</span>
                مسح الفلاتر
            </a>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div id="pagination-wrap">
        @if($services->hasPages())
        <div class="flex justify-center items-center gap-2">
            @if($services->onFirstPage())
            <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-surface-container text-outline cursor-not-allowed">
                <span class="material-symbols-outlined" style="font-size:18px">chevron_right</span>
            </span>
            @else
            <a href="{{ $services->previousPageUrl() }}"
               class="w-10 h-10 flex items-center justify-center rounded-lg bg-surface-container text-on-surface hover:bg-primary hover:text-on-primary transition-colors">
                <span class="material-symbols-outlined" style="font-size:18px">chevron_right</span>
            </a>
            @endif

            @foreach($services->getUrlRange(1, $services->lastPage()) as $page => $url)
            @if($page == $services->currentPage())
            <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-on-primary font-bold text-sm">{{ $page }}</span>
            @else
            <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-lg bg-surface-container text-on-surface hover:bg-primary-fixed transition-colors text-sm">{{ $page }}</a>
            @endif
            @endforeach

            @if($services->hasMorePages())
            <a href="{{ $services->nextPageUrl() }}"
               class="w-10 h-10 flex items-center justify-center rounded-lg bg-surface-container text-on-surface hover:bg-primary hover:text-on-primary transition-colors">
                <span class="material-symbols-outlined" style="font-size:18px">chevron_left</span>
            </a>
            @else
            <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-surface-container text-outline cursor-not-allowed">
                <span class="material-symbols-outlined" style="font-size:18px">chevron_left</span>
            </span>
            @endif
        </div>
        @endif
    </div>

</div>

@push('scripts')
<script>
(function () {
    const form       = document.getElementById('filter-form');
    const grid       = document.getElementById('services-grid');
    const pagination = document.getElementById('pagination-wrap');
    const counter    = document.getElementById('results-count');
    const spinner    = document.getElementById('loading-spinner');
    if (!form || !grid) return;

    let debounceTimer = null;

    async function applyFilters() {
        const params = new URLSearchParams();
        const q         = document.getElementById('search-input').value.trim();
        const category  = document.getElementById('category-select').value;
        const priceMin  = document.getElementById('price-min').value.trim();
        const priceMax  = document.getElementById('price-max').value.trim();

        if (q)        params.set('q', q);
        if (category) params.set('category', category);
        if (priceMin) params.set('price_min', priceMin);
        if (priceMax) params.set('price_max', priceMax);

        const url = window.location.pathname + (params.toString() ? '?' + params.toString() : '');

        // UI feedback
        grid.style.opacity = '0.4';
        spinner.classList.remove('hidden');

        try {
            const res  = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            const html = await res.text();
            const doc  = new DOMParser().parseFromString(html, 'text/html');

            const newGrid   = doc.getElementById('services-grid');
            const newPager  = doc.getElementById('pagination-wrap');
            const newCount  = doc.getElementById('results-count');

            if (newGrid)  grid.innerHTML       = newGrid.innerHTML;
            if (newPager) pagination.innerHTML = newPager.innerHTML;
            if (newCount) counter.innerHTML    = newCount.innerHTML;

            // Update browser URL silently
            history.pushState({}, '', url);
        } catch (e) {
            // Fallback to normal form submit on error
            form.submit();
        } finally {
            grid.style.opacity = '1';
            spinner.classList.add('hidden');
        }
    }

    function debounce(fn, ms) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(fn, ms);
    }

    // Live search with debounce
    document.getElementById('search-input').addEventListener('input', () => debounce(applyFilters, 380));

    // Instant on category change
    document.getElementById('category-select').addEventListener('change', applyFilters);

    // Debounce on price inputs
    document.getElementById('price-min').addEventListener('input', () => debounce(applyFilters, 500));
    document.getElementById('price-max').addEventListener('input', () => debounce(applyFilters, 500));

    // Prevent full reload on submit
    form.addEventListener('submit', (e) => { e.preventDefault(); applyFilters(); });

    // Pagination clicks inside the pager (event delegation)
    pagination.addEventListener('click', async (e) => {
        const link = e.target.closest('a[href]');
        if (!link) return;
        e.preventDefault();
        const url = link.href;
        grid.style.opacity = '0.4';
        spinner.classList.remove('hidden');
        try {
            const res  = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            const html = await res.text();
            const doc  = new DOMParser().parseFromString(html, 'text/html');
            const newGrid  = doc.getElementById('services-grid');
            const newPager = doc.getElementById('pagination-wrap');
            const newCount = doc.getElementById('results-count');
            if (newGrid)  grid.innerHTML       = newGrid.innerHTML;
            if (newPager) pagination.innerHTML = newPager.innerHTML;
            if (newCount) counter.innerHTML    = newCount.innerHTML;
            history.pushState({}, '', url);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } finally {
            grid.style.opacity = '1';
            spinner.classList.add('hidden');
        }
    });
})();
</script>
@endpush

@endsection
