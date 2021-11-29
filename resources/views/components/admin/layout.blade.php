<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>YouApp Just Better</title>
        <link rel="icon" type="image/png" href="{{ asset('/img/icon.png') }}">
        <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        @livewireStyles
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        <!-- Scripts -->

</head>

<body class="flex h-screen bg-gray-100 font-sans">
  <div class="md:flex flex-col md:flex-row md:min-h-screen w-full">
    <div class="flex flex-col w-full md:w-52 text-gray-700 bg-primary-500 flex-shrink-0">
      <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
        <a href="#" class=" dark-mode:text-white focus:outline-none focus:shadow-outline">
          <img class="logo" src="{{asset('img/you-completo-blanco.png')}}">
        </a>
      </div>
      <x-landing.admin-nav>

      </x-landing.admin-nav>
    </div>
    <div class="flex flex-col w-full flex-shrink-1">
      <!-- This example requires Tailwind CSS v2.0+ -->
      <x-landing.user-nav>

      </x-landing.user-nav>
      {{$slot}}
      <div class="flex flex-row h-screen gap-3 m-2 mt-4">
        @if(isset($title1) and isset($slot1))
        <div class="flex-grow admin-box">
          <div class="bg-light-grey rounded-t-lg p-3 h-12">{{ $title1  }}</div>
          <div class="rounded-b-lg h-full p-3">
            {{ $slot1 }}
          </div>
        </div>
        @endif
        @if(isset($title2) and isset($slot2))
        <div class="flex-none w-1/4 admin-box">
          <div class="bg-light-grey rounded-t-lg p-3 h-12">{{$title2}}</div>
          <div class="rounded-b-lg h-full p-3">
            {{$slot2}}
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
   @livewireScripts
</body>

</html>
