<div x-data="{ pay: false }">
    <div class="w-full overflow-x-auto gap-y-2 box-white p-3">
        <div class="mb-2 w-full flex justify-between">
            @if($weekly)
              Periodo del {{$startOfWeek->format('d-m')}} al {{$endOfWeek->format('d-m')}}
            @else
              Periodo del {{$startOfMonth->format('d-m')}} al {{$endOfMonth->format('d-m')}}
            @endif
            <div class="border rounded-lg px-1" style="padding-bottom: 3.5px;" >
                <button
                    type="button"
                    class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
                    wire:click="weeklyOn"
                    >
                Semanal</button>
                <div class="border-r inline-flex h-6"></div>
                <button
                    type="button"
                    class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1"
                    wire:click="weeklyOff"
                    >
                Mensual</button>
            </div>
        </div>
        <div>
          @foreach(App\Models\Professional::where('user_id','=',$selectedProfessional_id)->get() as $professional)
              <ul class="grid grid-cols-4 gap-1">
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          {{$professional->user->fullname()}}
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Prestaciones</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-sm font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
                            @if($weekly)
                              {{$professional->prestaciones($startOfWeek,$endOfWeek,$professional->user->fullname())}}
                            @else
                              {{$professional->prestaciones($startOfMonth,$endOfMonth,$professional->user->fullname())}}
                            @endif
                          </span>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Remuneración</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
                            @if($weekly)
                              {{$professional->remuneracion($startOfWeek,$endOfWeek,$professional->user->fullname())}}
                            @else
                              {{$professional->remuneracion($startOfMonth,$endOfMonth,$professional->user->fullname())}}
                            @endif
                          </span>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-calendar" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Atenciones Realizadas</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
                            @if($weekly)
                              {{$professional->monthAppointments($startOfWeek,$endOfWeek,$professional->user->fullname())}}
                            @else
                              {{$professional->monthAppointments($startOfMonth,$endOfMonth,$professional->user->fullname())}}
                            @endif
                            </span>
                      </a>
                  </li>
              </ul>
          @endforeach
        </div>

        <button x-on:click="pay = !pay">Ver más</button>
        <div x-show="pay">
          @foreach(App\Models\Professional::where('user_id','=',$selectedProfessional_id)->get() as $professional)
              <ul class="grid grid-cols-3 gap-1">
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Promedio Remuneración Semanal</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-sm font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->Prom_remuneracion($startOfWeek,$endOfWeek,$professional->user->fullname())}}</span>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Promedio Remuneración Mensual</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->Prom_remuneracion($startOfMonth,$endOfMonth,$professional->user->fullname())}}</span>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Tasa de Ocupación</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->tasaOcupacion($startOfMonth,$endOfMonth,$professional->user->fullname())}}%</span>
                      </a>
                  </li>
              </ul>
          @endforeach
        </div>
    </div>

    <!---->
    <div class="w-full overflow-x-auto gap-y-2 box-white p-3 mt-2">
        <form wire:change="updateSelectedProfessional">
        <div class="grid grid-cols-3 gap-1">
            @foreach(App\Models\Professional::where('id','>',0)->get() as $professional)
                <div class="flex">
                    <input class="form-check-input appearance-none h-3 w-3 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" id="{{ $professional->user->id }}" value={{ $professional->user->id }} wire:model="selectedProfessional.{{ $professional->user->id }}">
                    <label class="form-check-label inline-block text-gray-800 text-sm break-words" for="{{ $professional->user->id }}">
                        {{ $professional->user->id }}
                    </label>
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
                        <span class="block">Selecciona una cita.</span>

                        <div class="modal-close cursor-pointer z-50" wire:click="close">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>
                    @if(!is_null($treatment))
                    <div x-show="$wire.classShow" x-cloak>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500">
                              Paciente
                            </dt>
                            <dd class="train-class-resume-text">
                                <li class="list-none">{{$treatment->Nombre_paciente . " " . $this->treatment->Apellidos_paciente}}</li>
                            </dd>
                          </div>
                        </dl>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500">
                              Convenio
                            </dt>
                            <dd class="train-class-resume-text">
                                @if(!is_null($treatment->Convenio))
                                <li class="list-none">{{$treatment->Convenio}}</li>
                                @else
                                <li class="list-none">Sin Convenio</li>
                                @endif
                            </dd>
                          </div>
                        </dl>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500">
                              Prestación
                            </dt>
                            <dd class="train-class-resume-text">
                                <li class="list-none">{{App\Models\ActionMl::where('Tratamiento_Nr',$treatment->Tratamiento_Nr)->value('Categoria_Nombre')}}</li>
                            </dd>
                          </div>
                        </dl>
                        <dl>
                          <div class="train-class-resume">
                            <dt class="text-sm font-medium text-gray-500">
                              Remuneración
                            </dt>
                            <dd class="train-class-resume-text">
                                <li class="list-none">{{App\Models\ActionMl::where('Tratamiento_Nr',$treatment->Tratamiento_Nr)->value('Total')}}</li>
                            </dd>
                          </div>
                        </dl>

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
                        <div class="container mx-auto">
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="flex items-center justify-between py-2 px-6">
                                  @if($this->weekly)
                                    <div>
                                        <span class="text-lg font-bold text-gray-800">{{$now->format('F')}}</span>
                                        <span class="ml-1 text-lg text-gray-600 font-normal">Semana Actual</span>
                                    </div>
                                  @else
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
                                  @endif

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
                                                      @foreach(App\Models\AppointmentMl::where('Estado','Atendido')->whereBetween('Fecha',[$startOfMonth, $endOfMonth])->where('Fecha',$date->format('Y-m-d'))->whereIN('Profesional',$selectedProfessional)->orderby('Hora_inicio', 'ASC')->get() as $professionalAppointment)
                                                          <div
                                                              wire:click="show({{$professionalAppointment->id}})"
                                                              @if($professionalAppointment->Estado=='Atendido')
                                                                  @php $color = 'green'; @endphp
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
