<div class="flex flex-col sm:flex-row sm:gap-6">
  <div class="order-2 sm:order-1 sm:w-2/3 sm:flex sm:flex-col overflow-x-auto gap-y-2">
      <div class="box-white my-2 sm:my-0 p-4">
              <div class="flex">
                  <input wire:model.debounce.300ms="search" id="search" class="w-full rounded border-gray-500 hover:border-primary-500 focus:border-primary-500 p-2" type="search" placeholder="Buscar">
                  <button class="bg-white w-auto flex justify-end items-center text-primary-500 p-2 hover:text-primary-900">
                      <i class="fas fa-search"></i>
                  </button>
              </div>
      </div>

      <div class="align-middle inline-block min-w-full">
        <div class="box-white ">
          <table class="min-w-full divide-y divide-gray-200 bg-gray-50">
          <thead>
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Planes
                </th>
                <th scope="col" class="hidden sm:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Formato</span>
                </th>
                <th scope="col" class="hidden sm:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Duración</span>
                </th>
                <th scope="col" class="hidden sm:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Clases</span>
                </th>
              </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">

              @foreach($trainings as $training)
              <tr class="hover:bg-gray-300 cursor-pointer">
                <td class="px-6 py-2 sm:py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="hidden sm:table-cell flex-shrink-0 flex-shrink-0 h-10 w-10">
                      <img class="h-10 w-10 rounded-full" src="/img/icon.png" alt="">
                    </div>
                    <div class="ml-0 sm:ml-4">
                      <div class="text-md font-medium text-gray-900">
                        <span class="text-sm sm:text-base whitespace-normal">{{$training->name}}</span>
                      </div>
                      <div class="block sm:hidden text-sm text-gray-500">
                        <span class="text-xs sm:text-sm">Formato: {{$training->format}}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="hidden  sm:table-cell px-6 py-2 sm:py-4 whitespace-nowrap">
                  <span>{{$training->format}}</span>
                </td>
                <td class="hidden sm:table-cell px-6 py-2 sm:py-4 whitespace-nowrap">
                  <div class="text-xs sm:text-sm font-medium text-gray-900">
                    {{$training->time()}}
                  </div>
                </td>
                <td class="px-6 py-2 sm:py-4 whitespace-nowrap text-right text-sm font-medium">
                  <select class="w-full h-10 pr-6 text-xs md:text-sm placeholder-gray-600 border rounded-lg appearance-none focus:shadow-outline"
                  wire:change="showPlan($event.target.value)"
                  wire:click="showPlan($event.target.value)"
                  wire:submit="showPlan($event.target.value)"
                  wire:keydowm="showPlan($event.target.value)">
                  @foreach($training->selectClass() as $class)
                    <option class="text-gray-900"
                      value="{{$class->id}}">{{$class->planClassComplete()}}</option>
                  @endforeach
                  </select>
                </td>

              </tr>
              @endforeach
          </tbody>
          </table>
        </div>
      </div>
  </div>
  <div class="order-1 sm:order-2 my-2 sm:my-0 sm:w-1/3 sm:flex sm:flex-col overflow-x-auto gap-y-2" x-data="{ openModal: false }">
    <div class="box-white p-4">
      <x-auth-validation-errors class="mb-4" :errors="$errors" />
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        @if($trainShow)
        {{$selectedTraining->plan()}}
        @else
          Selecciona un plan.
          <p class="mt-1 max-w-2xl text-sm text-gray-500">
            y su cantidad de clases
          </p>
        @endif
      </h3>

      <div class="border-t border-gray-200 mt-2" x-show="$wire.trainShow" x-cloak>
        <dl>
          <div class="pl-1 py-2 sm:py-5 grid grid-cols-3">
            <dt class="text-sm font-medium text-gray-500">
              Coach
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              @foreach($coachs as $coach)
                <li class="list-none">{{$coach}}</li>
              @endforeach
            </dd>
          </div>
        </dl>
        <dl>
          <div class="pl-1 py-2 sm:py-5 grid grid-cols-3">
            <dt class="text-sm font-medium text-gray-500">
              Clases
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <span class="block">{{$selectedTraining->planClassComplete()}}</span>
            </dd>
          </div>
        </dl>
        <dl>
          <div class="pl-1 py-2 sm:py-5 grid grid-cols-3">
            <dt class="text-sm font-medium text-gray-500">
              Duración
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <span>{{$selectedTraining->time()}}</span>
            </dd>
          </div>
        </dl>
        <dl>
          <div class="pl-1 py-2 sm:py-5 grid grid-cols-3">
            <dt class="text-sm font-medium text-gray-500">
              Valor
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <span>{{$selectedTraining->price()}}</span>
            </dd>
          </div>
        </dl>
        <dl>
          <div class="pl-1 py-2 sm:py-5 sm:grid sm:grid-cols-3">
            <dt class="text-sm font-medium text-gray-500">
              Descripción
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              <span>{{$selectedTraining->description}}</span>
            </dd>
          </div>
        </dl>
        @auth()
          <dl>
            <div class="pl-1 py-5 sm:grid sm:grid-cols-3 items-center">
              <dt class="text-sm font-medium text-gray-500">
                Inscribir Plan
              </dt>
              <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  @if(Auth::user()->isStudent())
                    @if(Auth::user()->Training->id == $selectedTraining->id)
                      <a href="/students" class="text-primary-500">Ir a Clases de Entrenamiento</a>
                    @else
                      <button class="text-white text-lg w-full bg-primary-500 hover:bg-primary-900 text-center text-sm text-gray-900 sm:mt-0 sm:col-span-2 py-2 cursor-pointer" x-on:click="openModal = ! openModal">Cambiarme a Este Plan</button>
                    @endif
                  @else
                  <button class="text-white text-lg w-full bg-primary-500 hover:bg-primary-900 text-center text-sm text-gray-900 sm:mt-0 sm:col-span-2 py-2 cursor-pointer" x-on:click="openModal = ! openModal">Inscribir</button>
                  @endif
              </dd>
              @if(Auth::user()->isStudent())
                <x-landing.submit-modal
                  method="PUT"
                  action="/students/{{Auth::user()->student->id}}"
                  :id="$selectedTraining->id"
                  >
                  <x-slot name="title">
                    <span>Cambiarme a plan {{$selectedTraining->plan()}}</span>
                  </x-slot>

                  Estas seguro de querer cambiarte?

                  <x-slot name="important">
                    El cambio de plan quedaria para el proximo periodo de pago.
                  </x-slot>
                  <x-slot name="button">
                    Confirmar
                  </x-slot>
                </x-landing.submit-modal>
              @else
                <x-landing.submit-modal
                  method="POST"
                  action="/students"
                  :id="$selectedTraining->id"
                  >

                  <x-slot name="options">

                    <x-slot name="title">
                      <span>¿Inscribirme al Plan {{$selectedTraining->plan()}}?</span>
                    </x-slot>
                    <x-label for="start_day" :value="__('Elige la fecha de inicio de tu plan de 30 días')" />
                    <x-input id="start_day" class="block mt-1 w-full"
                      type="date"
                      name="start_day"
                      :value="old('start_day')"
                      min="{{ \Carbon\Carbon::Now()->format('Y-m-d'); }}"
                      max="{{ \Carbon\Carbon::Now()->addDays(30)->format('Y-m-d'); }}"
                      required />
                  </x-slot>
                  Recibiras un mail con la información para activar tu plan al realizar el pago.
                  <x-slot name="important">
                    Información Importante
                  </x-slot>
                  <x-slot name="button">
                    Inscribir Plan
                  </x-slot>
                </x-landing.submit-modal>
              @endif
            </div>
          </dl>
        @endauth
        @guest()
        <dl>
          <div class="pl-1 py-5 sm:grid sm:grid-cols-3">
            <dt class="text-sm font-medium text-gray-500">
              Inscribir Plan
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              Para inscrbir un plan debes <a class="text-primary-500" href="/login">Iniciar Sesión</a> o <a class="text-primary-500" href="/register">Registrarte</a>
            </dd>
          </div>
        </dl>
        @endguest

      </div>
    </div>
  </div>
</div>
