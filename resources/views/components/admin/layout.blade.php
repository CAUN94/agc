<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>You App Just Better</title>
        <link rel="icon" type="image/png" href="{{ asset('/img/icon.png') }}">
        <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="//code.jquery.com/jquery-1.12.3.js"></script>
        <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script
            src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <!-- <link rel="stylesheet"
            href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
        <link rel="stylesheet"
            href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" />




        @livewireStyles
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
        </script>

        <!-- Scripts -->

</head>
<body class="flex h-auto bg-gray-100 font-sans">
  <div class="md:flex flex-col md:flex-row md:min w-full">
    <div class="flex flex-col w-full md:w-2/12 text-gray-700 bg-primary-500 flex-shrink-0">
      <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
        <a href="/adminpage" class=" dark-mode:text-white focus:outline-none focus:shadow-outline">
          <img class="logo" src="{{asset('img/you-completo-blanco.png')}}">
        </a>
      </div>
      <x-landing.admin-nav>

      </x-landing.admin-nav>

    </div>
    <div class="flex flex-col sm:w-10/12 flex-shrink-1 h-screen">
      <!-- This example requires Tailwind CSS v2.0+ -->
      <x-landing.user-nav>

      </x-landing.user-nav>
      {{$slot}}
      <div class="flex flex-row gap-3 m-2 mt-4">
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
  <script src="{{ asset('/vendor/ckeditor/ckeditor.js') }}"></script>
  <script src="/vendor/livewire-charts/app.js"></script>
  <script>
    $(document).ready(function() {
      $('.table-data').DataTable();
  } );
  </script>
  @livewireScripts

  <x-flash-message></x-flash-message>

</body>

</html>
