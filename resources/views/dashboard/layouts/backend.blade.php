<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'لوحة التحكم' }}</title>
    <!-- Normalize -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/normalize.css') }}" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.rtl.min.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/all.min.css') }}" />
    <!-- Main File Css  -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/main.css') }}" />
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="shortcut icon" type="image/jpg" href="{{ display_file(setting('fav')) }}" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @vite('resources/js/app.js')
    @yield('css')
</head>

<body>
    <!-- Start layout -->
    @include('dashboard.layouts.navbar')
    <div class="app">
        @include('dashboard.layouts.sidebar')
        @yield('contant')
    </div>

    <!-- End layout -->
    <!-- Js Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/all.min.js') }}"></script>
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('dashboard/js/main.js') }}"></script>
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>

    @auth
    <script>
        (function () {
            const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
                cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
                forceTLS: true,
                authEndpoint: '{{ url('/broadcasting/auth') }}',
                auth: { headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } }
            });

            const channel = pusher.subscribe('private-App.Models.User.{{ auth()->id() }}');
            channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function () {
                const badge = document.getElementById('bell-badge');
                if (badge) {
                    const current = parseInt(badge.textContent) || 0;
                    badge.textContent = current + 1;
                    badge.classList.remove('d-none');
                }
            });
        })();
    </script>
    @endauth

    @stack('scripts')

</body>

</html>
