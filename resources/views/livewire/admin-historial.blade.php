<div class="flex flex-row gap-3 m-2 mt-4">
  <div class="flex-grow admin-box box-white">
    <div class="font-bold rounded-t-lg p-3 h-16 flex items-center justify-between">
      <p>Periodos Anteriores</p>
    </div>
    <div class="rounded-b-lg h-full p-3">
      <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
        <thead>
          <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
            <th class="text-center py-2 min-w-1/8 w-auto">Periodo</th>
            <th class="text-center py-2 min-w-1/8 w-1/8">Remuneración</th>
            <th class="text-center py-2 min-w-1/8 w-1/8">Atenciones</th>
            <th class="text-center py-2 min-w-1/8 w-1/8">Tasa de Ocupacion</th>
          </tr>
        </thead>
        <tbody>
        <!---->

        @foreach(App\Models\Professional::where('user_id','=',Auth::user()->id)->get() as $professional)
          @foreach($periods as $periodo)
        <tr class=>
          <td class=>
            <div class="flex flex-col items-center justify-between">
              <span>{{$periodo->format('d-m-Y')}} - {{Carbon\Carbon::parse($this->endPeriod($periodo))->format('d-m-Y')}}</span>
            </div>
          </td>
          <td>
            <div class="flex flex-col items-center justify-between">
               <span class="text-sm">{{$professional->remuneracion($periodo,$this->endPeriod($periodo),$professional->description)}}</span>
            </div>
          </td>
          <td>
            <div class="flex flex-col items-center justify-between">
              <span class="text-sm">{{$professional->monthAppointments($periodo,$this->endPeriod($periodo),$professional->description)}}</span>
            </div>
          </td>
          <td>
            <div class="flex flex-col items-center justify-between">
              <span class="text-sm">{{$professional->tasaOcupacion($periodo,$this->endPeriod($periodo),$professional->description)}}%</span>
            </div>
          </td>
        </tr>
          @endforeach
          @endforeach
        <!---->
        </tbody>
      </table>
      <div></div>
    </div>
  </div>
</div>
</div>
