<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>You Just Better</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="icon" type="image/png" href="{{ asset('/img/icon.png') }}">
        <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.x/dist/alpine.min.js" defer></script>
        <livewire:styles />
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-GFXLHYT7L3"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-GFXLHYT7L3');
          gtag('config', 'AW-10872889051');
        </script>
        <script> gtag('event', 'conversion', {'send_to': 'AW-10872889051/Jlg6CIvr9KsDENu9zMAo'}); </script>
        <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>

    </head>
    <body>
        <amp-analytics type="gtag" data-credentials="include"> <script type="application/json"> { "vars": { "gtag_id": "AW-10872889051", "config": { "AW-10872889051": { "groups": "default" } } }, "triggers": { } } </script> </amp-analytics>
        <div class="sticky-menu">
            <div
                class="nav-menu"
                x-data="{ navOpen: false }"
                @keydown.escape="navOpen = false"
                >
                    <a href="/" class="sm:w-full h-16 lg:h-full">
                        <img class="logo" src="{{asset('img/logo.png')}}">
                    </a>
                <x-landing.burger></x-landing.burger>
                <nav
                    class="w-full flex-grow lg:flex"
                    :class="{ 'flex-grow shadow-3xl': navOpen, 'hidden': !navOpen }"
                >
                  <a class="nav-menu-link {{ Request::is('/') ? 'selected' : '' }}" href="/">Inicio</a>
                  {{-- <a :class="{ 'block shadow-3xl': navOpen, 'hidden': !navOpen }" href="#">Blog</a> --}}
                  <x-landing.team-nav></x-landing.team-nav>
                  <a class="nav-menu-link {{ Request::is('book') ? 'selected' : '' }}"
                  href="https://f8f6bc91ed06a41fb6527cdbb7dd65b9638c84fd.agenda.softwaremedilink.com/agendas/agendamiento">Clínica</a>
                  <a class="nav-menu-link {{ Request::is('trainings') ? 'selected' : '' }}" href="/trainings">Entrenamiento</a>
                  <a class="nav-menu-link {{ Request::is('school') ? 'selected' : '' }}" href="https://you-just-better-programs.teachable.com/courses" target="_blank">Cursos</a>
                  <x-landing.auth-dropdown></x-landing.auth-dropdown>
                  <x-landing.guest-dropdown></x-landing.guest-dropdown>
                </nav>
            </div>
        </div>

        <div class="mt-0 mb-auto">
            {{ $slot }}
        </div>

        <footer class="bg-you-grey h-auto py-4 text-center py-4">
            <span class="text-white">© You Just Better <script>document.write(new Date().getFullYear())</script></span>
        </footer>

        <x-train-fixed></x-train-fixed>
        <x-contact-fixed></x-contact-fixed>
        <x-flash-message></x-flash-message>
        @if (isset($script)) {{ $script }} @endif
        <livewire:scripts />

    </body>
</html>
