<div class="flex flex-col lg:flex-row gap-2">
    <div class="w-full lg:w-1/4 flex flex-col overflow-x-auto gap-y-2">
        <div class="align-middle inline-block min-w-full">
            <div x-data="{ classShow: false }" class="box-white p-4 {{Auth::user()->student->isSettled() ? "" : "border-red-500 border-2" }}">
                <div>
                <span class="block">{{Auth::user()->student->training->plan()}}</span>
                <div class="block text-xs {{Auth::user()->student->isSettled() ? "text-green-500" : "text-red-500" }}">
                        @if(Auth::user()->student->isSettled())
                            Plan activado
                        @else
                            <a href='https://padpow.com/customer/professionals/3165/payments/new' target='_blank'>
                                Pagar plan valor: {{Auth::user()->student->training->price()}}
                            </a>
                        @endif
                      </div>
                </div>
                <div class="pt-2">
                    Clases:
                    @forelse(Auth::user()->TrainBooks as $trainbook)
                        <div class="flex space-justify-between">
                        <span class="text-sm flex-grow">{{$trainbook->TrainAppointment->name}} {{$trainbook->TrainAppointment->date()}} {{$trainbook->TrainAppointment->hour}}</span>
                        <span class="text-sm text text-primary-500 hover:text-primary-900 cursor-pointer">
                            <i wire:click="unbook({{$trainbook->id}})" class="far fa-times-circle"></i>
                        </span>
                        </div>
                    @empty
                        <span class="text-xs">No hay clases reservadas</span>
                    @endforelse
                </div>
                @if(!is_null($train))
                <div x-show="$wire.classShow" x-cloak>
                    <dl>
                      <div class="pl-1 py-1 lg:py-2 lg:grid lg:grid-cols-3">
                        <dt class="text-sm font-medium text-gray-500">
                          Clase
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 lg:mt-0 col-span-3 lg:col-span-2">
                            <li class="list-none">{{$train->name}}</li>
                        </dd>
                      </div>
                    </dl>
                    <dl>
                      <div class="pl-1 py-1 lg:py-2 lg:grid lg:grid-cols-3">
                        <dt class="text-sm font-medium text-gray-500">
                          Coach
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 lg:mt-0 col-span-3 lg:col-span-2">
                            <li class="list-none">{{$train->trainer->name}} {{$train->trainer->lastnames}}</li>
                        </dd>
                      </div>
                    </dl>
                    <dl>
                      <div class="pl-1 py-1 lg:py-2 lg:grid lg:grid-cols-3">
                        <dt class="text-sm font-medium text-gray-500">
                          Fecha
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 lg:mt-0 col-span-3 lg:col-span-2">
                          <span>{{$train->date()}}</span>
                        </dd>
                      </div>
                    </dl>
                    <dl>
                      <div class="pl-1 py-1 lg:py-2 lg:grid lg:grid-cols-3">
                        <dt class="text-sm font-medium text-gray-500">
                          Hora
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 lg:mt-0 col-span-3 lg:col-span-2">
                          <span>{{$train->hour}} hrs</span>
                        </dd>
                      </div>
                    </dl>
                    <dl>
                      <div class="pl-1 py-1 lg:py-2 lg:grid lg:grid-cols-3">
                        <dt class="text-sm font-medium text-gray-500">
                          Duración
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 lg:mt-0 col-span-3 lg:col-span-2">
                          <span>{{$train->training->time_in_minutes}} minutos</span>
                        </dd>
                      </div>
                    </dl>
                    <dl>
                      <div class="pl-1 py-1 lg:py-2 lg:grid lg:grid-cols-3">
                        <dt class="text-sm font-medium text-gray-500">
                          Descripción
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 lg:mt-0 col-span-3 lg:col-span-2">
                          <span>{{$train->training->description}}</span>
                        </dd>
                      </div>
                    </dl>
                    <span class="text-lg  font-medium text-primary-500 hover:text-primary-900 cursor-pointer" wire:click="book">Reservar Clase</span>
                </div>
                @endif
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
                                    <span class="text-lg font-bold text-gray-800">{{$now->format('F')}}</span>
                                    <span class="ml-1 text-lg text-gray-600 font-normal">{{$now->format('Y')}}</span>
                                </div>
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

                            <div class="-mx-1 -mb-1">
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
                                        <div style="width: {{$width}}; height: {{$height}}" class="px-1 lg:px-4 pt-2 border-r border-b relative
                                        {{Auth::user()->student->islastday($date) ? "bg-gray-100" : "" }}
                                        {{Auth::user()->student->isStartday($date) ? "bg-gray-100" : "" }}
                                        ">
                                            <div
                                                class="inline-flex w-6 h-6 items-center justify-center text-center leading-none rounded-full transition ease-in-out duration-100 text-xs lg:text-sm
                                                {{ $date->format('Y-m-d') == date('Y-m-d') ? "bg-primary-500 text-white" : "text-gray-700" }}
                                                {{ $date->format('Y-m-d') > date('Y-m-d') ? "text-primary-500 hover:bg-primary-500 hover:text-white" : "" }}
                                                {{ $date->format('Y-m-d') < date('Y-m-d') ? "opacity-25" : "" }}
                                                ">
                                                {{$date->format('d')}}
                                            </div>
                                            @if (Auth::user()->student->islastday($date))
                                                @if(Auth::user()->student->islastday($date)->isRenew())
                                                    <span class="block sm:inline-block text-xs lg:text-sm">Fin de Plan</span>
                                                @else
                                                    <span class="box-class block sm:inline-block border-primary-200 text-xs sm:text-sm bg-primary-100 hover:bg-green-100 cursor-pointer">Renovar Plan</span>
                                                @endif
                                            @endif

                                            @if(Auth::user()->student->isStartday($date))
                                                <span class="block sm:inline-block text-xs lg:text-sm">Inicio Plan</span>
                                            @endif

                                            <div style="height: {{$heightbox}};" class="overflow-y-auto mt-1">
                                                @foreach(Auth::user()->student->training->daysCheck($date) as $trainAppointment)
                                                    <div
                                                        wire:click="show({{$trainAppointment->id}})"
                                                        class="box-class border-primary-200 text-primary-800
                                                        {{ Auth::user()->student->availableday($date) ?
                                                        "bg-green-100 hover:bg-primary-100 cursor-pointer" :
                                                        "bg-gray-100 cursor-not-allowed" }}
                                                        {{$trainAppointment->isBooking() ? "bg-primary-100" : ""}}
                                                        ">
                                                        <p class="text-xs lg:text-sm lg:truncate leading-tight">{{$trainAppointment->hour}} {{$trainAppointment->name}}</p>
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
