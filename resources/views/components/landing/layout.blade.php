<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>You Just Better - Kinesiología y Centro de Salud</title>

        <meta name="Description" content="Somos un centro integral de salud, donde mezclamos kinesiología y medicina deportiva que promueve hábitos y estilos de vida saludables, ligados al deporte. Reembolsable por Isapre">



        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="icon" type="image/png" href="{{ asset('/img/icon.png') }}">
        <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/gh/alpine-collective/alpine-magic-helpers@1.2.x/dist/index.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.x/dist/alpine.min.js" defer></script>
        <livewire:styles />
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-GFXLHYT7L3"></script>
        <!-- Global site tag (gtag.js) - Google Ads: 10872889051 --> <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10872889051"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-10872889051'); </script>
        <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>

        <!-- Event snippet for Botón de Whatsapp conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> <script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-10872889051/4MEKCPbSm7cDENu9zMAo', 'event_callback': callback }); return false; } </script>
        @if (Auth::check())
            <script> gtag('event', 'conversion', {'send_to': 'AW-10872889051/Jlg6CIvr9KsDENu9zMAo'}); </script>
        @endif
    </head>
    <body class="flex flex-col h-screen">
        <div class="sticky-menu z-50 top-0 ">
            <div
                class="nav-menu"
                x-data="{ navOpen: false }"
                @keydown.escape="navOpen = false"
                >
                    <a href="/" class="sm:w-full h-16 lg:h-20 flex items-center">
                        <img class="logo" src="{{asset('img/logo.png')}}">
                    </a>
                <x-landing.burger></x-landing.burger>
                <nav
                    class="w-full flex-grow lg:flex mt-2 sm:mt-0"
                    :class="{ 'flex-grow shadow-3xl': navOpen, 'hidden': !navOpen }"
                >
                  <!-- <a class="nav-menu-link" href="https://blog.justbetter.cl/">Blog</a> -->
                  <a class="nav-menu-link" href="/kinesiología">Kinesiología</a>
                  <a class="nav-menu-link" href="/#servicios">Servicios</a>
                  <a class="nav-menu-link" href="/#equipo">Equipo</a>
                  {{-- <a class="nav-menu-link" href="/#embajadores">Embajadores</a> --}}
                  <a class="nav-menu-link" href="/#testimonios">Testimonios</a>
                  <a href="/students" class="nav-menu-link block sm:hidden">
                    Reservar Clase
                  </a>
                  <a class="nav-menu-link {{ Request::is('trainings') ? 'selected' : '' }}" href="/trainings">Entrenamiento</a>
                  <a class="nav-menu-link {{ Request::is('school') ? 'selected' : '' }}" href="https://you-just-better-programs.teachable.com/courses" target="_blank">Cursos</a>
                  <x-landing.auth-dropdown></x-landing.auth-dropdown>
                  <x-landing.guest-dropdown></x-landing.guest-dropdown>
                </nav>
            </div>
        </div>


        <div class="mt-0 mb-auto">
            <div class="h-24"></div>
            {{ $slot }}
        </div>

        <footer class="bg-you-grey h-auto py-4 text-center py-4 bottom-0">
            <span class="text-white">© You Just Better <script>document.write(new Date().getFullYear())</script></span>
        </footer>

        <x-train-fixed></x-train-fixed>
        <x-contact-fixed></x-contact-fixed>
        <x-flash-message></x-flash-message>
        @if (isset($script)) {{ $script }} @endif
        <livewire:scripts />

    </body>
</html>
