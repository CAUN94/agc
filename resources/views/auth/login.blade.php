<x-landing.layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-auto fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        @if(session()->has('primary'))
        <div>
            Hola, como ya te has atendido con nosotros para entrar a nuestra plataforma solo debes poner tu rut y usarlo como clave, la primera vez que ingreses por tu seguridad tendrás que cambiarla.
        </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <x-label for="rut" :value="__('Rut')" />

                <x-input-rut id="rut" class="block mt-1 w-full" type="text" name="rut" :value="old('rut')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Clave')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-primary-900 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-100 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recordar') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="text-sm text-gray-600 hover:text-primary-500" href="{{ route('register') }}">
                    {{ __('Registrarme') }}
                </a>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-primary-500" href="{{ route('password.request') }}">
                        {{ __('Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Ingresar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-landing.layout>
