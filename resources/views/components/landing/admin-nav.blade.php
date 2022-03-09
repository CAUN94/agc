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
      <x-slot name="name"><i class="fas fa-calendar-alt"></i> Entrenamiento</x-slot>
      <x-slot name="trigger">Clases</x-slot>
      <a class="py-1" href="/adminclass">Programas</a>
      <a class="my-1 py-1" href="/admintrainappointment">Calendario</a>
    </x-nav-dropdown>

    <x-nav-dropdown>
      <x-slot name="name">Example</x-slot>
      <x-slot name="trigger">example</x-slot>
      <a class="py-1" href="#">Link #1</a>
      <a class="my-1 py-1" href="#">Link #2</a>
      <a class="my-1 py-1" href="#">Link #3</a>
    </x-nav-dropdown>

    <a class="mt-3" href="#">Scrapping</a>

  @endif

  @if(Auth::user()->isTrainer())
    <a class="mt-3" href="/trainertrainappointment"><i class="fas fa-calendar-alt"></i> Entrenamiento</a>
  @endif

</nav>
