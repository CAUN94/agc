<div class="m-4">
  <div>
    <div class="md:grid md:grid-cols-4 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Perfil de Estudiante</h3>
          <p class="mt-1 text-sm text-gray-600">
            Esta sección muesta la información base de cualquier usuario registrado en un Plan de Entrenamiento.
          </p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-3">
        <div class="shadow sm:rounded-md sm:overflow-hidden my-5">
            <div>
                <div class="bg-white shadow overflow-hidden sm:rounded-t-md">
                    <div class="flex items-center justify-between pr-5">
                      <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                          {{$name}} {{$lastnames}}
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                          Rut: {{$rut}}
                        </p>
                      </div>
                      <span class="inline-block h-16 w-16 rounded-full overflow-hidden bg-gray-100">
                        <img src="{{$profile}}" class="avatar h-16 w-16" alt="Foto">
                      </span>
                    </div>
                  <div class="border-t border-gray-200">
                    <dl>
                      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                          Email
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                          {{$email}}
                        </dd>
                      </div>
                      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                          Celular
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                          {{$phone}}
                        </dd>
                      </div>
                      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                        <div x-data="{ openModal: false }">
                            <span class="block text-center items-center bg-primary-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-900 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring ring-primary-100 disabled:opacity-25 transition ease-in-out duration-150" x-on:click="openModal = ! openModal">Renovar Plan</span>
                            <x-landing.submit-modal
                              method="PUT"
                              action="/adminstudents/{{$this->user->student()->id}}"
                              :id="$this->user->student()->training_id"
                              >
                              <x-slot name="title">
                                <span>Renovar plan {{$this->user->student()->training->plan()}}</span>
                              </x-slot>
                              Estas seguro de querer renovar?
                              <x-slot name="important">
                                El plan partira a fin de mes.
                              </x-slot>
                              @if(!$this->user->student()->training->isMonthly())
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
                        </div>
                        </dt>
                        <dd class="text-sm font-medium text-gray-500">
                          Nuevo Plan
                        </dd>
                        <dd class="text-sm font-medium text-gray-500">
                          Cargar
                        </dd>
                      </div>



                    </dl>
                  </div>
                  <hr class="my-2">
                  <livewire:students.plans params={{$userid}} />
                </div>

            </div>
        </div>
        {{-- <div class="container mx-auto mt-4">

        </div> --}}
      </div>
    </div>
  </div>
  <x-flash-message></x-flash-message>
</div>
