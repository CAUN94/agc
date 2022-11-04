<nav class="adminav flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
  <a class="my-1 py-1" href="/adminpage"><i class="fas fa-solid fa-desktop mr-1"></i>Panel Inicio</a>
  @if(Auth::user()->isAdmin())
    <x-nav-dropdown>
      <x-slot name="name"><i class="fas fa-user text-xs mr-1"></i> Usuarios</x-slot>
      <x-slot name="trigger">Usuarios</x-slot>
      <a class="py-1" href="/adminusers">Todos</a>
      <a class="my-1 py-1" href="/adminstudents">Alumnos</a>
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

    <a class="mt-3 py-1" href="/adminalliance">Alianzas</a>

    <x-nav-dropdown>
      <x-slot name="name"><i class="fas fa-notes-medical mr-1"></i>Medilink</x-slot>
      <x-slot name="trigger">medelink</x-slot>
      <a class="py-1" href="/userml">Usuarios</a>
      <a class="my-1 py-1" href="/medilink/payments">Payments</a>
      <a class="my-1 py-1" href="/medilink/actions">Actions</a>
      <a class="my-1 py-1" href="/medilink/appointments">Appointments</a>
      <a class="my-1 py-1" href="/medilink/treatments">Treatments</a>
    </x-nav-dropdown>

    <x-nav-dropdown>
      <x-slot name="name"><i class="fas fa-notes-medical mr-1"></i>Haas</x-slot>
      <x-slot name="trigger">haas</x-slot>
      <a class="py-1" href="/admin/nutrition">Nutrición</a>
      <a class="my-1 py-1" href="#">Kinesiologia</a>
      <a class="my-1 py-1" href="#">Deporte</a>
    </x-nav-dropdown>

{{--     <x-nav-dropdown>
      <x-slot name="name">Example</x-slot>
      <x-slot name="trigger">example</x-slot>
      <a class="py-1" href="#">Link #1</a>
      <a class="my-1 py-1" href="#">Link #2</a>
      <a class="my-1 py-1" href="#">Link #3</a>
    </x-nav-dropdown> --}}

    <x-nav-dropdown>
      <x-slot name="name">Encuestas</x-slot>
      <x-slot name="trigger">encuestas</x-slot>
      <a class="py-1" href="/admin/encuesta_satisfaccion">Encuesta de Satisfacción</a>
      {{-- <a class="my-1 py-1" href="#">Link #2</a> --}}
      {{-- <a class="my-1 py-1" href="#">Link #3</a> --}}
    </x-nav-dropdown>

    <a class="mt-3 py-1" href="/adminRemuneracion">Remuneraciones</a>

  @endif

  <x-nav-dropdown>
    <x-slot name="name">Remuneración</x-slot>
    <x-slot name="trigger">encuestas</x-slot>
    <a class="py-1" href="/mesActual">Mes Actual</a>
    <a class="my-1 py-1" href="/mesVencido">Mes Vencido</a>
    <a class="my-1 py-1" href="/historial">Historial</a>
  </x-nav-dropdown>

  @if(Auth::user()->isTrainer())
    <x-nav-dropdown>
      <x-slot name="name"><i class="fas fa-calendar-alt"></i> Entrenamiento</x-slot>
      <x-slot name="trigger">training</x-slot>
      <a class="py-1" href="/trainertrainappointment">Calendario</a>
      <a class="my-1 py-1" href="/trainerbookappointment">Clases Reservadas</a>
    </x-nav-dropdown>
  @endif

</nav>
