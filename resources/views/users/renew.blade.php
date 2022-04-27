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
        <div x-data="{ openModal: false }">
            @if(Auth::user()->isStudent())
            <label class="text-lg mb-2 text-centermt-1.5 block font-medium text-sm text-gray-700">
                Renovar {{Auth::user()->student()->training->planComplete()}}
            </label>
            <span class="block w-full text-center items-center px-4 py-2 bg-primary-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-900 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring ring-primary-100 disabled:opacity-25 transition ease-in-out duration-150" x-on:click="openModal = ! openModal">Renovar Plan</span>
            <x-landing.submit-modal
              method="PUT"
              action="/students/{{Auth::user()->student()->id}}"
              :id="Auth::user()->student()->training_id"
              >
              <x-slot name="title">
                <span>Renovar plan {{Auth::user()->student()->training->plan()}}</span>
              </x-slot>
              Estas seguro de querer renovar?
              <x-slot name="important">
                El plan partira a fin de mes.
              </x-slot>
              @if(!Auth::user()->student()->training->isMonthly())
              <x-slot name="options">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                        Por cuantos meses quiere renovar su plan?
                    </label>
                    <div class="relative">
                        <select name="months" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                            @for ($i = 1; $i <= 12; $i++)
                                @if($i == 1)
                                    <option value={{$i}}>{{$i}} mes</option>
                                    @continue
                                @endif
                                <option value={{$i}}>{{$i}} meses</option>
                            @endfor
                        </select>
                    </div>
              </x-slot>
              @endif
              <x-slot name="button">
                Confirmar
              </x-slot>
        </x-landing.submit-modal>
            @else
                <x-label class="text-lg mb-2 text-center" :value="__('No estas registrado en ningun plan')" />
                <x-link class="block w-full text-center" href="/trainings">
                    {{ __('Registrarme') }}
                </x-link>
            @endif
        </div>
    </x-auth-card>
</x-landing.layout>
