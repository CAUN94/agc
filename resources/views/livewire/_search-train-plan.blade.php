<div class="flex gap-6" x-data="{ actualPlan: '' ,id: '', openModal: false, trainshow:false, plan: 'Selecciona un plan.', planclass:'', price: '', coachs: '', time: '', price: '', description: '' }">
  <div class="w-2/3 flex flex-col overflow-x-auto gap-y-2">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg p-4">
              <div class="flex">
                  <input wire:model.debounce.300ms="search" id="search" class="w-full rounded border-gray-500 hover:border-primary-500 focus:border-primary-500 p-2" type="search" placeholder="Buscar">
                  <button class="bg-white w-auto flex justify-end items-center text-primary-500 p-2 hover:text-primary-900">
                      <i class="fas fa-search"></i>
                  </button>
              </div>
      </div>

      <div class="align-middle inline-block min-w-full">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Plan
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Clases por Semana
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Duración
                </th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Ver más</span>
                </th>
              </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
              @foreach($trainings as $training)
              <tr class="hover:bg-gray-300 cursor-pointer"
              x-on:click="trainshow = true ; id = '{{$training->id}}'; plan = '{{$training->name}} {{$training->format}}'; price = '{{$training->price()}}'; planclass = '{{$training->class}} clase{{$training->plural()}} a la semana'; time = '{{$training->time_in_minutes}} minutos'; price = '{{$training->price()}}'; coachs = ['Catalina Hernandez', 'Francisco Guzman'] ;description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'"
              >
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <img class="h-10 w-10 rounded-full" src="/img/icon.png" alt="">
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        {{$training->name}}
                      </div>
                      <div class="text-sm text-gray-500">
                        Formato: {{$training->format}}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{$training->class}} clase{{$training->plural()}}</div>
                  <div class="text-sm text-gray-500">a la semana</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{$training->time_in_minutes}} minutos</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button class="text-primary-500 hover:text-primary-900">Ver más</button>
                </td>
              </tr>
              @endforeach
          </tbody>
          </table>
        </div>
      </div>
  </div>
  <div class="w-1/3 flex flex-col overflow-x-auto gap-y-2">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg p-4">
      <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="plan"></h3>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">
        Has click en <span class="text-primary-500">Ver más</span> para obtener mayor información.
      </p>
      <div class="border-t border-gray-200 mt-2" x-show="trainshow" x-cloak>
        <dl>
          <div class="pl-1 py-5 sm:grid sm:grid-cols-3">
            <dt class="text-sm font-medium text-gray-500">
              Coach
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <template x-for="coach in coachs">
                <li class="list-none" x-text="coach"></li>
              </template>
            </dd>
          </div>
        </dl>
        <dl>
          <div class="pl-1 py-5 sm:grid sm:grid-cols-3">
            <dt class="text-sm font-medium text-gray-500">
              Clases
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <span x-text="planclass"></span>
            </dd>
          </div>
        </dl>
        <dl>
          <div class="pl-1 py-5 sm:grid sm:grid-cols-3">
            <dt class="text-sm font-medium text-gray-500">
              Duración
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <span x-text="time"></span>
            </dd>
          </div>
        </dl>
        <dl>
          <div class="pl-1 py-5 sm:grid sm:grid-cols-3">
            <dt class="text-sm font-medium text-gray-500">
              Precio
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <span x-text="price"></span>
            </dd>
          </div>
        </dl>
        <dl>
          <div class="pl-1 py-5 sm:grid sm:grid-cols-3">
            <dt class="text-sm font-medium text-gray-500">
              Descripción
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <span x-text="description"></span>
            </dd>
          </div>
        </dl>
        @auth()
        <dl>
          <div class="pl-1 py-5 sm:grid sm:grid-cols-3">
            <dt class="text-sm font-medium text-gray-500 py-2">
              Inscribir Plan
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <button class="text-white text-lg w-full bg-primary-500 hover:bg-primary-900 text-center mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 py-2 cursor-pointer" x-on:click="openModal = ! openModal">Inscribir</button>
              {{-- @endif --}}
            </dd>
            <x-landing.submit-modal>
              <x-slot name="title">
                <span x-text="plan"></span>
              </x-slot>
              Muchas gracias por tu inscripción.
            </x-landing.submit-modal>
          </div>
        </dl>
        @endauth()
        @guest()
        <dl>
          <div class="pl-1 py-5 sm:grid sm:grid-cols-3">
            <dt class="text-sm font-medium text-gray-500">
              Inscribir Plan
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              Para inscrbir un plan debes estar <a class="text-primary-500" href="/register">registrado</a>
            </dd>
          </div>
        </dl>
        @endguest()

      </div>
    </div>


  </div>
</div>
