<nav class="adminav flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">

  @if(Auth::user()->isAdmin())
    <x-nav-dropdown>
      <x-slot name="name"><i class="fas fa-user text-xs mr-1"></i> Usuarios</x-slot>
      <x-slot name="trigger">Usuarios</x-slot>
      <a class="py-1" href="/adminusers">Todos</a>
      <a class="my-1 py-1" href="/adminstudents">Estudiantes</a>
      <a class="my-1 py-1" href="/adminprofessionals">Profesionales</a>
      <a class="my-1 py-1" href="/admintrainers">Entrenadores</a>
    </x-nav-dropdown>

    <x-nav-dropdown>
      <x-slot name="name"><i class="fas fa-calendar-alt mr-1"></i> Entrenamiento</x-slot>
      <x-slot name="trigger">Clases</x-slot>
      <a class="py-1" href="/adminclass">Programas</a>
      <a class="my-1 py-1" href="/admintrainappointment">Calendario</a>
      <a class="my-1 py-1" href="/adminbookappointment">Clases Reservadas</a>
    </x-nav-dropdown>

    <x-nav-dropdown>
      <x-slot name="name"><i class="fas fa-notes-medical mr-1"></i>Medilink</x-slot>
      <x-slot name="trigger">medelink</x-slot>
      <a class="py-1" href="/userml">Usuarios</a>
      {{-- <a class="my-1 py-1" href="#">Link #2</a> --}}
      {{-- <a class="my-1 py-1" href="#">Link #3</a> --}}
    </x-nav-dropdown>

    <x-nav-dropdown>
      <x-slot name="name">Example</x-slot>
      <x-slot name="trigger">example</x-slot>
      <a class="py-1" href="#">Link #1</a>
      <a class="my-1 py-1" href="#">Link #2</a>
      <a class="my-1 py-1" href="#">Link #3</a>
    </x-nav-dropdown>

    <a class="mt-3" href="#">Scrapping</a>

    <x-nav-dropdown>
      <x-slot name="name">Encuestas</x-slot>
      <x-slot name="trigger">encuestas</x-slot>
      <a class="py-1" href="/admin/encuesta_satisfaccion">Encuesta de Satisfacción</a>
      {{-- <a class="my-1 py-1" href="#">Link #2</a> --}}
      {{-- <a class="my-1 py-1" href="#">Link #3</a> --}}
    </x-nav-dropdown>

  @endif

  @if(Auth::user()->isTrainer())
    <x-nav-dropdown>
      <x-slot name="name">Entrenamiento</x-slot>
      <x-slot name="trigger">training</x-slot>
      <a class="py-1" href="/trainertrainappointment"><i class="fas fa-calendar-alt"></i> Entrenamiento</a>
      <a class="my-1 py-1" href="/trainerbookappointment">Clases Reservadas</a>
    </x-nav-dropdown>
  @endif

</nav>
