<div class="bg-white text-sm sm:grid sm:grid-cols-1 sm:gap-4  overflow-y-scroll">
  <div class="flex flex-col">
    <a class="text-xs sm:text-lg {{ Request::is('users*') ? 'bg-primary-100 text-you-grey hover:text-white' : 'hover:text-you-grey hover:bg-primary-100 text-primary-500' }} px-4 py-2 sm:py-4 border-b" href="/users">
      Perfil
    </a>
    <!-- <a class="text-xs sm:text-lg {{ Request::is('calendar') ? 'bg-primary-100 text-you-grey hover:text-white' : 'hover:text-you-grey hover:bg-primary-100 text-primary-500' }} px-4 py-2 sm:py-4 border-b" href="/calendar">
      Tu Agenda
    </a> -->
    <a class="text-xs sm:text-lg {{ Request::is('nutrition') ? 'bg-primary-100 text-you-grey hover:text-white' : 'hover:text-you-grey hover:bg-primary-100 text-primary-500' }} px-4 py-2 sm:py-4 border-b" href="/nutrition">
      Nutrición
    </a>
    @if (Auth::user()->isStudent())
    <a class="text-xs sm:text-lg {{ Request::is('healthy') ? 'bg-primary-100 text-you-grey hover:text-white' : 'hover:text-you-grey hover:bg-primary-100 text-primary-500' }} px-4 py-2 sm:py-4" href="/students">
      Reserva de Entrenamiento
    @endif
    </a>
  </div>
</div>
