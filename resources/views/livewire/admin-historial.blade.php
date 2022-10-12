<div class="flex flex-row gap-3 m-2 mt-4">
  <div class="flex-grow admin-box">
    <div class="font-bold rounded-t-lg p-3 h-16 flex items-center justify-between">
      <p>Periodos Anteriores</p>
    </div>
    <div class="rounded-b-lg h-full p-3">
      <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
        <thead>
          <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
            <th class="text-center py-2 min-w-1/8 w-auto">Periodo</th>
            <th class="text-center py-2 min-w-1/8 w-1/8">Prestaciones</th>
            <th class="text-center py-2 min-w-1/8 w-1/8">Remuneración</th>
            <th class="text-center py-2 min-w-1/8 w-1/8">Atenciones</th>
            <th class="text-center py-2 min-w-1/8 w-1/8">Tasa de Ocupacion</th>
          </tr>
        </thead>
        <tbody>
        <!---->
          @foreach($periods as $periodo)
        <tr class=>

          <td class=>
            <div class="flex flex-col items-center justify-between">
              <span>{{$periodo->format('Y-m-d')}}</span>
            </div>
          </td>
          <td>
             <div class="flex flex-col items-center justify-between">
              <span class="text-sm">-</span>
            </div>
          </td>
          <td>
            <div class="flex flex-col items-center justify-between">
               <span class="text-sm">-</span>
            </div>
          </td>
          <td>
            <div class="flex flex-col items-center justify-between">
              <span class="text-sm">-</span>
            </div>
          </td>
          <td>
            <div class="flex flex-col items-center justify-between">
              <span class="text-sm">-</span>
            </div>
          </td>

        </tr>
          @endforeach
        <!---->
        </tbody>
      </table>
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
  </div>
</div>
</div>
