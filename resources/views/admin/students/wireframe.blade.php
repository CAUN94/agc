<x-landing.layout>
    <div class="container mx-auto mt-4">
        <div class="flex flex-col lg:flex-row gap-2">
            <div class="w-full lg:w-1/4 flex flex-col overflow-x-auto gap-y-2">
                <div class="align-middle inline-block min-w-full">

                    <div x-data="{ classShow: false }" class="box-white p-3">
                        <div>
                        <span class="block">Hola</span>
                        <div class="block text-xs">
                                Hola
                              </div>
                        </div>
                        <div x-cloak>
                            <dl>
                              <div class="train-class-resume">
                                <dt class="text-sm font-medium text-gray-500">
                                  Clase
                                </dt>
                                <dd class="train-class-resume-text">
                                    <li class="list-none">Hola</li>
                                </dd>
                              </div>
                            </dl>
                            <dl>
                              <div class="train-class-resume">
                                <dt class="text-sm font-medium text-gray-500">
                                  Coach
                                </dt>
                                <dd class="train-class-resume-text">
                                    <li class="list-none">Hola</li>
                                </dd>
                              </div>
                            </dl>
                            <dl>
                              <div class="train-class-resume">
                                <dt class="text-sm font-medium text-gray-500">
                                  Fecha
                                </dt>
                                <dd class="train-class-resume-text">
                                  <span>Hola</span>
                                </dd>
                              </div>
                            </dl>
                            <dl>
                              <div class="train-class-resume">
                                <dt class="text-sm font-medium text-gray-500">
                                  Hora
                                </dt>
                                <dd class="train-class-resume-text">
                                  <span>Hola</span>
                                </dd>
                              </div>
                            </dl>
                            <dl>
                              <div class="train-class-resume">
                                <dt class="text-sm font-medium text-gray-500">
                                  Duración
                                </dt>
                                <dd class="train-class-resume-text">
                                  <span>Hola</span>
                                </dd>
                              </div>
                            </dl>
                            <dl>
                              <div class="train-class-resume">
                                <dt class="text-sm font-medium text-gray-500">
                                  Descripción
                                </dt>
                                <dd class="train-class-resume-text">
                                  <span>Hola</span>
                                </dd>
                              </div>
                            </dl>
                            <div class="w-full flex py-2">
                                <span class="text-lg  font-medium text-red-500">Clase Llena</span>
                            </div>

                        </div>
                        <div class="pt-2">
                            Clases:
                            <span class="text-xs">No hay clases reservadas</span>
                        </div>
                    </div>

                </div>

            </div>
            <div class="w-full flex flex-col overflow-x-auto gap-1">
              <div class="align-middle inline-block min-w-full">
                <div class="box-white">
                    <div class="bg-gray-100">
                        <div>
                            <div class="container mx-auto p-2">
                                <div class="bg-white rounded-lg shadow overflow-hidden">
                                    <div class="flex items-center justify-between py-2 px-6">
                                        <div>
                                            <span class="text-lg font-bold text-gray-800">hh</span>
                                            <span class="ml-1 text-lg text-gray-600 font-normal">hh</span>

                                        </div>
                                        {{-- <span class="ml-1 text-lg text-gray-600 font-normal">Puedes reservar {{auth()->user()->training->class}} clases al mes</span> --}}
                                        <div class="border rounded-lg px-1" style="padding-top: 2px;">
                                            <button
                                                type="button"
                                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
                                                >
                                                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                                </svg>
                                            </button>
                                            <div class="border-r inline-flex h-6"></div>
                                            <button
                                                type="button"
                                                class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1"
                                                >
                                                <svg class="h-6 w-6 text-gray-500 inline-flex leading-none"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="-mx-1 -mb-1">
                                        <div class="flex flex-wrap">
        {{--                                     @forelse($days as $day)
                                                <div style="width: {{$width}}" class="px-2 py-2">
                                                    <div
                                                        class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center">
                                                            {{$day}}
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse --}}
                                        </div>
                                        <div class="flex flex-wrap border-t border-l">
          {{--                                   @foreach($nodates as $date)
                                                <div
                                                    style="width: {{$width}}; height: {{$height}}"
                                                    class="text-center border-r border-b px-4 pt-2"
                                                ></div>
                                            @endforeach
                                            @foreach($dates as $date)
                                                <div style="width: {{$width}}; height: {{$height}}" class="px-1 lg:px-4 pt-2 border-r border-b relative
                                                {{Auth::user()->student()->islastday($date) ? "bg-gray-100" : "" }}
                                                {{Auth::user()->student()->isStartday($date) ? "bg-gray-100" : "" }}
                                                ">
                                                    <div
                                                        class="inline-flex w-6 h-6 items-center justify-center text-center leading-none rounded-full transition ease-in-out duration-100 text-xs lg:text-sm
                                                        {{ $date->format('Y-m-d') == date('Y-m-d') ? "bg-primary-500 text-white" : "text-gray-700" }}
                                                        {{ $date->format('Y-m-d') > date('Y-m-d') ? "text-primary-500 hover:bg-primary-500 hover:text-white" : "" }}
                                                        {{ $date->format('Y-m-d') < date('Y-m-d') ? "opacity-25" : "" }}
                                                        ">
                                                        {{$date->format('d')}}
                                                    </div>
                                                    @if (Auth::user()->student()->islastday($date))
                                                        @if(Auth::user()->student()->islastday($date)->isRenew())
                                                            <span class="block sm:inline-block text-xs lg:text-sm">Fin de Plan</span>
                                                        @elseif(Auth::user()->student()->isFreePlan())
                                                            <a href="/trainings" class="box-class block sm:inline-block border-primary-200 text-xs sm:text-sm bg-primary-100 hover:bg-green-100 cursor-pointer">Fin plan de prueba</a>
                                                        @else
                                                            <span class="box-class block sm:inline-block border-primary-200 text-xs sm:text-sm bg-primary-100 hover:bg-green-100 cursor-pointer" x-on:click="openModal = ! openModal">Renovar Plan</span>
                                                        @endif

                                                    @endif

                                                    @if(Auth::user()->student()->isStartday($date))
                                                        <span class="block sm:inline-block text-xs lg:text-sm">Inicio Plan</span>
                                                    @endif

                                                    <div style="height: {{$heightbox}};" class="overflow-y-auto mt-1">
                                                        @foreach(Auth::user()->student()->training->daysCheck($date) as $trainAppointment)
                                                            <div
                                                                wire:click="show({{$trainAppointment->id}})"
                                                                class="box-class border-primary-200 text-primary-800
                                                                @if($trainAppointment->isBooking())
                                                                    bg-primary-100 cursor-pointer
                                                                @elseif($trainAppointment->isComplete())
                                                                    bg-gray-100 hover:bg-gray-100 cursor-pointer
                                                                @elseif(Auth::user()->student()->availableday($date))
                                                                    bg-green-100 hover:bg-primary-100 cursor-pointer
                                                                @elseif(!Auth::user()->student()->availableday($date))
                                                                    bg-gray-100 cursor-not-allowed
                                                                @else
                                                                    bg-primary-100 cursor-pointer
                                                                @endif
                                                                ">
                                                                <p class="text-xs lg:text-sm lg:truncate leading-tight">{{$trainAppointment->hour}} {{$trainAppointment->name}}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                            @endforeach --}}
                                        </div>
                                       {{--  <x-landing.submit-modal
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
                                        </x-landing.submit-modal> --}}

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
</x-landing.layout>
