<x-landing.layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-auto fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('change.password') }}">
            @csrf
            <div class="mt-4">
                <x-label for="password" :value="__('Clave Actual')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="current_password"
                                required autocomplete="current_password" />
            </div>

            <div class="mt-4">
                <x-label for="new_password" :value="__('Nueva Clave')" />

                <x-input id="new_password" class="block mt-1 w-full"
                                type="password"
                                name="new_password"
                                required autocomplete="current-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="new_confirm_password" :value="__('Confirmar Nueva Clave')" />

                <x-input id="new_confirm_password" class="block mt-1 w-full"
                                type="password"
                                name="new_confirm_password" required
                                autocomplete="current-password"
                                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="/users">
                    {{ __('Volver?') }}
                </a>
                <x-button class="ml-4">
                    {{ __('Cambiar Clave') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-landing.layout>
