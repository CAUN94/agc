@guest()
<div class="relative" x-data="{ dropdownUser: false}" x-cloack>
    <a class="{{ Request::is('login') ? 'selected' : '' }} {{ Request::is('register') ? 'selected' : '' }}"
        @click="dropdownUser = !dropdownUser"
        @keydown.escape="dropdownUser = false"
    >
        Ingresar
    </a>
    <ul x-show="dropdownUser"
    @click.away="dropdownUser = false"
    x-cloak
    class="drop-nav"
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
