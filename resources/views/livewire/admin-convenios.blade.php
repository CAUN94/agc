<div x-data="{ pay: false }">
<style>
	.active {
		background-color: #f2715a;
		color: white;
	}
</style>
    <div class="w-full overflow-x-auto gap-y-2 box-white p-3">
        <div class="mb-2 w-full flex justify-between font-bold text-gray-600">
            @if($weekly)
              Periodo del {{$startOfWeek->format('d-m')}} al {{$endOfWeek->format('d-m')}}
            @else
              Periodo del {{$startOfMonth->format('d-m')}} al {{$endOfMonth->format('d-m')}}
            @endif
            <div class="border rounded-lg px-1 bg-gray-100" style="padding-bottom: 3.5px;" >
                <button
                    type="button"
                    class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-white p-1 items-center"
                    wire:click="weeklyOn"
                    >
                Semanal</button>
                <div class="border-r inline-flex h-6"></div>
                <button
                    type="button"
                    class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-white p-1"
                    wire:click="weeklyOff"
                    >
                Mensual</button>
            </div>
        </div>
        <div>
              <ul class="grid sm:grid-cols-4 gap-1">
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          {{Auth::user()->fullname()}}
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <i class="fa fa-money" aria-hidden="true"></i>
                          <span class="flex-1 ml-3 whitespace-nowrap">Abonos</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
														{{Helper::moneda_chilena(ceil($appointments->sum('Abono')))}}
                          </span>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <span class="flex-1 ml-3 whitespace-nowrap">Comisión</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
														{{Helper::moneda_chilena(ceil($appointments->sum('Abono')*0.05))}}
                          </span>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                          <span class="flex-1 ml-3 whitespace-nowrap">Pacientes Derivados</span>
                          <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded dark:bg-gray-700 dark:text-gray-400">
														{{App\Models\ActionMl::Where('Convenio', 'LIKE' , '%' . Auth::user()->fullname() . '%')->where('Estado', 'Atendido')->distinct('Nombre','Apellido')->count()}}
                      </a>
                  </li>
              </ul>
        </div>
    </div>

    <div class="hidden sm:block flex flex-col lg:flex-row gap-3 mt-2">
      <div class="w-full lg:w-3/4 flex flex-col overflow-x-auto gap-y-2">
        <div class="w-full overflow-x-auto gap-y-2 box-white p-3 mt-3">
          <div class="w-full font-medium flex justify-between ml-3">
            Atendidos
          </div>
          <div class="rounded-b-lg h-full p-3">
            <table class="table-data">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Paciente</th>
                  <th>Abono</th>
                  <th>Comisión</th>
                </tr>
              </thead>
              <tbody>
              @foreach($appointments as $Appointment)
              <tr>
                <td>
                    {{Carbon\Carbon::parse($Appointment->Fecha_Realizacion)->format('d-m-Y')}}
                </td>
                <td>
                   {{$Appointment->Nombre}} {{$Appointment->Apellido}}
                </td>
                <td>
                  {{Helper::moneda_chilena(ceil($Appointment->Abono))}}
                </td>
                <td>
                  {{Helper::moneda_chilena(ceil(($Appointment->Abono*0.05)))}}
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
