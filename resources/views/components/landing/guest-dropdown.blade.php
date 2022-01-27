@guest()
<div class="relative nav-menu-link" x-data="{ dropdownUser: false}" x-cloack>
    <a class="cursor-pointer text-primary-500 hover:text-white"
        @click="dropdownUser = !dropdownUser"
        @keydown.escape="dropdownUser = false"
    >
        Ingresar
    </a>
    <ul x-show="dropdownUser"
    @click.away="dropdownUser = false"
    x-cloak
    class="drop-nav"
    x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
    >
        <li>
            <a href="/login" class="drop-link">
                <span class="drop-span">Iniciar Sesión</span>
            </a>
        </li>
        <li>
            <a href="/register" class="drop-link">
                <span class="drop-span">Registrarme</span>
            </a>
        </li>
    </ul>
</div>
@endguest
