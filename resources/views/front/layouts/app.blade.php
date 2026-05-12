<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', setting('website_name', 'زاجل')) | {{ setting('website_name', 'زاجل') }}</title>
    <meta name="description" content="@yield('meta_description', 'منصة زاجل للخدمات')">

    <!-- Cairo Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <!-- Font Awesome for legacy icons -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/all.min.css') }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ display_file(setting('fav')) }}">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface":                  "#f9f9fe",
                        "surface-dim":              "#dad9de",
                        "surface-bright":           "#f9f9fe",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low":    "#f3f3f8",
                        "surface-container":        "#eeedf2",
                        "surface-container-high":   "#e8e8ec",
                        "surface-container-highest":"#e2e2e7",
                        "on-surface":               "#1a1c1f",
                        "on-surface-variant":       "#43474f",
                        "inverse-surface":          "#2f3034",
                        "inverse-on-surface":       "#f1f0f5",
                        "outline":                  "#737780",
                        "outline-variant":          "#c3c6d0",
                        "surface-tint":             "#386092",
                        "surface-variant":          "#e2e2e7",
                        "background":               "#f9f9fe",
                        "on-background":            "#1a1c1f",
                        "primary":                  "#0f3f70",
                        "on-primary":               "#ffffff",
                        "primary-container":        "#2e5789",
                        "on-primary-container":     "#accdff",
                        "primary-fixed":            "#d4e3ff",
                        "primary-fixed-dim":        "#a4c9ff",
                        "on-primary-fixed":         "#001c39",
                        "on-primary-fixed-variant": "#1c4879",
                        "inverse-primary":          "#a4c9ff",
                        "secondary":                "#006e2d",
                        "on-secondary":             "#ffffff",
                        "secondary-container":      "#5ffd86",
                        "on-secondary-container":   "#00722f",
                        "secondary-fixed":          "#68ff8b",
                        "secondary-fixed-dim":      "#3fe26f",
                        "on-secondary-fixed":       "#002108",
                        "on-secondary-fixed-variant":"#005320",
                        "tertiary":                 "#563900",
                        "on-tertiary":              "#ffffff",
                        "tertiary-container":       "#744e00",
                        "on-tertiary-container":    "#f7c26f",
                        "tertiary-fixed":           "#ffddaf",
                        "tertiary-fixed-dim":       "#f3be6b",
                        "on-tertiary-fixed":        "#281800",
                        "on-tertiary-fixed-variant":"#614000",
                        "error":                    "#ba1a1a",
                        "on-error":                 "#ffffff",
                        "error-container":          "#ffdad6",
                        "on-error-container":       "#93000a",
                    },
                    fontFamily: {
                        sans: ["Cairo", "sans-serif"],
                    },
                    fontSize: {
                        "display-lg":  ["48px", { lineHeight: "1.2", fontWeight: "700" }],
                        "display-md":  ["36px", { lineHeight: "1.3", fontWeight: "700" }],
                        "headline-lg": ["28px", { lineHeight: "1.4", fontWeight: "600" }],
                        "headline-md": ["24px", { lineHeight: "1.4", fontWeight: "600" }],
                        "body-lg":     ["18px", { lineHeight: "1.6", fontWeight: "400" }],
                        "body-md":     ["16px", { lineHeight: "1.6", fontWeight: "400" }],
                        "label-lg":    ["14px", { lineHeight: "1.2", fontWeight: "600" }],
                        "label-sm":    ["12px", { lineHeight: "1.2", fontWeight: "400" }],
                    },
                    spacing: {
                        "xs":   "4px",
                        "sm":   "8px",
                        "md":   "16px",
                        "lg":   "24px",
                        "xl":   "32px",
                        "xxl":  "48px",
                        "gutter":"24px",
                    },
                    borderRadius: {
                        DEFAULT: "0.625rem",
                        sm:  "0.25rem",
                        md:  "0.75rem",
                        lg:  "1rem",
                        xl:  "1.5rem",
                        full:"9999px",
                    },
                    boxShadow: {
                        premium: "0 4px 24px rgba(0,0,0,0.08)",
                    },
                },
            },
        };
    </script>

    <style>
        body { font-family: 'Cairo', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .hero-gradient  { background: linear-gradient(135deg, #0f3f70 0%, #1c4879 100%); }
        .cta-gradient   { background: linear-gradient(90deg,  #0f3f70 0%, #2e5789 100%); }
        .premium-shadow { box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        /* Accordion */
        .faq-body { max-height: 0; overflow: hidden; transition: max-height .3s ease, padding .3s ease; }
        .faq-body.open { max-height: 600px; }
        /* User Toast */
        .user-toast-notif {
            position: fixed; bottom: 1.5rem; left: 1.5rem;
            background: #0f3f70; color: #fff; padding: .85rem 1.25rem;
            border-radius: .75rem; box-shadow: 0 4px 24px rgba(0,0,0,.18);
            opacity: 0; transform: translateY(12px);
            transition: opacity .35s, transform .35s; z-index: 9999;
            max-width: 320px; font-family: 'Cairo', sans-serif;
        }
        .user-toast-notif.show { opacity: 1; transform: translateY(0); }
    </style>

    @yield('css')
</head>
<body class="bg-background text-on-surface">

    @include('front.layouts.header')

    <main>
        @yield('content')
    </main>

    @include('front.layouts.footer')

    <!-- Main JS -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <!-- Mobile menu toggle -->
    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu    = document.getElementById('mobile-menu');
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
        // FAQ accordion
        document.querySelectorAll('.faq-trigger').forEach(btn => {
            btn.addEventListener('click', () => {
                const body = btn.nextElementSibling;
                const icon = btn.querySelector('.faq-icon');
                body.classList.toggle('open');
                if (icon) icon.textContent = body.classList.contains('open') ? 'remove' : 'add';
            });
        });
    </script>

    @stack('scripts')

    @auth
    @if(auth()->user()->type->value === 'user')
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
    (function () {
        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
            forceTLS: true,
            authEndpoint: '{{ url('/broadcasting/auth') }}',
            auth: { headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } }
        });
        const channel = pusher.subscribe('private-App.Models.User.{{ auth()->id() }}');
        channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function (data) {
            const badge = document.getElementById('user-bell-badge');
            const list  = document.getElementById('user-notif-list');
            if (badge) {
                const count = (parseInt(badge.textContent) || 0) + 1;
                badge.textContent = count > 9 ? '9+' : count;
                badge.classList.remove('hidden');
            }
            if (list) {
                const empty = list.querySelector('.notif-empty');
                if (empty) empty.remove();
                const item = document.createElement('div');
                item.className = 'p-3 border-b border-outline-variant text-right hover:bg-surface-container-low';
                item.innerHTML = '<div class="font-semibold text-on-surface text-sm">' + (data.title || '') + '</div>'
                    + '<div class="text-on-surface-variant text-xs mt-0.5">' + (data.body || '') + '</div>';
                list.prepend(item);
            }
            showUserToast(data.title, data.body);
        });
        function showUserToast(title, body) {
            const toast = document.createElement('div');
            toast.className = 'user-toast-notif';
            toast.innerHTML = '<strong>' + (title || '') + '</strong><div style="font-size:.85rem;opacity:.9;margin-top:4px">' + (body || '') + '</div>';
            document.body.appendChild(toast);
            setTimeout(() => toast.classList.add('show'), 50);
            setTimeout(() => { toast.classList.remove('show'); setTimeout(() => toast.remove(), 400); }, 5000);
        }
    })();
    </script>
    @endif
    @endauth

</body>
</html>
