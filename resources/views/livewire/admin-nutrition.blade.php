<div class="m-4">
  <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-cloak>
    <div class="md:grid md:grid-cols-4 md:gap-6">
      <div class="mb-3 mt-5 md:mt-0 md:col-span-3">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-6">  <label for="user" class="block text-sm font-medium text-gray-700">Usuario</label>  <input type="text" name="user" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="searchTerm" placeholder="Rut Nombre Apellidos">
                  </div>
                  @if($users && $users->count() > 0)<ul class="border border-gray-200 rounded overflow-hidden shadow-md col-span-6">    @foreach($users as $user)      <li wire:click="selectUser({{$user->id}})" class="px-4 py-2 bg-white  hover:bg-primary-100 border-b last:border-none border-gray-200 transition-all duration-300 ease-in-out">{{$user->rut}} {{$user->name}} {{$user->lastnames}}</li>    @endforeach</ul>
                  @endif

                  @if($user)<div class="col-span-6 sm:col-span-6">{{$user->rut}} {{$user->name}} {{$user->lastnames}} {{\Carbon\Carbon::parse($user->birthday)->diff(\Carbon\Carbon::now())->format('%y años')}}</div>
                  @endif

                  <x-admin.input class="col-span-6 sm:col-span-6" type="date" name="fecha" readonly="edit" >Fecha</x-admin.input>


                  <div class="mb-3 col-span-6 sm:col-span-2">
                    <x-label for="Sexo" :value="__('Sexo')" />
                        <select wire:model= 'sexo' class="form-select w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-primary-100 focus:ring focus:ring-primary-100 focus:ring-opacity-50">
                              <option>Seleccione el sexo</option>
                              <option value='f'>Femenino</option>
                              <option value='m'>Masculino</option>
                        </select>
                  </div>

                  <div class="mb-3 col-span-6 sm:col-span-2 ">
                    <x-label for="Depo/Recrea (D/R)" :value="__('Deporte/Recreacional')" />
                        <label class = "md-3">
                          <input type="radio" wire:model= 'habito' name="habito" value ='D'>
                          D
                        </label>

                        <label class = "ml-3">
                          <input type="radio" wire:model= 'habito' name="habito" value ='R'>
                          R
                        </label>
                  </div>


                  <div class="col-span-6 sm:col-span-6">
                    <label for="deporte_seleccionado" class="block text-sm font-medium text-gray-700">Deporte</label>
                    <select wire:model= 'deporte_seleccionado' class="form-select w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-primary-100 focus:ring focus:ring-primary-100 focus:ring-opacity-50">
                        @foreach(App\Models\NutritionSport::where('gender','=',$sexo)->get() as $deporte)
                          <option value = {{$deporte->descripcion}}>{{$deporte->descripcion}}</option>
                        @endforeach
                    </select>
                  </div>

                  <p class="col-span-6 sm:col-span-6 font-bold">Datos Basicos</p>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="peso" readonly="edit">Peso</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="talla_parado" readonly="edit">Talla Parado</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="talla_sentado" readonly="edit">Talla Sentado</x-admin.input>

                  <p class="col-span-6 sm:col-span-6 font-bold">Diametros (cm)</p>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="biacromial" readonly="edit">Biacromial</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="t_transverso" readonly="edit">Tóras Transverso</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="t_antero_posterior" readonly="edit">Tórax Antero-Posterior</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="bi_iliocrestideo" readonly="edit">Bi-iliocestídeo</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="humeral" readonly="edit">Humeral</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="femoral" readonly="edit">Femoral</x-admin.input>

                  <p class="col-span-6 sm:col-span-6 font-bold">Perimetros (cm)</p>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="cabeza" readonly="edit">Cabeza</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="brazo_relajado" readonly="edit">Brazo Relajado</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="brazo_flexionado" readonly="edit">Brazo Flexionado</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="antebrazo_maximo" readonly="edit">Antebrazo Máximo</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="t_mesoesternal" readonly="edit">Tórax-Mesoesternal</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="cintura" readonly="edit">Cintura (mínima)</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="cadera" readonly="edit">Cadera</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="muslo_maximo" readonly="edit">Muslo (máxima)</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="muslo_medio" readonly="edit">Muslo (medial)</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="pierna_cm" readonly="edit">Pantorrilla</x-admin.input>

                  <p class="col-span-6 sm:col-span-6 font-bold">Pliegues Cutaneos (mm)</p>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="triceps" readonly="edit">Tríceps</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="subescapular" readonly="edit">Subescapular</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="biceps" readonly="edit">Bíceps</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="cresta_iliaca" readonly="edit">Cresta iliaca</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="supraespinal" readonly="edit">Supraespinal</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="abdominal" readonly="edit">Abdominal</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="muslo_medial" readonly="edit">Muslo Medial</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="pierna_mm" readonly="edit">Pantorrilla</x-admin.input>
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" wire:click='nutrionCreate()'>
                Cargar Información
              </p>

              <a href= "{{route('livewire.admin-nutrition')}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer">
                Generar PDF
              </a>
            </div>
      </div>
    </div>

    @if($this->showAntropometria)
    <div class="rounded-b-lg h-full p-3 md:col-span-1">
      <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
        <thead>
          <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
            <th class="text-center py-2 min-w-4/8 w-6/12">Masa</th>
            <th colspan="2" class="text-center py-2 min-w-4/8 w-6/12 ">valores</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">Adiposa</td>
            <td class="text-center">{{round($M_adiposa_kg, 2)}} kg</td>
            <td class="text-center">{{round($M_adiposa_porc, 1)}}%  </td>
          </tr>

          <tr>
            <td class="text-center">Muscular</td>
            <td class="text-center">{{round($M_muscular_kg, 2)}} kg</td>
            <td class="text-center">{{round($M_muscular_porc, 1)}}%</td>
          </tr>

          <tr>
            <td class="text-center">Osea</td>
            <td class="text-center">{{round($M_osea_kg, 2)}} kg</td>
            <td class="text-center">{{round($M_osea_porc, 1)}}%</td>
          </tr>
        </tbody>
      </table>
      <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
        <thead>
          <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
            <th class="text-center py-2 min-w-4/8 w-6/12">Indices</th>
            <th class="text-center py-2 min-w-4/8 w-6/12 "></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">Músculo/Óseo:</td>
            <td class="text-center">-</td>
          </tr>

          <tr>
            <td class="text-center">Adiposo/Muscular</td>
            <td class="text-center">-</td>
          </tr>

          <tr>
            <td class="text-center">Masa corporal</td>
            <td class="text-center">{{$indice_masa_corporal}} Kg/m2</td>
          </tr>
        </tbody>
      </table>
      <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
        <thead>
          <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
            <th class="text-center py-2 min-w-4/8 w-6/12">Somatotipos</th>
            <th class="text-center py-2 min-w-4/8 w-6/12 ">valor</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">Endomorfo</td>
            <td class="text-center">{{round($somatotipo_Endo, 1)}}</td>
          </tr>

          <tr>
            <td class="text-center">Mesomorfo</td>
            <td class="text-center">{{round($somatotipo_Meso, 1)}}</td>
          </tr>

          <tr>
            <td class="text-center">Ectomorfo</td>
            <td class="text-center">{{round($somatotipo_Ecto, 1)}}</td>
          </tr>
        </tbody>
      </table>
      <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
        <thead>
          <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
            <th class="text-center py-2 min-w-4/8 w-6/12">Composición corporal</th>
            <th class="text-center py-2 min-w-4/8 w-6/12 ">valor</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">Sumatoria 6 plieges</td>
            <td class="text-center">{{round($sumatoria_6_plieges, 1)}} mm</td>
          </tr>
        </tbody>
      </table>
    </div>
    @else
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Analisís de Nutrición</h3>
        <p class="mt-1 text-sm text-gray-600">
          Panel para cargar información nutricional de paciente
        </p>
        <p class="mt-1 text-sm text-gray-600">
        Fecha de los planes

      </p>
        <ul>
          @if($user)
            @foreach($user->nutrition()->get() as $plan)
              <li>{{Carbon\Carbon::parse($plan->fecha)->format('d-m-Y')}}</li>
            @endforeach
          @endif
        </ul>
      </div>
    </div>
      </div>
    @endif

    <div class="mb-3 mt-5 md:mt-0 md:col-span-3">
      <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <x-admin.input class="col-span-3 sm:col-span-2" type="number" name="Talla_cm" readonly="edit">Talla_cm</x-admin.input>
            <x-admin.input class="col-span-3 sm:col-span-2" type="number" name="S6_pliegues" readonly="edit">S6_pliegues</x-admin.input>
            <x-admin.input class="col-span-3 sm:col-span-2" type="number" name="Masa_Adiposa" readonly="edit">Masa Adiposa</x-admin.input>
          </div>
        </div>
      </div>
      @if($this->showMasaAdiposa)
        <div>
          <p>Z-adiposa: {{round($Z_Adiposa_show, 3)}}</p>
          <p>Kg adiposa: {{round($Kg_adiposa_show, 1)}}</p>
          <p>M adiposa a bajar: {{round($adiposa_bajar_show, 0)}}</p>
        </div>
      @endif
      <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
        <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" wire:click='masaIdealCalculate()'>
          Calcular
        </p>
      </div>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-3">
      <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <x-admin.input class="col-span-3 sm:col-span-2" type="number" name="M_osea" readonly="edit">M ósea Kg</x-admin.input>
            <x-admin.input class="col-span-3 sm:col-span-2" type="number" name="Indice_MO" readonly="edit">obj. Índice M/O</x-admin.input>
            <x-admin.input class="col-span-3 sm:col-span-2" type="number" name="M_muscular" readonly="edit">M musc actual Kg</x-admin.input>
          </div>
        </div>
      </div>
      @if($this->showMasaMuscular)
        <div>
          <p>M muscular Kg {{round($M_muscular_show, 1)}}</p>
          <p>M musc a aumentar: {{round($M_muscular_aumentar_show, 1)}}</p>
        </div>
      @endif
      <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
        <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" wire:click='masaIdealMuscular()'>
          Calcular
        </p>
      </div>
    </div>

</div>
<x-flash-message></x-flash-message>
</div>
