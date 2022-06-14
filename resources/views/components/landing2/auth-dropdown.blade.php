@auth()
<div class="relative nav-menu-link" x-data="{ dropdownUser: false}" x-cloack>
    <a class="cursor-pointer text-primary-500 hover:text-white"
        @click="dropdownUser = !dropdownUser"
        @keydown.escape="dropdownUser = false"
    >
        {{auth()->user()->name}}
    </a>
    <ul x-show="dropdownUser"
    @click.away="dropdownUser = false"
    x-cloak
    class="drop-nav"
    x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
    >
        <li>
            <a href="/users" class="drop-link block text-sm text-gray-700">
                <span class="drop-span">Perfil</span>
            </a>
        </li>
        @if (Auth::user()->isStudent())
        <li>
            <a href="/students" class="drop-link block text-sm text-gray-700">
                <span class="drop-span">Reserva de Clases</span>
            </a>
        </li>
        @endif
        @if (Auth::user()->hasIntranet())
        <li>
            <a href="/adminpage" class="drop-link block text-sm text-gray-700">
                <span class="drop-span">Admin</span>
            </a>
        </li>
        @endif
        <li>
            <a href="/strava/show" class="drop-link">
                <span class="drop-span">Estadísticas Deportivas</span>
            </a>
        </li>
        <li>
            <a href="/strava/auth" class="drop-link">
                <span class="drop-span">Vincula tu Strava</span>
            </a>
        </li>
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <li>
            <a href="/logout" class="drop-link"
                onclick="event.preventDefault();
                this.closest('form').submit();">
                <span class="drop-span">Cerrar Sesión</span>
            </a>
        </li>
        </form>
    </ul>
</div>
@endauth
