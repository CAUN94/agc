<div x-data="{ Lista: false }">
      <div class="w-full overflow-x-auto gap-y-2 box-white p-3">
        <div class="mb-2 w-full flex justify-between">
            @if($weekly)
              Periodo de Semana Actual ({{$startOfWeek->format('d-m')}} al {{$endOfWeek->format('d-m')}})
            @else
              Periodo de Mes Actual ({{$startOfMonth->format('d-m')}} al {{$endOfMonth->format('d-m')}})
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
          @foreach(App\Models\Professional::where('user_id','>',0)->get() as $professional)
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
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-sm font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
                            @if($weekly)
                              ${{$professional->prestaciones($startOfWeek,$endOfWeek,$professional->description)}}
                            @else
                              ${{$professional->prestaciones($startOfMonth,$endOfMonth,$professional->description)}}
                            @endif
                          </span>
                      </a>
                  </li>
                  <li>
                      <a class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Abonos</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-sm font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
                            @if($weekly)
                              ${{$professional->abonos($startOfWeek,$endOfWeek,$professional->description)}}
                            @else
                              ${{$professional->abonos($startOfMonth,$endOfMonth,$professional->description)}}
                            @endif
                          </span>
                      </a>
                  </li>
                  <li>
                      <a class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-100 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Remuneración</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-sm font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
                            @if($weekly)
                              ${{$professional->remuneracion($startOfWeek,$endOfWeek,$professional->description)}}
                            @else
                              ${{$professional->remuneracion($startOfMonth,$endOfMonth,$professional->description)}}
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
          @endforeach
        </div>

            <div class="mb-3 mt-6 w-full flex justify-between">
                Periodo de Mes vencido ({{$expiredstartOfMonth->format('d-m')}} al {{$expiredendOfMonth->format('d-m')}})

            </div>
            @if($classShow)
            <div>
              @foreach(App\Models\Professional::where('user_id','>',0)->get() as $professional)
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
                              <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-sm font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">${{$professional->prestaciones($expiredstartOfMonth,$expiredendOfMonth,$professional->description)}}</span>
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
                              <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-sm font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">${{$professional->remuneracion($expiredstartOfMonth,$expiredendOfMonth,$professional->description)}}</span>
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
                  <button wire:click="show({{$professional->user->id}})">Mostrar lista</button>
                </div>

              @endforeach
            </div>
            @endif
          </div>
          @if(!$classShow and !is_null($lista_id))
            <button wire:click="close()">Ocultar Lista</button>
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
                        <th class="text-center py-2 min-w-1/8 w-3/12">Alianza</th>
                        <th class="text-center py-2 min-w-1/8 w-2/12">Prestación</th>
                        <th class="text-center py-2 min-w-1/8 w-2/12">Remuneración</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($appointments as $Appointment)
                    <tr>
                      <td class="text-center">
                          {{Carbon\Carbon::parse($Appointment->Fecha_Realizacion)->format('Y-m-d')}}
                      </td>
                      <td class="text-left">
                         {{$Appointment->Nombre}} {{$Appointment->Apellido}}
                      </td>
                      <td class="text-center">
                        {{$Appointment->Convenio}}
                      </td>
                      <td class="text-center">
                        {{$Appointment->Categoria_Nombre}}
                      </td>
                      <td class="text-center">
                        {{$Appointment->Precio_restacion}}
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
          @endif
          </div>
        </div>
</div>
