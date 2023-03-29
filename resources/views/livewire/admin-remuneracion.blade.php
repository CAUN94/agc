<div x-data="{ Lista: false }">
  @if(Auth::user()->isAdmin())
      <div class="w-full overflow-x-auto gap-y-2 box-white p-3">
        <div class="mb-2 w-full flex justify-between">
            @if($weekly)
              Periodo de Semana Actual ({{$startOfWeek->format('d-m')}} al {{$endOfWeek->format('d-m')}})
            @else
              Periodo de Mes Actual ({{$startOfMonth->copy()->addday()->format('d-m')}} al {{$endOfMonth->copy()->subday()->format('d-m')}})
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
          @foreach(App\Models\Professional::where('user_id','>',0)->orderBy('description')->get() as $professional)
              <ul class="grid grid-cols-5 gap-1 py-0.5">
                  <li>
                      <a class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          {{$professional->user->fullname()}}
                      </a>
                  </li>
                  <li>
                      <a class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Prestaciones</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
                            @if($weekly)
                              {{$professional->prestaciones($startOfWeek,$endOfWeek,$professional->description)}}
                            @else
                              {{$professional->prestaciones($startOfMonth,$endOfMonth,$professional->description)}}
                            @endif
                          </span>
                      </a>
                  </li>
                  <li>
                      <a class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Abonos</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
                            @if($weekly)
                              {{$professional->abonos($startOfWeek,$endOfWeek,$professional->description)}}
                            @else
                              {{$professional->abonos($startOfMonth,$endOfMonth,$professional->description)}}
                            @endif
                          </span>
                      </a>
                  </li>
                  <li>
                      <a class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Remuneración</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
                            @if($weekly)
                              {{$professional->remuneracion($startOfWeek,$endOfWeek,$professional->description)}}
                            @else
                              {{$professional->remuneracion($startOfMonth,$endOfMonth,$professional->description)}}
                            @endif
                          </span>
                      </a>
                  </li>
                  <li>
                      <a class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-calendar" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Atenciones</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
                            @if($weekly)
                              {{$professional->monthAppointments($startOfWeek,$endOfWeek,$professional->description)}}
                            @else
                              {{$professional->monthAppointments($startOfMonth,$endOfMonth,$professional->description)}}
                            @endif
                            </span>
                      </a>
                  </li>
              </ul>
              <div>
              <button class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer bg-gray-100 hover:bg-gray-400 p-1.5 items-center mt-0.5 mb-1"
                      wire:click="show({{$professional->user->id}},{{$startOfMonth}},{{$endOfMonth}})">Mostrar lista
              </button>
            </div>
          @endforeach
        </div>

            <div class="mb-3 mt-6 w-full flex justify-between">
            Periodo del {{$expiredstartOfMonth->copy()->addday()->format('d-m')}} al {{$expiredendOfMonth->copy()->subday()->format('d-m')}}
            </div>
            @if($classShow)
            <div>
              @foreach(App\Models\Professional::where('user_id','>',0)->orderBy('description')->get() as $professional)
                  <ul class="grid grid-cols-5 gap-1 py-0.5">
                    <li>
                        <a class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            {{$professional->user->fullname()}}
                        </a>
                    </li>
                      <li>
                          <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                              <i class="fa fa-money" aria-hidden="true"></i>
                              <span class="flex-1 ml-3 whitespace-nowrap">Prestaciones</span>
                              <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->prestaciones($expiredstartOfMonth,$expiredendOfMonth,$professional->description)}}</span>
                          </a>
                      </li>
                      <li>
                          <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                              <i class="fa fa-calendar" aria-hidden="true"></i>
                              <span class="flex-1 ml-3 whitespace-nowrap">Abonos</span>
                              <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->abonos($expiredstartOfMonth,$expiredendOfMonth,$professional->description)}}</span>
                          </a>
                      </li>
                      <li>
                          <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                              <i class="fa fa-money" aria-hidden="true"></i>
                              <span class="flex-1 ml-3 whitespace-nowrap">Remuneración</span>
                              <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->remuneracion($expiredstartOfMonth,$expiredendOfMonth,$professional->description)}}</span>
                          </a>
                      </li>
                      <li>
                          <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                              <i class="fa fa-calendar" aria-hidden="true"></i>
                              <span class="flex-1 ml-3 whitespace-nowrap">Atenciones</span>
                              <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->monthAppointments($expiredstartOfMonth,$expiredendOfMonth,$professional->description)}}</span>
                          </a>
                      </li>
                  </ul>
                  <div>
                  <button class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer bg-gray-100 hover:bg-gray-400 p-1.5 items-center mt-0.5 mb-1"
                          wire:click="show({{$professional->user->id}})">Mostrar lista
                  </button>
                </div>

              @endforeach
            </div>
            @endif
          </div>
          @if(!$classShow and !is_null($lista_id))
            <button class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer bg-white hover:bg-gray-400 p-1.5 items-center mt-2"
                    wire:click="close()">Ocultar Lista
            </button>
            <div class="flex flex-col lg:flex-row gap-3">
            <div class="w-full lg:w-3/4 flex flex-col overflow-x-auto gap-y-2">
              <div class="w-full overflow-x-auto gap-y-2 box-white p-3 mt-3">
                <div class="w-full font-medium flex justify-between ml-3">
                  Atendidos
                </div>
                <div class="rounded-b-lg h-full p-3">
                  <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
                    <thead>
                      <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
                        <th class="text-center py-2 min-w-1/8 w-1/12">id</th>
                        <th class="text-center py-2 min-w-1/8 w-2/12">Fecha</th>
                        <th class="py-2 min-w-1/8 w-3/12 ">Paciente</th>
                        <th class="text-center py-2 min-w-1/8 w-2/12">Alianza</th>
                        <th class="text-center py-2 min-w-1/8 w-2/12">Prestación</th>
                        <th class="text-center py-2 min-w-1/8 w-1/12">Abono</th>
                        <th class="text-center py-2 min-w-1/8 w-2/12">Remuneración</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($appointments as $Appointment)
                    <tr>
                      <td class="text-center">
                         {{$Appointment->id}}
                      </td>
                      <td class="text-center">
                          {{Carbon\Carbon::parse($Appointment->Fecha_Realizacion)->format('d-m-Y')}}
                      </td>
                      <td class="text-left">
                         {{$Appointment->Nombre}} {{$Appointment->Apellido}}
                      </td>
                      <td class="text-center">
                        @if(!empty($treatment->Convenio))
                        <li class="list-none">{{$treatment->Convenio}}</li>
                        @else
                        <li class="list-none">Sin Convenio</li>
                        @endif
                      </td>
                      <td class="text-center">
                        {{Helper::moneda_chilena($Appointment->Precio_Prestacion)}}
                      </td>
                      <td class="text-center">
                        {{Helper::moneda_chilena($Appointment->Abono)}}
                      </td>
                      <td class="text-center">
                        {{Helper::moneda_chilena(ceil(($Appointment->Precio_Prestacion*$coff->coff)/100))}}
                      </td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                  <div class='py-3'>{{$appointments->links()}}</div>
                </div>
              </div>
            </div>
            <div class="w-full lg:w-1/4 flex flex-col overflow-x-auto gap-y-2">
              <div class="w-full overflow-x-auto rounded-lg gap-y-2 bg-gray-200 p-3 mt-3">
                <div class="w-full font-medium flex justify-between ml-3">Información Adicional</div>
                <div class = "box-white mt-1.5">
                  <span>Tasa de Ocupación</span>
                  <span class= "ml-12">{{$professional->tasaOcupacion($expiredstartOfMonth,$expiredendOfMonth,$lista_id)}}%</span>
                </div>
                <div class = "box-white mt-1.5">
                  <span>Prom. Prestaciones</span>
                  <span class="ml-9">{{$professional->Prom_prestaciones($expiredstartOfMonth,$expiredendOfMonth,$lista_id)}}</span>
                </div>
                <div class = "box-white mt-1.5">
                  <span>Prom. Remuneraciones</span>
                  <span class="ml-2">{{$professional->Prom_remuneracion($expiredstartOfMonth,$expiredendOfMonth,$lista_id)}}</span>
                </div>
              </div>
            </div>
          </div>

          <div class="flex flex-col lg:flex-row gap-2 mt-2">
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

                                                          @foreach(App\Models\Professional::join('appointment_mls', 'professionals.description', '=', 'appointment_mls.Profesional')->where('professionals.description',$lista_id)->where('Estado','Atendido')->whereBetween('Fecha',[$expiredstartOfMonth, $expiredendOfMonth])->where('Fecha',$date->format('Y-m-d'))->orderby('Hora_inicio', 'ASC')->get() as $professionalAppointment)
                                                             <div
                                                                  wire:click="showAppointment({{$professionalAppointment->id}})"
                                                                  @if($professionalAppointment->Estado=='Atendido')
                                                                      @php $color = 'green'; @endphp
                                                                  @endif

                                                                  class="box-class border-{{$color}}-200 text-{{$color}}-800 bg-{{$color}}-100 cursor-pointer
                                                                  ">
                                                                  <p class="text-xs lg:text-sm lg:truncate leading-tight">{{Carbon\Carbon::parse($professionalAppointment->Hora_inicio)->format('H:00')}} {{$professionalAppointment->Nombre_paciente}}</p>
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
                      <div x-show="$wire.classShowAppointment" x-cloak>
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
                                  <li class="list-none">-</li>
                              </dd>
                            </div>
                          </dl>
                          <dl>
                            <div class="train-class-resume">
                              <dt class="text-sm font-medium text-gray-500">
                                Remuneración
                              </dt>
                              <dd class="train-class-resume-text">
                                  <li class="list-none">{{App\Models\ActionMl::where('Tratamiento_Nr',$treatment->Tratamiento_Nr)->value('Precio_Prestacion')*$coff->coff/100}}</li>
                              </dd>
                            </div>
                          </dl>
                      </div>
                      @endif
                  </div>
              </div>
          </div>
          </div>
          @endif
    @endif
</div>
