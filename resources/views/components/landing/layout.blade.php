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
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        @livewireAssets
        @livewireStyles
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

    </head>
    <body>
        <div class="sticky-menu">
            <div
                class="nav-menu"
                x-data="{ navOpen: false }"
                @keydown.escape="navOpen = false"
                >
                <img class="logo" src="{{asset('img/logo.png')}}">
                <x-landing.burger></x-landing.burger>
                <nav
                    class="w-full flex-grow lg:flex"
                    :class="{ 'flex-grow shadow-3xl': navOpen, 'hidden': !navOpen }"
                >
                  <a class="{{ Request::is('/') ? 'selected' : '' }}" href="/">Inicio</a>
                  {{-- <a :class="{ 'block shadow-3xl': navOpen, 'hidden': !navOpen }" href="#">Blog</a> --}}
                  <x-landing.team-nav></x-landing.team-nav>
                  <a class="{{ Request::is('book') ? 'selected' : '' }}"
                  href="https://f8f6bc91ed06a41fb6527cdbb7dd65b9638c84fd.agenda.softwaremedilink.com/agendas/agendamiento">Reserva Hora</a>
                  <a class="{{ Request::is('trainings') ? 'selected' : '' }}" href="/trainings">Entrenamiento</a>
                  <a class="cursor-not-allowed {{ Request::is('school') ? 'selected' : '' }}" href="#">Cursos</a>
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

        <x-contact-fixed></x-contact-fixed>
        <x-flash-message></x-flash-message>

        @if (isset($script)) {{ $script }} @endif

        @livewireScripts

    </body>
</html>
