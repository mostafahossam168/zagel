<footer class="bg-surface-container-highest border-t border-outline-variant mt-16">
    <div class="max-w-[1200px] mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">

            {{-- Brand --}}
            <div>
                @if(setting('logo'))
                    <img src="{{ display_file(setting('logo')) }}" alt="{{ setting('website_name', 'زاجل') }}" class="h-10 w-auto mb-3">
                @else
                    <div class="font-bold text-primary mb-3" style="font-size:24px;font-weight:800">
                        {{ setting('website_name', 'زاجل') }}
                    </div>
                @endif
                <p class="text-on-surface-variant text-sm leading-relaxed mb-5">
                    منصة زاجل هي الوجهة الأولى لربط أصحاب الأعمال بالمحترفين في كافة المجالات لضمان نمو وازدهار مشاريعكم.
                </p>
                {{-- Social Icons --}}
                <div class="flex gap-2 flex-wrap">
                    @if(setting('twitter'))
                    <a href="{{ setting('twitter') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full bg-[#1a1a1a] text-white hover:opacity-80 transition-opacity" title="X (Twitter)">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.742l7.727-8.847L1.93 2.25H8.08l4.253 5.622L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>
                    </a>
                    @endif
                    @if(setting('facebook'))
                    <a href="{{ setting('facebook') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full bg-[#1877f2] text-white hover:opacity-80 transition-opacity" title="Facebook">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    @endif
                    @if(setting('instagram'))
                    <a href="{{ setting('instagram') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full bg-gradient-to-br from-[#f09433] via-[#e6683c] via-[#dc2743] via-[#cc2366] to-[#bc1888] text-white hover:opacity-80 transition-opacity" title="Instagram">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    @endif
                    @if(setting('whatsapp'))
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', setting('whatsapp')) }}" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full bg-[#25d366] text-white hover:opacity-80 transition-opacity" title="WhatsApp">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                    @endif
                    @if(setting('youtube'))
                    <a href="{{ setting('youtube') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full bg-[#ff0000] text-white hover:opacity-80 transition-opacity" title="YouTube">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    @endif
                    @if(setting('linkedin'))
                    <a href="{{ setting('linkedin') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full bg-[#0077b5] text-white hover:opacity-80 transition-opacity" title="LinkedIn">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                    @if(setting('tiktok'))
                    <a href="{{ setting('tiktok') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full bg-[#010101] text-white hover:opacity-80 transition-opacity" title="TikTok">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                    </a>
                    @endif
                    @if(setting('snapchat'))
                    <a href="{{ setting('snapchat') }}" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full bg-[#fffc00] text-black hover:opacity-80 transition-opacity" title="Snapchat">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12.206.793c.99 0 4.347.276 5.93 3.821.529 1.193.403 3.219.299 4.847l-.003.06c-.012.18-.022.345-.03.51.062.027.136.06.22.098.76.35 2.088.962 2.088 2.243 0 .714-.542 1.4-1.474 1.858-.22.108-.432.204-.63.291-.828.377-1.265.577-1.456 1.013-.07.16-.099.325-.127.489-.051.291-.112.641-.395.912a2.062 2.062 0 01-.633.385l-.049.016c-.146.044-.256.077-.274.173-.032.17.096.408.222.646.112.21.227.428.282.648a1.92 1.92 0 01.049.428c0 1.048-.804 1.77-1.882 1.77-.536 0-1.006-.163-1.461-.322-.418-.145-.836-.29-1.326-.29-.494 0-.88.128-1.317.273-.456.152-.92.307-1.458.307h-.058c-1.055 0-1.876-.727-1.876-1.77a1.909 1.909 0 01.049-.43c.054-.21.168-.427.28-.634.128-.24.256-.48.223-.65-.018-.098-.127-.132-.273-.176l-.049-.015a2.065 2.065 0 01-.635-.385c-.281-.27-.342-.619-.393-.912-.029-.163-.058-.33-.128-.49-.19-.436-.626-.636-1.453-1.012-.2-.088-.413-.184-.634-.292-.932-.458-1.474-1.144-1.474-1.858 0-1.28 1.33-1.893 2.09-2.244.083-.038.155-.07.218-.097-.008-.164-.018-.332-.03-.51l-.002-.06c-.104-1.628-.231-3.654.295-4.847C7.847 1.07 11.205.793 12.206.793z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-semibold text-primary mb-4 text-sm">روابط سريعة</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}"          class="text-on-surface-variant text-sm hover:text-primary transition-colors">الرئيسية</a></li>
                    <li><a href="{{ route('about') }}"         class="text-on-surface-variant text-sm hover:text-primary transition-colors">من نحن</a></li>
                    <li><a href="{{ route('faqs') }}"          class="text-on-surface-variant text-sm hover:text-primary transition-colors">الأسئلة الشائعة</a></li>
                    <li><a href="{{ route('testimonials') }}"  class="text-on-surface-variant text-sm hover:text-primary transition-colors">آراء العملاء</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h4 class="font-semibold text-primary mb-4 text-sm">خدماتنا</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('services.index') }}"  class="text-on-surface-variant text-sm hover:text-primary transition-colors">تصفح الخدمات</a></li>
                    <li><a href="{{ route('providers.index') }}" class="text-on-surface-variant text-sm hover:text-primary transition-colors">مزودو الخدمة</a></li>
                    <li><a href="{{ route('project.create') }}"  class="text-on-surface-variant text-sm hover:text-primary transition-colors">أضف مشروعك</a></li>
                    <li><a href="{{ route('contact') }}"         class="text-on-surface-variant text-sm hover:text-primary transition-colors">تواصل معنا</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-semibold text-primary mb-4 text-sm">تواصل معنا</h4>
                <ul class="space-y-2.5">
                    @if(setting('email'))
                    <li class="flex items-center gap-2 text-on-surface-variant text-sm">
                        <span class="material-symbols-outlined text-primary flex-shrink-0" style="font-size:16px">mail</span>
                        {{ setting('email') }}
                    </li>
                    @endif
                    @if(setting('phone'))
                    <li class="flex items-center gap-2 text-on-surface-variant text-sm">
                        <span class="material-symbols-outlined text-primary flex-shrink-0" style="font-size:16px">call</span>
                        {{ setting('phone') }}
                    </li>
                    @endif
                    @if(setting('address'))
                    <li class="flex items-center gap-2 text-on-surface-variant text-sm">
                        <span class="material-symbols-outlined text-primary flex-shrink-0" style="font-size:16px">location_on</span>
                        {{ setting('address') }}
                    </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="pt-6 border-t border-outline-variant flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-on-surface-variant text-xs">
                © {{ date('Y') }} {{ setting('website_name', 'زاجل') }}. جميع الحقوق محفوظة.
            </p>
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-secondary" style="font-size:16px">verified_user</span>
                <span class="text-on-surface-variant text-xs">مرخص ومعتمد</span>
            </div>
        </div>
    </div>
</footer>
