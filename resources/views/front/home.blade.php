@extends('front.layouts.app')
@section('title', 'الرئيسية')

@section('content')

    {{-- ─── Hero ─────────────────────────────────────────────────────────────── --}}
    <section class="hero-gradient text-on-primary py-16 md:py-24 overflow-hidden">
        <div class="max-w-[1200px] mx-auto px-4 flex flex-col md:flex-row items-center gap-12">
            <div class="w-full md:w-1/2 text-right order-2 md:order-1">
                <h1 class="text-display-md md:text-display-lg font-bold mb-4 leading-tight">
                    نربطك بأفضل مزودي الخدمة في المملكة
                </h1>
                <p class="text-body-lg mb-8 opacity-90">
                    منصة زاجل توفر لك خبراء معتمدين في جميع المجالات لضمان جودة وسرعة تنفيذ أعمالك.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('services.index') }}"
                        class="bg-on-primary text-primary px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity text-sm">
                        استعرض الخدمات
                    </a>
                    <a href="{{ route('project.create') }}"
                        class="border-2 border-on-primary text-on-primary px-8 py-3 rounded-lg font-semibold hover:bg-white/10 transition-all text-sm">
                        اطلب مشروع
                    </a>
                </div>
            </div>
            <div class="w-full md:w-1/2 order-1 md:order-2">
                @if (setting('hero_image'))
                    <img src="{{ display_file(setting('hero_image')) }}" alt="زاجل" class="w-full h-auto rounded-xl">
                @else
                    <div class="w-full h-72 md:h-96 rounded-xl bg-white/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-white/40" style="font-size:100px">business_center</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ─── Stats ───────────────────────────────────────────────────────────── --}}
    <section class="relative -mt-10 z-10 px-4">
        <div class="max-w-[1200px] mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-surface-container-lowest premium-shadow p-6 rounded-xl text-center">
                <div class="w-12 h-12 bg-primary-fixed rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-primary"
                        style="font-size:22px;font-variation-settings:'FILL' 1">work</span>
                </div>
                <div class="text-primary font-bold mb-1" style="font-size:28px">{{ $servicesTotal }}+</div>
                <div class="text-on-surface-variant text-sm font-semibold">عدد الخدمات</div>
            </div>
            <div class="bg-surface-container-lowest premium-shadow p-6 rounded-xl text-center">
                <div class="w-12 h-12 bg-secondary-container rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-secondary"
                        style="font-size:22px;font-variation-settings:'FILL' 1">groups</span>
                </div>
                <div class="text-primary font-bold mb-1" style="font-size:28px">1.2K</div>
                <div class="text-on-surface-variant text-sm font-semibold">مزودي الخدمة</div>
            </div>
            <div class="bg-surface-container-lowest premium-shadow p-6 rounded-xl text-center">
                <div class="w-12 h-12 bg-tertiary-fixed rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-tertiary"
                        style="font-size:22px;font-variation-settings:'FILL' 1">task_alt</span>
                </div>
                <div class="text-primary font-bold mb-1" style="font-size:28px">3K+</div>
                <div class="text-on-surface-variant text-sm font-semibold">المشاريع المنجزة</div>
            </div>
            <div class="bg-surface-container-lowest premium-shadow p-6 rounded-xl text-center">
                <div class="w-12 h-12 bg-surface-variant rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="material-symbols-outlined text-on-surface-variant"
                        style="font-size:22px;font-variation-settings:'FILL' 1">sentiment_very_satisfied</span>
                </div>
                <div class="text-primary font-bold mb-1" style="font-size:28px">98%</div>
                <div class="text-on-surface-variant text-sm font-semibold">عملاء راضون</div>
            </div>
        </div>
    </section>

    {{-- ─── Services ─────────────────────────────────────────────────────────── --}}
    <section class="py-16 mt-6">
        <div class="max-w-[1200px] mx-auto px-4">
            <div class="flex items-end justify-between mb-8">
                <h2 class="text-headline-lg font-bold text-primary">خدماتنا المميزة</h2>
                <a href="{{ route('services.index') }}"
                    class="text-primary text-sm font-semibold hover:underline flex items-center gap-1">
                    مشاهدة الكل
                    <span class="material-symbols-outlined" style="font-size:16px">chevron_left</span>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($services as $service)
                    <div
                        class="bg-surface-container-lowest rounded-xl premium-shadow overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
                        <div class="relative h-48 overflow-hidden">
                            @if ($service->image)
                                <img src="{{ display_file($service->image) }}" alt="{{ $service->title_ar }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-primary-fixed flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary"
                                        style="font-size:48px">business_center</span>
                                </div>
                            @endif
                            @if ($service->category)
                                <div
                                    class="absolute top-3 right-3 bg-secondary text-on-secondary px-2 py-0.5 rounded-full text-xs font-semibold">
                                    {{ $service->category->name }}
                                </div>
                            @endif
                        </div>
                        <div class="p-5 text-right">
                            <h3 class="font-semibold text-on-surface mb-1" style="font-size:17px">{{ $service->title_ar }}
                            </h3>
                            <p class="text-on-surface-variant text-sm mb-4 line-clamp-2">
                                {{ Str::limit($service->description_ar, 80) }}</p>
                            <div class="flex items-center justify-between">
                                @if ($service->price)
                                    <span class="text-primary text-sm font-semibold">
                                        بدءاً من {{ number_format($service->price) }} {{ $service->currency }}
                                    </span>
                                @endif
                                <a href="{{ route('services.show', $service) }}"
                                    class="text-primary text-sm font-semibold flex items-center gap-1 hover:underline">
                                    عرض التفاصيل
                                    <span class="material-symbols-outlined" style="font-size:16px">arrow_back</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-on-surface-variant py-12">لا توجد خدمات متاحة حالياً</div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ─── How It Works ─────────────────────────────────────────────────────── --}}
    <section class="py-16 bg-surface-container-low">
        <div class="max-w-[1200px] mx-auto px-4">
            <h2 class="text-headline-lg font-bold text-primary text-center mb-14">كيف تعمل منصة زاجل؟</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-primary text-on-primary rounded-full flex items-center justify-center mx-auto mb-5 premium-shadow">
                        <span class="material-symbols-outlined" style="font-size:32px">search</span>
                    </div>
                    <h3 class="font-semibold text-on-surface mb-2" style="font-size:18px">اختر الخدمة</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">تصفح مئات الخدمات المتاحة أو أضف تفاصيل
                        مشروعك الخاص.</p>
                </div>
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-primary text-on-primary rounded-full flex items-center justify-center mx-auto mb-5 premium-shadow">
                        <span class="material-symbols-outlined" style="font-size:32px">chat</span>
                    </div>
                    <h3 class="font-semibold text-on-surface mb-2" style="font-size:18px">تواصل مع المزود</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">ناقش التفاصيل مباشرة مع الخبراء واختر العرض
                        الأنسب لك.</p>
                </div>
                <div class="text-center">
                    <div
                        class="w-20 h-20 bg-primary text-on-primary rounded-full flex items-center justify-center mx-auto mb-5 premium-shadow">
                        <span class="material-symbols-outlined" style="font-size:32px">task_alt</span>
                    </div>
                    <h3 class="font-semibold text-on-surface mb-2" style="font-size:18px">أنجز مشروعك</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">استلم عملك بجودة عالية وادفع بكل سهولة وأمان
                        عبر المنصة.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── Testimonials Slider ──────────────────────────────────────────────── --}}
    @if ($testimonials->count())
        <section class="py-16">
            <div class="max-w-[1200px] mx-auto px-4">
                <h2 class="text-headline-lg font-bold text-primary text-center mb-10">ماذا يقول عملاؤنا</h2>
                <div class="relative">
                    {{-- Prev (right side in RTL) --}}
                    <button id="testimPrev"
                        class="absolute right-0 top-1/2 -translate-y-1/2 -mr-5 z-10 w-10 h-10 bg-surface-container-lowest rounded-full premium-shadow border border-outline-variant text-primary hover:bg-primary hover:text-on-primary transition-colors flex items-center justify-center">
                        <span class="material-symbols-outlined" style="font-size:20px">chevron_right</span>
                    </button>

                    {{-- Slider --}}
                    <div class="overflow-hidden mx-6" id="testimWrapper">
                        <div class="flex gap-6 transition-transform duration-500" id="testimTrack">
                            @foreach ($testimonials as $testimonial)
                                <div
                                    class="testimonial-slide flex-shrink-0 bg-surface-container-lowest p-6 rounded-xl premium-shadow border border-outline-variant text-right">
                                    <div class="flex items-center gap-3 mb-4">
                                        @if ($testimonial->image)
                                            <img src="{{ display_file($testimonial->image) }}"
                                                alt="{{ $testimonial->name }}"
                                                class="w-12 h-12 rounded-full object-cover flex-shrink-0">
                                        @else
                                            <div
                                                class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center flex-shrink-0">
                                                <span class="material-symbols-outlined text-primary"
                                                    style="font-size:22px">person</span>
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="font-semibold text-on-surface text-sm">
                                                {{ $testimonial->name }}</h4>
                                            @if ($testimonial->position || $testimonial->company)
                                                <p class="text-on-surface-variant text-xs">
                                                    {{ $testimonial->position }}{{ $testimonial->position && $testimonial->company ? ' â€“ ' : '' }}{{ $testimonial->company }}
                                                </p>
                                            @endif
                                            <div class="flex gap-0.5 mt-0.5" style="color:#f99132">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <span class="material-symbols-outlined"
                                                        style="font-size:13px;font-variation-settings:'FILL' {{ $i <= $testimonial->rating ? 1 : 0 }}">star</span>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-on-surface-variant text-sm leading-relaxed italic">
                                        "{{ $testimonial->content }}"</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Next (left side in RTL) --}}
                    <button id="testimNext"
                        class="absolute left-0 top-1/2 -translate-y-1/2 -ml-5 z-10 w-10 h-10 bg-surface-container-lowest rounded-full premium-shadow border border-outline-variant text-primary hover:bg-primary hover:text-on-primary transition-colors flex items-center justify-center">
                        <span class="material-symbols-outlined" style="font-size:20px">chevron_left</span>
                    </button>
                </div>

                {{-- Dots --}}
                <div id="testimDots" class="flex justify-center gap-2 mt-6"></div>

                @if ($testimonials->count() > 3)
                    <div class="text-center mt-6">
                        <a href="{{ route('testimonials') }}"
                            class="inline-flex items-center gap-2 text-primary font-semibold hover:underline text-sm">
                            عرض جميع الآراء
                            <span class="material-symbols-outlined" style="font-size:16px">chevron_left</span>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- ─── FAQ ──────────────────────────────────────────────────────────────── --}}
    @if ($faqs->count())
        <section class="py-16 bg-surface-container-low">
            <div class="max-w-[800px] mx-auto px-4">
                <h2 class="text-headline-lg font-bold text-primary text-center mb-10">الأسئلة الشائعة</h2>
                <div class="space-y-3">
                    @foreach ($faqs as $faq)
                        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant overflow-hidden">
                            <button
                                class="faq-trigger w-full flex items-center justify-between p-5 text-right font-semibold text-on-surface hover:bg-surface-container-low transition-colors">
                                <span class="text-sm md:text-base">{{ $faq->question }}</span>
                                <span class="material-symbols-outlined faq-icon text-primary flex-shrink-0 mr-3"
                                    style="font-size:22px">add</span>
                            </button>
                            <div class="faq-body">
                                <div class="px-5 pb-5 text-on-surface-variant text-sm leading-relaxed text-right">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ─── Partners ──────────────────────────────────────────────────────────────── --}}
    @if ($partners->count())
        <section class="py-12 bg-surface-container-lowest border-y border-outline-variant">
            <div class="max-w-[1200px] mx-auto px-4">
                <h2 class="text-headline-lg font-bold text-primary text-center mb-8">شركاؤنا</h2>
                <div class="relative">
                    <button id="partnersPrev"
                        class="absolute right-0 top-1/2 -translate-y-1/2 -mr-5 z-10 w-10 h-10 bg-surface-container-lowest rounded-full premium-shadow border border-outline-variant text-primary hover:bg-primary hover:text-on-primary transition-colors flex items-center justify-center">
                        <span class="material-symbols-outlined" style="font-size:20px">chevron_right</span>
                    </button>

                    <div class="overflow-hidden mx-6" id="partnersWrapper">
                        <div class="flex gap-6 transition-transform duration-500" id="partnersTrack">
                            @foreach ($partners as $partner)
                                <div
                                    class="partner-slide flex-shrink-0 h-28 bg-surface-container-low rounded-xl border border-outline-variant flex items-center justify-center p-5 opacity-70 hover:opacity-100 grayscale hover:grayscale-0 transition-all duration-300">
                                    @if ($partner->image)
                                        <img src="{{ display_file($partner->image) }}" alt="{{ $partner->name }}"
                                            class="max-h-16 w-auto object-contain">
                                    @else
                                        <span class="text-on-surface-variant text-sm font-semibold">{{ $partner->name }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <button id="partnersNext"
                        class="absolute left-0 top-1/2 -translate-y-1/2 -ml-5 z-10 w-10 h-10 bg-surface-container-lowest rounded-full premium-shadow border border-outline-variant text-primary hover:bg-primary hover:text-on-primary transition-colors flex items-center justify-center">
                        <span class="material-symbols-outlined" style="font-size:20px">chevron_left</span>
                    </button>
                </div>
                <div id="partnersDots" class="flex justify-center gap-2 mt-6"></div>
            </div>
        </section>
    @endif

    {{-- ─── CTA Banner ─────────────────────────────────────────────────────────────── --}}
    <section class="py-16">
        <div class="max-w-[1200px] mx-auto px-4">
            <div class="cta-gradient rounded-2xl p-10 md:p-14 text-on-primary text-center">
                <h2 class="font-bold mb-3" style="font-size:30px">هل لديك مساعدة؟</h2>
                <p class="text-body-lg mb-8 opacity-90">
                    ابدأ الآن وأضف مشروعك لنصلك بأفضل الكفاءات المتخصصة في المملكة.
                </p>
                <a href="{{ route('project.create') }}"
                    class="inline-flex items-center gap-2 bg-on-primary text-primary px-8 py-3.5 rounded-lg font-bold text-sm hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined" style="font-size:18px">add_circle</span>
                    اطلب مشروع
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            (function() {
                const track = document.getElementById('testimTrack');
                const wrapper = document.getElementById('testimWrapper');
                const dotsBox = document.getElementById('testimDots');
                if (!track || !wrapper) return;

                const slides = track.querySelectorAll('.testimonial-slide');
                const total = slides.length;
                const gap = 24;
                let current = 0;

                function visibleCount() {
                    if (window.innerWidth >= 1024) return Math.min(3, total);
                    if (window.innerWidth >= 768) return Math.min(2, total);
                    return 1;
                }

                function maxIndex() {
                    return Math.max(0, total - visibleCount());
                }

                function slideWidth() {
                    return slides[0].getBoundingClientRect().width + gap;
                }

                function toggleControls() {
                    const hide = maxIndex() === 0;
                    document.getElementById('testimPrev').classList.toggle('hidden', hide);
                    document.getElementById('testimNext').classList.toggle('hidden', hide);
                }

                function setSlideWidths() {
                    const visible = visibleCount();
                    const width = (wrapper.clientWidth - gap * (visible - 1)) / visible;
                    slides.forEach(slide => slide.style.width = width + 'px');
                    toggleControls();
                }

                function buildDots() {
                    dotsBox.innerHTML = '';
                    if (maxIndex() === 0) return;
                    const pages = maxIndex() + 1;
                    for (let i = 0; i < pages; i++) {
                        const dot = document.createElement('button');
                        dot.className = 'w-2.5 h-2.5 rounded-full transition-colors duration-200';
                        dot.style.cssText = i === current ? 'background:#0f3f70' : 'background:#c3c6d0';
                        dot.addEventListener('click', () => {
                            current = i;
                            update();
                        });
                        dotsBox.appendChild(dot);
                    }
                }

                function update() {
                    current = Math.min(current, maxIndex());
                    const direction = document.documentElement.dir === 'rtl' ? 1 : -1;
                    track.style.transform = `translateX(${current * slideWidth() * direction}px)`;
                    toggleControls();
                    buildDots();
                }

                document.getElementById('testimPrev').addEventListener('click', () => {
                    if (current > 0) {
                        current--;
                        update();
                    }
                });
                document.getElementById('testimNext').addEventListener('click', () => {
                    if (current < maxIndex()) {
                        current++;
                        update();
                    }
                });

                setSlideWidths();
                buildDots();
                window.addEventListener('resize', () => {
                    setSlideWidths();
                    current = 0;
                    update();
                });
            })();

            (function() {
                const track = document.getElementById('partnersTrack');
                const wrapper = document.getElementById('partnersWrapper');
                const dotsBox = document.getElementById('partnersDots');
                if (!track || !wrapper) return;

                const slides = track.querySelectorAll('.partner-slide');
                const total = slides.length;
                const gap = 24;
                let current = 0;

                function visibleCount() {
                    if (window.innerWidth >= 1024) return Math.min(5, total);
                    if (window.innerWidth >= 768) return Math.min(3, total);
                    return Math.min(2, total);
                }

                function maxIndex() {
                    return Math.max(0, total - visibleCount());
                }

                function slideWidth() {
                    return slides[0].getBoundingClientRect().width + gap;
                }

                function toggleControls() {
                    const hide = maxIndex() === 0;
                    document.getElementById('partnersPrev').classList.toggle('hidden', hide);
                    document.getElementById('partnersNext').classList.toggle('hidden', hide);
                }

                function setSlideWidths() {
                    const visible = visibleCount();
                    const width = (wrapper.clientWidth - gap * (visible - 1)) / visible;
                    slides.forEach(slide => slide.style.width = width + 'px');
                    toggleControls();
                }

                function buildDots() {
                    dotsBox.innerHTML = '';
                    if (maxIndex() === 0) return;
                    const pages = maxIndex() + 1;
                    for (let i = 0; i < pages; i++) {
                        const dot = document.createElement('button');
                        dot.className = 'w-2.5 h-2.5 rounded-full transition-colors duration-200';
                        dot.style.cssText = i === current ? 'background:#0f3f70' : 'background:#c3c6d0';
                        dot.addEventListener('click', () => {
                            current = i;
                            update();
                        });
                        dotsBox.appendChild(dot);
                    }
                }

                function update() {
                    current = Math.min(current, maxIndex());
                    const direction = document.documentElement.dir === 'rtl' ? 1 : -1;
                    track.style.transform = `translateX(${current * slideWidth() * direction}px)`;
                    toggleControls();
                    buildDots();
                }

                document.getElementById('partnersPrev').addEventListener('click', () => {
                    if (current > 0) {
                        current--;
                        update();
                    }
                });
                document.getElementById('partnersNext').addEventListener('click', () => {
                    if (current < maxIndex()) {
                        current++;
                        update();
                    }
                });

                setSlideWidths();
                buildDots();
                window.addEventListener('resize', () => {
                    setSlideWidths();
                    current = 0;
                    update();
                });
            })();
        </script>
    @endpush

@endsection
