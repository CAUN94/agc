<div x-data="{ calendar: false }">
    <div class="w-full overflow-x-auto gap-y-2 box-white p-3">
        <div class="mb-2 w-full flex justify-between">
            Periodo del {{$expiredstartOfMonth->format('d-m')}} al {{$expiredendOfMonth->format('d-m')}}
        </div>
        <div>
          @foreach(App\Models\Professional::where('user_id','=',$selectedProfessional_id)->get() as $professional)
              <ul class="grid grid-cols-3 gap-1">
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Prestaciones</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-sm font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->prestaciones($expiredstartOfMonth,$expiredendOfMonth,$professional->user->fullname())}}</span>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Remuneración</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->remuneracion($expiredstartOfMonth,$expiredendOfMonth,$professional->user->fullname())}}</span>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-calendar" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Atenciones Realizadas</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->monthAppointments($expiredstartOfMonth,$expiredendOfMonth,$professional->user->fullname())}}</span>
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
                    <input class="form-check-input appearance-none h-3 w-3 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" id="{{ $professional->user->id }}" value={{ $professional->user->id }} wire:model="selectedProfessional.{{ $professional->user->id }}">
                    <label class="form-check-label inline-block text-gray-800 text-sm break-words" for="{{ $professional->user->id }}">
                        {{ $professional->user->id }}
                    </label>
              </div>
            @endforeach
        </div>
        </form>
    </div>

    <div class="flex flex-col lg:flex-row gap-3 mt-2">
      <div class="w-full lg:w-3/4 flex flex-col overflow-x-auto gap-y-2">
        <div class="w-full overflow-x-auto gap-y-2 box-white p-3 mt-3">
          <div class="w-full font-medium flex justify-between ml-3">
            Atendidos
          </div>
          <div class="rounded-b-lg h-full p-3">
            <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
              <thead>
                <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
                  <th class="text-center py-2 min-w-1/8 w-2/12">Fecha</th>
                  <th class="py-2 min-w-1/8 w-3/12 ">Paciente</th>
                  <th class="text-center py-2 min-w-1/8 w-2/12">Alianza</th>
                  <th class="text-center py-2 min-w-1/8 w-1/12">Embajador</th>
                  <th class="text-center py-2 min-w-1/8 w-2/12">Prestación</th>
                  <th class="text-center py-2 min-w-1/8 w-2/12">Remuneración</th>
                </tr>
              </thead>
              <tbody>
              @foreach($appointments as $Appointment)
              <tr>
                <td class="text-center">
                    {{$Appointment->Fecha_Realizacion}}
                </td>
                <td class="text-left">
                   {{$Appointment->Nombre}} {{$Appointment->Apellido}}
                </td>
                <td class="text-center">
                  {{$Appointment->Convenio}}
                </td>
                <td class="text-center">
                  -
                </td>
                <td class="text-center">
                  {{$Appointment->Categoria_Nombre}}
                </td>
                <td class="text-center">
                  {{$Appointment->Total}}
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
        <div class="w-full overflow-x-auto gap-y-2 box-white p-3 mt-3">
          <div class="w-full font-medium flex justify-between ml-3">Información Adicional</div>
          @foreach(App\Models\Professional::where('user_id','=',$selectedProfessional_id)->get() as $professional)
          <div class = "w-full box-white mt-1.5">
            <span>Tasa de Ocupación</span>
            <span class= "ml-12">{{$professional->tasaOcupacion($expiredstartOfMonth,$expiredendOfMonth,$professional->user->fullname())}}%</span>
          </div>
          <div class = "w-full box-white mt-1.5">
            <span>Prom. Prestaciones</span>
            <span class="ml-9">{{$professional->Prom_prestaciones($expiredstartOfMonth,$expiredendOfMonth,$professional->user->fullname())}}</span>
          </div>
          <div class = "w-full box-white mt-1.5">
            <span>Prom. Remuneraciones</span>
            <span class="ml-2">{{$professional->Prom_remuneracion($expiredstartOfMonth,$expiredendOfMonth,$professional->user->fullname())}}</span>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <button x-on:click="calendar = !calendar">Ver calendario</button>
    <div x-show="calendar">
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
                                                  @foreach(App\Models\AppointmentMl::where('Estado','Atendido')->whereBetween('Fecha',[$expiredstartOfMonth, $expiredendOfMonth])->where('Fecha',$date->format('Y-m-d'))->whereIN('Profesional',$selectedProfessional)->orderby('Hora_inicio', 'ASC')->get() as $professionalAppointment)
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
      </div>
    <!--
    <div class="w-full overflow-x-auto gap-y-2 box-white p-3 mt-2">
        <form wire:change="updateSelectedProfessional">
        <div class="grid grid-cols-3 gap-1">
            @foreach(App\Models\Professional::where('id','>',0)->get() as $professional)
                <div class="flex">
                    <input class="form-check-input appearance-none h-3 w-3 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" id="{{ $professional->user->id }}" value={{ $professional->user->id }} wire:model="selectedProfessional.{{ $professional->user->id }}">
                    <label class="form-check-label inline-block text-gray-800 text-sm break-words" for="{{ $professional->user->id }}">
                        {{ $professional->user->fullname() }}
                    </label>
              </div>
            @endforeach
        </div>
        </form>
    </div>
  -->
</div>