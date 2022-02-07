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
