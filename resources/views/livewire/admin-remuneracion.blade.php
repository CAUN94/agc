
<div x-data="{ Lista: false }">
  <style>
    .active {
      background-color: #f2715a;
      color: white;
    }
  </style>
  {{-- Alpine js show on click --}}
  @if(Auth::user()->isAdmin())
    <div class="w-full overflow-x-auto box-white p-3">
      <div>
        @foreach(App\Models\Professional::where('user_id','>',0)->orderBy('description')->get() as $professional)
          
        @endforeach
      </div>


      <div class="w-full flex justify-between">
        Periodo del {{$expiredstartOfMonth->copy()->addday()->format('d-m')}} al {{$expiredendOfMonth->copy()->subday()->format('d-m')}}
        <div class="border rounded-lg px-1" style="padding-top: 2px;">
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
      
      @if($classShow)
        <div>
          @foreach(App\Models\Professional::where('user_id','>',0)->orderBy('description')->get() as $professional)
            <ul class="grid grid-cols-5 gap-1 py-0.5">
              <li>
                  <a class="h-full flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                      {{$professional->user->fullname()}}
                  </a>
              </li>
              <li>
                  <a href="#" class="h-full flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                      <i class="fa fa-money" aria-hidden="true"></i>
                      <span class="flex-1 ml-3 whitespace-nowrap">Prestaciones</span>
                      <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->prestaciones($expiredstartOfMonth,$expiredendOfMonth,$professional->description)}}</span>
                  </a>
              </li>
              <li>
                  <a href="#" class="h-full flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                      <span class="flex-1 ml-3 whitespace-nowrap">Abonos</span>
                      <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->abonos($expiredstartOfMonth,$expiredendOfMonth,$professional->description)}}</span>
                  </a>
              </li>
              <li>
                  <a href="#" class="h-full flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                      <i class="fa fa-money" aria-hidden="true"></i>
                      <span class="flex-1 ml-3 whitespace-nowrap">Remuneración</span>
                      <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">{{$professional->remuneracion($expiredstartOfMonth,$expiredendOfMonth,$professional->description)}}</span>
                  </a>
              </li>
              <li>
                  <a href="#" class="h-full flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
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
              <button class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer bg-gray-100 hover:bg-gray-400 p-1.5 items-center mt-0.5 mb-1"
                    wire:click="exportToExcel({{$professional->user->id}})">Descargar Excel
              </button>
            </div>

          @endforeach
        </div>
      @endif
    </div>
    @if(!$classShow and !is_null($lista_id))
      <button class="border border-black leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer bg-white hover:bg-gray-400 p-1.5 items-center mt-2"
              wire:click="close()">Ocultar Lista
      </button>
      <button class="border border-black leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer bg-white hover:bg-gray-400 p-1.5 items-center mt-2"
              wire:click="exportToExcel({{$this->professionalid}})">Descargar Excel
      </button>
      <div class="flex flex-col lg:flex-row gap-3">
        <div class="w-full lg:w-3/4 flex flex-col overflow-x-auto gap-y-2">
          <div class="w-full overflow-x-auto gap-y-2 box-white p-3 mt-3">
            <div class="w-full font-medium flex justify-between ml-3">
              Atendidos de {{App\Models\Professional::where('user_id',$this->professionalid)->value('Description')}} (Coef {{App\Models\Professional::where('user_id',$this->professionalid)->value('coeff')}})
            </div>
            <div class="rounded-b-lg h-full p-3">
              <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6" id="myTable">
                <thead>
                  <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
                    <th class="text-center py-2 min-w-1/8 w-1/12">id</th>
                    <th class="text-center py-2 min-w-1/8 w-2/12">Fecha</th>
                    <th class="py-2 min-w-1/8 w-3/12 ">Paciente</th>
                    <th class="text-center py-2 min-w-1/8 w-2/12">Alianza</th>
                    <th class="text-center py-2 min-w-1/8 w-2/12">Prestación</th>
                    <th class="text-center py-2 min-w-1/8 w-1/12">Abono</th>
                    <th class="text-center py-2 min-w-1/8 w-2/12">Remuneración</th>
                    <!-- <th class="text-center py-2 min-w-1/8 w-2/12"></th> -->
                  </tr>
                </thead>
                <tbody>
                  @foreach($appointments as $appointment)
                    <tr class="">
                      <td class="text-center @if(is_null($appointment->Evolution)) bg-yellow-100 @elseif($appointment->Report == 1) bg-red-300 @endif">
                          {{$appointment->id}}
                      </td>
                      <td class="text-center @if(is_null($appointment->Evolution)) bg-yellow-100 @elseif($appointment->Report == 1) bg-red-300 @endif">
                          {{Carbon\Carbon::parse($appointment->Fecha_Realizacion)->format('d-m-Y')}}
                      </td>
                      <td class="text-left @if(is_null($appointment->Evolution)) bg-yellow-100 @elseif($appointment->Report == 1) bg-red-300 @endif">
                          {{$appointment->Nombre}} {{$appointment->Apellido}}
                      </td>
                      <td class="text-center @if(is_null($appointment->Evolution)) bg-yellow-100 @elseif($appointment->Report == 1) bg-red-300 @endif">
                        @if (!empty($appointment->appointments()->first()) )
                          @if(!is_null($appointment->appointments()->first()->user->alliance()))
                          {{$appointment->appointments()->first()->user->alliance()->name}}
                          @endif
                        @else
                          Sin Convenio
                        @endif
                      </td>
                      <td class="text-center">
                        <div x-data="{ editing: false, newTP: '{{ $appointment->TP }}' }">
                          <span x-show="!editing" @click="editing = true" class="cursor-pointer">
                              {{ number_format($appointment->TP, 0, ',', '.') }}
                          </span>
                          <input
                              x-show="editing"
                              x-model="newTP"
                              @keydown.enter="editing = false; $wire.updateTP({{ $appointment->id }}, newTP)"
                              @keydown.escape="editing = false"
                              @click.away="editing = false"
                              type="number"
                              class="w-full border rounded px-2 py-1"
                          />
                      </div>
                    </td>
                      <td class="text-center @if(is_null($appointment->Evolution)) bg-yellow-100 @elseif($appointment->Report == 1) bg-red-300 @endif">
                        <div x-data="{ editing: false }">
                          <span x-show="!editing" @click="editing = true">
                              {{ number_format($appointment->TA, 0, ',', '.') }}
                          </span>
                          <input
                              x-show="editing"
                              x-model="newTA"
                              @keydown.enter="editing = false; $wire.updateTA({{ $appointment->id }}, newTA)"
                              @click.away="editing = false"
                              type="number"
                              class="w-full"
                          />
                      </div>
                      </td>
                      <td class="text-center @if(is_null($appointment->Evolution)) bg-yellow-100 @elseif($appointment->Report == 1) bg-red-300 @endif">
                        {{Helper::moneda_chilena(ceil(($appointment->TP*$coff->coff)/100))}}
                      </td>
                      <!-- <td class="text-center @if(is_null($appointment->Evolution)) bg-yellow-100 @elseif($appointment->Report == 1) bg-red-300 @endif">
                        <p class="border border-black shadow-sm text-sm font-medium rounded-md text-center bg-red-300 hover:bg-red-400 focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" wire:click='report({{$appointment->id}})'>Report</p>
                      </td> -->
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <script>
                $(document).ready( function () {
                    $('#myTable').DataTable();

                } );
              </script>
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
                              @if(is_null(App\Models\User::where('rut',App\Models\AppointmentMl::where('Tratamiento_Nr',$appointment->Tratamiento_Nr)->first()->Rut_Paciente)->first()))
                                {{App\Models\User::where('rut',App\Models\AppointmentMl::where('Tratamiento_Nr',$appointment->Tratamiento_Nr)->first()->Rut_Paciente)->first()->alliance()->name}}
                              @else
                                Sin Convenio2
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
  @if($classShow)
  <div class="w-full lg:w-3/4 flex flex-col overflow-x-auto gap-y-2">
    <div class="w-full overflow-x-auto gap-y-2 box-white p-3 mt-3">
      <div class="w-full font-medium flex justify-between ml-3">
        Tabla No Evolucionados
      </div>
  <div class="rounded-b-lg h-full p-3">
    <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6" id="myTable">
      <thead>
        <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
          <th class="text-center py-2 min-w-1/8 w-1/12">id</th>
          <th class="text-center py-2 min-w-1/8 w-2/12">Fecha</th>
          <th class="py-2 min-w-1/8 w-3/12 ">Paciente</th>
          <th class="text-center py-2 min-w-1/8 w-2/12">Nombre</th>
          <th class="text-center py-2 min-w-1/8 w-2/12">Profesional</th>
        </tr>
      </thead>
      <tbody>
        @foreach(App\Models\ActionMl::where('Evolution',null)->where('Fecha_Realizacion','>',$this->expiredstartOfMonth->format('Y-m-d'))
        ->where('Fecha_Realizacion','<',$this->expiredendOfMonth->format('Y-m-d'))->groupBy('Tratamiento_Nr')
                                ->select('*','Tratamiento_Nr', DB::raw('SUM(Precio_Prestacion) as TP'), DB::raw('SUM(Abono) as TA'))
                                ->orderby('Fecha_Realizacion', 'DESC')->get() as $appointment)
          <tr class="">
            <td class="text-left">
                {{$appointment->id}}
            </td>
            <td class="text-left">
                {{Carbon\Carbon::parse($appointment->Fecha_Realizacion)->format('d-m-Y')}}
            </td>
            <td class="text-left">
                {{$appointment->Nombre}} {{$appointment->Apellido}}
            </td>
            <td class="text-left">
              {{$appointment->Categoria_Nombre}}
          </td>
          <td class="text-left">
            {{$appointment->Profesional}}
        </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <script>
      $(document).ready( function () {
          $('#myTable').DataTable();

      } );
    </script>
  </div>
  </div>
  </div>

  <div class="w-full lg:w-3/4 flex flex-col overflow-x-auto gap-y-2">
    <div class="w-full overflow-x-auto gap-y-2 box-white p-3 mt-3">
      <div class="w-full font-medium flex justify-between ml-3">
        Tabla de Atenciones Reportadas
      </div>
  <div class="rounded-b-lg h-full p-3">
    <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6" id="myTable">
      <thead>
        <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
          <th class="text-center py-2 min-w-1/8 w-1/12">id</th>
          <th class="text-center py-2 min-w-1/8 w-2/12">Fecha</th>
          <th class="py-2 min-w-1/8 w-3/12 ">Paciente</th>
          <th class="text-center py-2 min-w-1/8 w-2/12">Nombre</th>
          <th class="text-center py-2 min-w-1/8 w-2/12">Profesional</th>
        </tr>
      </thead>
      <tbody>
        @foreach(App\Models\ActionMl::where('Report',1)->where('Fecha_Realizacion','>',$this->expiredstartOfMonth->format('Y-m-d'))
        ->where('Fecha_Realizacion','<',$this->expiredendOfMonth->format('Y-m-d'))->groupBy('Tratamiento_Nr')
                                ->select('*','Tratamiento_Nr', DB::raw('SUM(Precio_Prestacion) as TP'), DB::raw('SUM(Abono) as TA'))
                                ->orderby('Fecha_Realizacion', 'DESC')->get() as $appointment)
          <tr class="">
            <td class="text-left">
                {{$appointment->id}}
            </td>
            <td class="text-left">
                {{Carbon\Carbon::parse($appointment->Fecha_Realizacion)->format('d-m-Y')}}
            </td>
            <td class="text-left">
                {{$appointment->Nombre}} {{$appointment->Apellido}}
            </td>
            <td class="text-left">
              {{$appointment->Categoria_Nombre}}
          </td>
          <td class="text-left">
            {{$appointment->Profesional}}
        </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      } );
    </script>
  </div>
  </div>
  </div>
  @endif
</div>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
