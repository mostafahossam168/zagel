@extends('front.layouts.app')
@section('title', 'من نحن')

@section('content')

{{-- Page Header --}}
<section class="bg-surface-container-low py-10 border-b border-outline-variant">
    <div class="max-w-[1200px] mx-auto px-4">
        <h1 class="text-display-md font-bold text-primary mb-2">من نحن</h1>
        <p class="text-body-lg text-on-surface-variant">تعرف على منصة زاجل ورؤيتنا للأسرة</p>
    </div>
</section>

{{-- Main About Section --}}
<section class="max-w-[1200px] mx-auto px-4 py-14">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

        {{-- Text Side --}}
        <div>
            <span class="inline-block bg-primary-fixed text-primary text-xs font-bold px-3 py-1 rounded-full mb-4">منصة زاجل</span>
            <h2 class="text-headline-lg font-bold text-on-surface mb-4 leading-snug">نبني مجتمعاً من الخدمات الموثوقة</h2>
            <p class="text-on-surface-variant text-body-lg leading-relaxed mb-8">
                زاجل منصة متخصصة في الخدمات المهنية، تهدف إلى تمكين مقدمي الخدمات وتزويد العملاء بالكفاءات التي يحتاجونها. نؤمن بأن الثقة والجودة أساس كل تعامل ناجح.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-surface-container-lowest rounded-xl p-4 premium-shadow">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-9 h-9 rounded-xl bg-primary-fixed flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-primary" style="font-size:18px">target</span>
                        </div>
                        <h6 class="font-bold text-on-surface text-sm">رؤيتنا</h6>
                    </div>
                    <p class="text-on-surface-variant text-sm">سوق عمل حر موثوق ومتكامل للخدمات المهنية</p>
                </div>
                <div class="bg-surface-container-lowest rounded-xl p-4 premium-shadow">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-9 h-9 rounded-xl bg-secondary-container flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-secondary" style="font-size:18px">favorite</span>
                        </div>
                        <h6 class="font-bold text-on-surface text-sm">رسالتنا</h6>
                    </div>
                    <p class="text-on-surface-variant text-sm">تقديم خدمات متكاملة بجودة عالية وبأسعار مناسبة</p>
                </div>
            </div>
        </div>

        {{-- Cards Grid --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-5 flex flex-col items-center text-center">
                <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-primary" style="font-size:24px">groups</span>
                </div>
                <h5 class="font-bold text-on-surface text-sm mb-1">فريق متخصص</h5>
                <p class="text-on-surface-variant text-xs leading-relaxed">خبراء معتمدون في مجالاتهم</p>
            </div>
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-5 flex flex-col items-center text-center">
                <div class="w-12 h-12 rounded-full bg-secondary-container flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-secondary" style="font-size:24px">star</span>
                </div>
                <h5 class="font-bold text-on-surface text-sm mb-1">جودة عالية</h5>
                <p class="text-on-surface-variant text-xs leading-relaxed">خدمات مُعتمدة ومُقيَّمة</p>
            </div>
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-5 flex flex-col items-center text-center">
                <div class="w-12 h-12 rounded-full bg-tertiary-fixed flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-tertiary" style="font-size:24px">shield</span>
                </div>
                <h5 class="font-bold text-on-surface text-sm mb-1">موثوقية تامة</h5>
                <p class="text-on-surface-variant text-xs leading-relaxed">خصوصية وأمان في جميع التعاملات</p>
            </div>
            <div class="bg-surface-container-lowest rounded-xl premium-shadow p-5 flex flex-col items-center text-center">
                <div class="w-12 h-12 rounded-full bg-surface-variant flex items-center justify-center mb-3">
                    <span class="material-symbols-outlined text-on-surface-variant" style="font-size:24px">headset_mic</span>
                </div>
                <h5 class="font-bold text-on-surface text-sm mb-1">دعم مستمر</h5>
                <p class="text-on-surface-variant text-xs leading-relaxed">فريق دعم متاح للإجابة على استفساراتك</p>
            </div>
        </div>

    </div>
</section>

{{-- Stats --}}
<section class="bg-primary py-12">
    <div class="max-w-[1200px] mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center text-on-primary">
            <div>
                <div class="text-display-sm font-bold mb-1">+500</div>
                <div class="text-sm opacity-80">مزود خدمة</div>
            </div>
            <div>
                <div class="text-display-sm font-bold mb-1">+2000</div>
                <div class="text-sm opacity-80">عميل راضٍ</div>
            </div>
            <div>
                <div class="text-display-sm font-bold mb-1">+50</div>
                <div class="text-sm opacity-80">تصنيف خدمة</div>
            </div>
            <div>
                <div class="text-display-sm font-bold mb-1">4.9</div>
                <div class="text-sm opacity-80">متوسط التقييم</div>
            </div>
        </div>
    </div>
</section>

{{-- Values --}}
<section class="max-w-[1200px] mx-auto px-4 py-14">
    <div class="text-center mb-10">
        <h2 class="text-headline-lg font-bold text-on-surface mb-3">قيمنا الأساسية</h2>
        <p class="text-on-surface-variant text-body-lg max-w-xl mx-auto">نلتزم بمجموعة من القيم التي تحكم كيفية عملنا وتعاملنا مع جميع أطراف المنصة</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-surface-container-lowest rounded-xl premium-shadow p-6 text-center">
            <div class="w-14 h-14 rounded-2xl bg-primary-fixed flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-primary" style="font-size:28px">handshake</span>
            </div>
            <h4 class="font-bold text-on-surface mb-2">الشفافية</h4>
            <p class="text-on-surface-variant text-sm leading-relaxed">نتعامل بوضوح تام مع جميع مزودي الخدمات والعملاء دون أي غموض</p>
        </div>
        <div class="bg-surface-container-lowest rounded-xl premium-shadow p-6 text-center">
            <div class="w-14 h-14 rounded-2xl bg-secondary-container flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-secondary" style="font-size:28px">verified</span>
            </div>
            <h4 class="font-bold text-on-surface mb-2">الجودة</h4>
            <p class="text-on-surface-variant text-sm leading-relaxed">نضمن أعلى معايير الجودة في كل خدمة تُعرض على منصتنا</p>
        </div>
        <div class="bg-surface-container-lowest rounded-xl premium-shadow p-6 text-center">
            <div class="w-14 h-14 rounded-2xl bg-tertiary-fixed flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-tertiary" style="font-size:28px">people</span>
            </div>
            <h4 class="font-bold text-on-surface mb-2">المجتمع</h4>
            <p class="text-on-surface-variant text-sm leading-relaxed">نبني مجتمعاً مهنياً قوياً يدعم بعضه ويتطور معاً</p>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="bg-surface-container-low py-12 border-t border-outline-variant">
    <div class="max-w-[1200px] mx-auto px-4 text-center">
        <h3 class="text-headline-md font-bold text-on-surface mb-3">هل لديك مساعدة؟</h3>
        <p class="text-on-surface-variant mb-6 text-body-lg">تواصل معنا وسيسعدنا الإجابة على جميع استفساراتك</p>
        <a href="{{ route('contact') }}"
           class="inline-flex items-center gap-2 bg-primary text-on-primary px-8 py-3.5 rounded-xl font-bold text-sm hover:bg-primary-container transition-colors premium-shadow">
            <span class="material-symbols-outlined" style="font-size:18px">mail</span>
            تواصل معنا
        </a>
    </div>
</section>

@endsection
