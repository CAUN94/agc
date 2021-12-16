<x-landing.layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-auto fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nombre')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            {{-- Lastnames --}}
            <div class="mt-4">
                <x-label for="lastnames" :value="__('Apellidos')" />

                <x-input id="lastnames" class="block mt-1 w-full" type="text" name="lastnames" :value="old('lastnames')" required autofocus />
            </div>

            {{-- Rut --}}
            <div class="mt-4">
                <x-label for="rut" :value="__('Rut sin puntos y con guión')" x-model="rut" />
                <span x-text="rut">
                <x-input-rut id="rut" class="block mt-1 w-full" type="text" name="rut" :value="old('rut')" required autofocus/>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Gender -->
            <div class="mt-4">
                <x-label for="gender" :value="__('Género')" />
                <select id="gender" name="gender" class="form-select block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-primary-100 focus:ring focus:ring-primary-100 focus:ring-opacity-50">
                  <option value="m" {{old("gender") == 'm'  ? 'selected' : ''}}>Masculino</option>
                  <option value="f" {{old("gender") == 'f'  ? 'selected' : ''}}>Femenino</option>
                  <option value="n" {{old("gender") == 'n'  ? 'selected' : ''}}>No Especifica</option>
              </select>
            </div>

            {{-- Phone --}}
            <div class="mt-4">
                <x-label for="phone" :value="__('Celular')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <div class="mt-4">
                <x-label for="birthday" :value="__('Fecha de Nacimiento')" />

                <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Clave')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar Clave')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Ya registrado?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrarme') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-landing.layout>
