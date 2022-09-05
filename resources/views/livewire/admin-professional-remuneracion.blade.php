<div x-data="{ pay: true }">
    <div class="w-full overflow-x-auto gap-y-2 box-white p-3">
        <div class="mb-2 w-full flex justify-between">
            Periodo del {{$startOfMonth->format('d-m')}} al {{$endOfMonth->format('d-m')}}
            @if($startOfMonth == $actualstartOfMonth)
                (Mes Actual)
            @elseif($startOfMonth == $expiredstartOfMonth)
                (Mes Vencido)
            @endif
            <button x-on:click="pay = ! pay">Ver más</button>
            <div class="border rounded-lg px-1" style="padding-top: 2px;" >
                <button
                    type="button"
                    class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
                    wire:click="subPeriod"
                    >
                    <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <div class="border-r inline-flex h-6"></div>
                <button
                    type="button"
                    class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1"
                    wire:click="addPeriod"
                    >
                    <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
        <div x-show="pay">
            @foreach(App\Models\Professional::all() as $professional)
                <ul class="grid grid-cols-4 gap-1">
                    <li>
                        <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            {{$professional->user->fullname()}}
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span class="flex-1 ml-3 whitespace-nowrap">Atenciones Realizadas</span>
                            <span class="inline-flex items-center justify-center px-2 py-1 ml-3 text-sm font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <span class="flex-1 ml-3 whitespace-nowrap">Atenciones del Mes</span>
                            <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->monthAppointments($startOfMonth,$endOfMonth)}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <span class="flex-1 ml-3 whitespace-nowrap">Remuneración</span>
                            <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->remuneracion($startOfMonth,$endOfMonth)}}</span>
                        </a>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
    <div class="w-full overflow-x-auto gap-y-2 box-white p-3 mt-2">
        <form wire:change="updateSelectedProfessional">
        <div class="grid grid-cols-3 gap-1">
            @foreach(App\Models\Professional::where('id','>',0)->get() as $professional)
                <div class="flex">
                    <input class="form-check-input appearance-none h-3 w-3 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" id="{{ $professional->user->fullName() }}" value={{ $professional->user->fullName() }} wire:model="selectedProfessional.{{ $professional->user->fullName() }}">
                    <label class="form-check-label inline-block text-gray-800 text-sm break-words" for="{{ $professional->user->id }}">
                        {{ $professional->user->fullname() }}
                    </label>
              </div>
            @endforeach
        </div>
        </form>
    </div>
    <div class="w-full overflow-x-auto gap-y-2 box-white mt-2 p-3">
        <form wire:change="updateSelectedPlans">
        <div class="grid grid-cols-5 gap-1">
            @foreach(App\Models\Training::where('id','>',0)->orderby('name','desc')->get() as $training)
              <div class="flex">
                <input class="form-check-input appearance-none h-3 w-3 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" id="{{ $training->id }}" value={{ $training->id }} wire:model="selectedPlans.{{ $training->id }}">
                <label class="form-check-label inline-block text-gray-800 text-sm break-words" for="{{ $training->id }}">{{ $training->planComplete() }}</label>
              </div>
            @endforeach
        </div>
        </form>
    </div>
    <div class="flex flex-col lg:flex-row gap-2 mt-2">
        <div class="w-full lg:w-1/3 flex flex-col overflow-x-auto gap-y-2">
            <div class="align-middle inline-block min-w-full" x-data="{ classShow: false, createShow: true }">
                <div class="box-white p-3">
                    <div class="flex justify-between">
                        <span class="block">Selecciona un plan.</span>

                        <div class="modal-close cursor-pointer z-50" wire:click="close">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>
                    @if(!is_null($train))

                    <div x-show="$wire.classShow" x-cloak>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500">
                              Programa
                            </dt>
                            <dd class="train-class-resume-text">
                                <li class="list-none">{{$train->trainings()->plan()}}</li>
                            </dd>
                          </div>
                        </dl>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500">
                              Coach
                            </dt>
                            <dd class="train-class-resume-text">
                                <li class="list-none">{{$train->trainer->name}} {{$train->trainer->lastnames}}</li>
                            </dd>
                          </div>
                        </dl>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500">
                              Duración
                            </dt>
                            <dd class="train-class-resume-text">
                              <span>{{$train->trainings()->time_in_minutes}} minutos</span>
                            </dd>
                          </div>
                        </dl>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500 my-auto">
                              Nombre Clase
                            </dt>
                            <dd class="train-class-resume-text">
                              <x-admin.input class="col-span-6 sm:col-span-3" type="text" name="name" value="{{$train->name}}" readonly="edit"></x-admin.input>
                            </dd>
                          </div>
                        </dl>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500 my-auto">
                              Fecha
                            </dt>
                            <dd class="train-class-resume-text">
                              <x-admin.input class="col-span-6 sm:col-span-3" type="date" name="date" value="{{$train->date}}" readonly="edit"></x-admin.input>

                            </dd>
                          </div>
                        </dl>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500 my-auto">
                              Hora
                            </dt>
                            <dd class="train-class-resume-text">
                              <x-admin.input class="col-span-6 sm:col-span-3" type="time" name="hour" value="{{$train->hour}}" readonly="edit"></x-admin.input>

                            </dd>
                          </div>
                        </dl>
                        <div class="grid grid-cols-2 gap-1 justify-items-end">
                            <p class="inline-flex w-full justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" wire:click="trainAppointmentDelete({{$train->id}})">
                                Borrar
                            </p>
                            <p class="inline-flex w-full justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" wire:click='trainAppointmentEdit()'>
                                Modificar
                            </p>
                        </div>
                        <hr class="my-2">
                        <div class="grid">
                            @if($train->status)
                                @php $color = 'green'; @endphp
                            @else
                                @php $color = 'primary'; @endphp
                            @endif
                            <p class="inline-block text-center justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-{{$color}}-500 hover:bg-{{$color}}-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{$color}}-500 cursor-pointer" wire:click='trainAppointmentStatus()'>
                               Cambiar status de clase.
                            </p>
                        </div>

                    </div>
                    @endif
                </div>

                <div class="box-white mt-3 p-3">

                    <div class="flex justify-between">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <span class="block cursor-pointer" wire:click="openCreate">Crear Clases.</span>

                        <div class="modal-close cursor-pointer z-50" wire:click="closeCreate">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3" x-show="$wire.createShow" x-cloak>
                        <div>
                          <div class="block">
                            <select class="w-full bg-gray-200 border-gray-200 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="newAppointment" id="newAppointment" wire:model="newAppointment">
                                <option selected value="0">Elegir Plan</option>
                                @foreach($trainings_g as $training)
                                    <option value="{{$training->id}}">{{$training->name}} {{$training->format}}</option>
                                @endforeach
                                @foreach($trainings_s as $training)
                                    <option value="{{$training->id}}">{{$training->planComplete()}}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                          </div>
                          <div class="block mt-3">
                            <select class="w-full bg-gray-200 border-gray-200 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="coach" id="coach" wire:model="coach">
                                <option selected value="0">Elegir Entrenador</option>
                                @foreach($coachs as $coach)
                                    <option value="{{$coach->user->id}}">{{$coach->user->fullName()}}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                          </div>
                          <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500 my-auto">
                              Nombre Clase
                            </dt>
                            <dd class="train-class-resume-text">
                              <x-admin.input class="col-span-6 sm:col-span-3" type="text" name="newname" readonly="edit"></x-admin.input>
                            </dd>
                          </div>
                        </dl>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500 my-auto">
                              Fecha
                            </dt>
                            <dd class="train-class-resume-text">
                              <x-admin.input class="col-span-6 sm:col-span-3" type="date" name="newdate" readonly="edit"></x-admin.input>

                            </dd>
                          </div>
                        </dl>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500 my-auto">
                              Hora
                            </dt>
                            <dd class="train-class-resume-text">
                              <x-admin.input class="col-span-6 sm:col-span-3" type="time" name="newhour" readonly="edit"></x-admin.input>

                            </dd>
                          </div>
                        </dl>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500 my-auto">
                              Cupos
                            </dt>
                            <dd class="train-class-resume-text">
                              <x-admin.input class="col-span-6 sm:col-span-3" type="number" name="places" readonly="edit"></x-admin.input>
                            </dd>
                          </div>
                        </dl>
                        <div class="grid justify-items-end">
                            <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" wire:click='trainAppointmentCreate()'>
                                Crear Clase
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="w-full flex flex-col overflow-x-auto gap-1">
          <div class="align-middle inline-block min-w-full">
            <div class="box-white">
                <div class="bg-gray-100">
                    <div>
                        <div class="container mx-auto">
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="flex items-center justify-between py-2 px-6">
                                    <div>
                                        <span class="text-lg font-bold text-gray-800">{{$now->format('F')}}</span>
                                        <span class="ml-1 text-lg text-gray-600 font-normal">{{$now->format('Y')}}</span>

                                    </div>
                                    {{-- <span class="ml-1 text-lg text-gray-600 font-normal">Puedes reservar {{auth()->user()->training->class}} clases al mes</span> --}}
                                    <div class="border rounded-lg px-1" style="padding-top: 2px;">
                                        <button
                                            type="button"
                                            class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
                                            wire:click="subMonth"
                                            >
                                            <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                            </svg>
                                        </button>
                                        <div class="border-r inline-flex h-6"></div>
                                        <button
                                            type="button"
                                            class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1"
                                            wire:click="incrementMonth"
                                            >
                                            <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="-mx-1 -mb-1" x-data="{ openModal: false }">
                                    <div class="flex flex-wrap">
                                        @forelse($days as $day)
                                            <div style="width: {{$width}}" class="px-2 py-2">
                                                <div
                                                    class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center">
                                                        {{$day}}
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    <div class="flex flex-wrap border-t border-l">
                                        @foreach($nodates as $date)
                                            <div
                                                style="width: {{$width}}; height: {{$height}}"
                                                class="text-center border-r border-b px-4 pt-2"
                                            ></div>
                                        @endforeach

                                        @foreach($dates as $date)
                                            <div style="width: {{$width}}; height: {{$height}}" class="px-1 lg:px-4 pt-2 border-r border-b relative">
                                                <div
                                                    class="inline-flex w-6 h-6 items-center justify-center text-center leading-none rounded-full transition ease-in-out duration-100 text-xs lg:text-sm
                                                    {{ $date->format('Y-m-d') > date('Y-m-d') ? "text-primary-500 hover:bg-primary-500 hover:text-white" : "" }}
                                                    ">
                                                    {{$date->format('d')}}
                                                </div>
                                                <div style="height: {{$heightbox}};" class="overflow-y-auto mt-1">
                                                    {{-- @foreach(Auth::user()->student()->training->daysCheck($date) as $trainAppointment) --}}
                                                    @foreach(App\Models\AppointmentMl::where('Fecha',$date)->whereIN('id',$plans)->orderby('Hora_inicio', 'ASC')->get() as $professionalAppointment)
                                                        <div
                                                            wire:click="show({{$professionalAppointment->id}})"
                                                            @if($professionalAppointment->Estado=='Atendido' | $professionalAppointment->Estado=='Confirmado por teléfono')
                                                                @php $color = 'green'; @endphp
                                                            @else
                                                                @php $color = 'yellow'; @endphp
                                                            @endif

                                                            @if($professionalAppointment->Estado=='Anulado')
                                                                @php $color = 'red'; @endphp
                                                            @endif

                                                            class="box-class border-{{$color}}-200 text-{{$color}}-800 bg-{{$color}}-100 cursor-pointer
                                                            ">
                                                            <p class="text-xs lg:text-sm lg:truncate leading-tight">{{$professionalAppointment->Hora_inicio}} {{$professionalAppointment->Estado}}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
              </div>
            </div>
          </div>
        </div>
        <x-flash-message></x-flash-message>
    </div>
</div>
