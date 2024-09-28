<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="theme-light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://www.jsdelivr.com/package/npm/@creativebulma/bulma-tagsinput/dist/css/bulma-tagsinput.min.css" />

    </head>
    <body>
        <nav class="navbar is-link is-fixed-top">
            <div class="navbar-brand">
                <a class="navbar-item" href="{{ config('app.secure') ? 'https://' : 'http://' }}{{ config('app.domain') }}">{{ config('app.domain') }}</a>
            </div>

            <div class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item" href="/logout">{{ __('general.exit') }}</a>
                </div>
            </div>
        </nav>
        @include('admin.helpers.sidebar')

        <main>
            @yield('content')
        </main>

        <!-- Scripts -->
        {{-- <script src="{{ asset('js/admin.js') }}" ></script> --}}
        <script>
            window.Laravel = {}
        </script>
        @stack('js')
    </body>
</html>
