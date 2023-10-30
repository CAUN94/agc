<div class="m-4">
  <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-cloak>
    <div class="shadow sm:rounded-md sm:overflow-hidden">
      <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
        <div class="grid grid-cols-6 gap-6">
          <div class="col-span-4 sm:col-span-4">
            <label for="user" class="block text-xl font-sm text-gray-700"><i class="fas fa-user-alt"></i> Paciente </label>
            @if($user)
              <div class="mt-2 ml-5 col-span-2 sm:col-span-2 grid grid-cols-6">
                <p class="ml-2 col-span-2 sm:col-span-2">{{$user->name}} {{$user->lastnames}}</p>
                <p class="ml-2 col-span-2 sm:col-span-2">Peso previo: {{$this->sesionPrevia($user)['peso']}}</p>
                <p class="ml-2 col-span-2 sm:col-span-2">Genero: @if($user->gender=="m") Masculino @else Femenino @endif</p>
                <p class="ml-2 col-span-2 sm:col-span-2">Última sesión: {{$this->sesionPrevia($user)['fecha']}}</p>
                <p class="ml-2 col-span-2 sm:col-span-2">Altura: {{$this->sesionPrevia($user)['altura']}}</p>
                <p class="ml-2 col-span-2 sm:col-span-2">Edad: {{$this->sesionPrevia($user)['edad']}}</p>
              </div>
            @endif
          </div>

          <div class="col-span-2 sm:col-span-2">  
            <input type="text" name="user"
                    class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md text-align-right"
                    wire:model="searchTerm" placeholder="Buscar Paciente">
                    
            @if($users && $users->count() > 0)
              <ul class="border border-gray-200 rounded overflow-hidden shadow-md col-span-3">    
                @foreach($users as $user)      
                  <li wire:click="selectUser({{$user->id}})" class="px-4 py-2 bg-white  hover:bg-primary-100 border-b last:border-none border-gray-200 transition-all duration-300 ease-in-out">
                    {{$user->rut}} {{$user->name}} {{$user->lastnames}}
                  </li>    
                @endforeach
              </ul>
            @endif
          </div>
        </div> 
      </div>
    </div>

    <div class="mt-3 shadow sm:rounded-md sm:overflow-hidden">
      <div class="px-4 bg-white space-y-1 sm:p-1">
        <div class="divide-y divide-gray-400">
          <p></p>
          <button class="ml-8 border border-gray-400 sm:p-2 hover:bg-primary-100 focus:bg-primary-100 rounded-t-lg" wire:click='selectionMenu({{1}})'>Ingresar datos</button>
          <button class="border border-gray-400 sm:p-2 hover:bg-primary-100 focus:bg-primary-100 rounded-t-lg" wire:click='selectionMenu({{2}})'>Sesiones previas</button>
          <button class="border border-gray-400 sm:p-2 hover:bg-primary-100 focus:bg-primary-100 rounded-t-lg" wire:click='selectionMenu({{3}})'>Vista PDF</button>
          <button class="border border-gray-400 sm:p-2 hover:bg-primary-100 focus:bg-primary-100 rounded-t-lg" wire:click='selectionMenu({{4}})'>Edición</button>

          <div class="">

          @if($section == 1)
          <div class="m-8">
            <div class="mb-3">
              <x-admin.input class="w-1/6" type="date" name="fecha" readonly="edit">Fecha de Examen</x-admin.input>

              <x-label for="Sexo" :value="__('Sexo')" />
                <select wire:model= 'sexo' class="form-select w-1/6 mt-1 rounded-md shadow-sm border-gray-300 focus:border-primary-100 focus:ring focus:ring-primary-100 focus:ring-opacity-50">
                  <option>Seleccione el sexo</option>
                  <option value='f'>Femenino</option>
                  <option value='m'>Masculino</option>
                </select>                       

            </div>

            <label class="font-bold">Datos Deporte</label>
            <div class="mt-2 ml-4 mb-4 grid grid-cols-9 gap-9 items-end">         
              <x-admin.input class="col-span-2 sm:col-span-2" type="text" name="deporte" readonly="edit" value="{{ old('deporte') }}">Deporte</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="deporteEndo" readonly="edit" value="{{ old('deporteEndo') }}">Endomorfo</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="deporteMeso" readonly="edit" value="{{ old('deporteMeso') }}">Mesomorfo</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="deporteEcto" readonly="edit" value="{{ old('deporteEcto') }}">Ectomorfo</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="deporteSumatoria" readonly="edit" value="{{ old('deporteSumatoria') }}">Sum. Plieges</x-admin.input>
              <div class="col-span-1 sm:col-span-1">
                <x-label for="Depo/Recrea (D/R)" :value="__('Deporte/Recreacional')" />
                  <input type="radio" wire:model= 'habito' name="habito" value ='D'>D
                  <input class="ml-2" type="radio" wire:model= 'habito' name="habito" value ='R'>R
                </div>
            </div>
            
            <label class="font-bold w-full">Datos Basicos</label>
            <div class="mt-1 ml-4 mb-4 grid grid-cols-7 gap-7 items-end">
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="peso" readonly="edit" value="{{ old('peso') }}">Peso</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="talla_parado" readonly="edit" value="{{ old('talla_parado') }}">Talla Parado</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="talla_sentado" readonly="edit" value="{{ old('talla_sentado') }}">Talla Sentado</x-admin.input>
            </div>

            <label class="font-bold w-full">Diametros (cm)</label>
            <div class="mt-1 ml-4 mb-4 grid grid-rows-2 grid-cols-7 gap-7 items-end">
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="biacromial" readonly="edit" value="{{ old('biacromial') }}">Biacromial</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="t_transverso" readonly="edit" value="{{ old('t_transverso') }}">Tórax Transverso</x-admin.input>
              <x-admin.input class="col-span-5 sm:col-span-5 w-1/5" type="number" name="t_antero_posterior" readonly="edit" value="{{ old('t_antero_posterior') }}">Tórax Antero-Posterior</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="bi_iliocrestideo" readonly="edit" value="{{ old('bi_iliocrestideo') }}">Bi-iliocrestídeo</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="humeral" readonly="edit" value="{{ old('humeral') }}">Humeral</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="femoral" readonly="edit" value="{{ old('femoral') }}">Femoral</x-admin.input>
            </div>

            <label class="font-bold w-full">Perimetros (cm)</label>
            <div class="mt-1 ml-4 mb-4 grid grid-cols-7 gap-7 items-end">
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="cabeza" readonly="edit" value="{{ old('cabeza') }}">Cabeza</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="brazo_relajado" readonly="edit" value="{{ old('brazo_relajado') }}">Brazo Relajado</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="brazo_flexionado" readonly="edit" value="{{ old('brazo_flexionado') }}">Brazo Flexionado</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="antebrazo_maximo" readonly="edit" value="{{ old('antebrazo_maximo') }}">Antebrazo Máximo</x-admin.input>
              <x-admin.input class="col-span-3 sm:col-span-3 w-1/3" type="number" name="t_mesoesternal" readonly="edit" value="{{ old('t_mesoesternal') }}">Tórax-Mesoesternal</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="cintura" readonly="edit" value="{{ old('cintura') }}">Cintura (mínima)</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="cadera" readonly="edit" value="{{ old('cadera') }}">Cadera</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="muslo_maximo" readonly="edit" value="{{ old('muslo_maximo') }}">Muslo (máxima)</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="muslo_medio" readonly="edit" value="{{ old('muslo_medio') }}">Muslo (medial)</x-admin.input>
              <x-admin.input class="col-span-3 sm:col-span-3 w-1/3" type="number" name="pierna_cm" readonly="edit" value="{{ old('pierna_cm') }}">Pantorrilla</x-admin.input>
            </div>

            <label class="font-bold w-full">Pliegues Cutaneos (mm)</label>
            <div class="mt-1 ml-4 mb-4 grid grid-cols-7 gap-7 items-end">
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="triceps" readonly="edit" value="{{ old('triceps') }}">Tríceps</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="subescapular" readonly="edit" value="{{ old('subescapular') }}">Subescapular</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="biceps" readonly="edit" value="{{ old('biceps') }}">Bíceps</x-admin.input>
              <x-admin.input class="col-span-4 sm:col-span-4 w-1/4" type="number" name="cresta_iliaca" readonly="edit" value="{{ old('cresta_iliaca') }}">Cresta iliaca</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="supraespinal" readonly="edit" value="{{ old('supraespinal') }}">Supraespinal</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="abdominal" readonly="edit" value="{{ old('abdominal') }}">Abdominal</x-admin.input>
              <x-admin.input class="col-span-1 sm:col-span-1" type="number" name="muslo_medial" readonly="edit" value="{{ old('muslo_medial') }}">Muslo Medial</x-admin.input>
              <x-admin.input class="col-span-4 sm:col-span-4 w-1/4" type="number" name="pierna_mm" readonly="edit" value="{{ old('´pierna_mm') }}">Pantorrilla</x-admin.input>
            </div>

            <div class="px-4 py-3 text-right sm:px-6">
              @if (session()->has('nutricionMensaje'))
              <p style="color: #28a745;" x-data="{ showFlash: true }" x-init="setTimeout(() => showFlash = false, 3000)" x-show.transition.duration.1000ms="showFlash" class="alert alert-success">
                  {{ session('nutricionMensaje') }}
              </p>
              @endif
              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" wire:click='nutrionCreate()'>
                Cargar Información
              </p>
            </div>         
          </div>
          @endif

          @if($section == 2)
          <div class="mb-3 mt-5 md:mt-0 md:col-span-3">
            <div class="mx-8 shadow sm:rounded-md sm:overflow-hidden">
              <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                <div class="grid grid-cols-8 items-center">
                  <h3 class="mb-5 col-span-8 sm:col-span-8 text-lg font-medium leading-6 text-gray-900">Resultados de Antrometría</h3>
                  <label for=fecha class="ml-5 col-span-5 sm:col-span-5 text-sm font-bold text-gray-700">Fecha</label>
    
                  <select class="col-span-1 sm:col-span-1 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="nutritionID" id="nutritionID" name="nutritionID">
                   @if(!is_null($user) and $user->hasNutrition())
                        <option selected>fechas</option>
                      @foreach($user->nutrition()->orderby('Fecha','desc')->get() as $control)
                        <option value="{{$control->id}}">{{$control->fecha()}}</option>
                      @endforeach
                    @else
                      <option selected>fechas</option>
                    @endif
                  </select> 
                </div>
    
    
                <div class="grid grid-cols-6 gap-6">
                @if(!is_null($viewsNutrition))
                <div class="ml-5 md:col-span-2 w-5/6">
                  <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
                    <thead class="cabecera">
                      <tr class="bg-primary-100 text-sm font-semibold tracking-wide text-left">
                        <th class="text-center py-2 min-w-4/8 w-6/12">Básicos</th>
                        <th class="text-center py-2 min-w-4/8 w-6/12 ">Datos</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">Peso (kg)</td>
                        <td class="text-center">{{$viewsNutrition->peso}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Talla (cm)</td>
                        <td class="text-center">{{$viewsNutrition->talla_parado}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Talla sentado (cm)</td>
                        <td class="text-center">{{$viewsNutrition->talla_sentado}}</td>
                      </tr>
                      <tr>
                        <td class= "bg-primary-100" style=" text-align: center; font-weight: bold;">Diametros</td>
                        <td class= "bg-primary-100"></td>
                      </tr>
                      <tr>
                        <td class="text-center">Biacromial</td>
                        <td class="text-center">{{$viewsNutrition->biacromial}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Tórax Transverso</td>
                        <td class="text-center">{{$viewsNutrition->torax_t}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Tórax Anteropost</td>
                        <td class="text-center">{{$viewsNutrition->torax_ap}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Bi-iliocrestídeo</td>
                        <td class="text-center">{{$viewsNutrition->iliocrestideo}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Humeral</td>
                        <td class="text-center">{{$viewsNutrition->humeral}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Femoral</td>
                        <td class="text-center">{{$viewsNutrition->femoral}}</td>
                      </tr>
    
                      <tr>
                        <td class= "bg-primary-100" style=" text-align: center; font-weight: bold;">Perimetros (cm)</td>
                        <td class= "bg-primary-100"></td>
                      </tr>
                      <tr>
                        <td class="text-center">Cabeza</td>
                        <td class="text-center">{{$viewsNutrition->cabeza}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Brazo relajado</td>
                        <td class="text-center">{{$viewsNutrition->brazo_r}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Brazo flexionado</td>
                        <td class="text-center">{{$viewsNutrition->brazo_flex}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Antebrazo máximo</td>
                        <td class="text-center">{{$viewsNutrition->antebrazo_max}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Tórax</td>
                        <td class="text-center">{{$viewsNutrition->torax_meso}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Cintura</td>
                        <td class="text-center">{{$viewsNutrition->cintura}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Cadera máximo</td>
                        <td class="text-center">{{$viewsNutrition->cadera}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Muslo máximo</td>
                        <td class="text-center">{{$viewsNutrition->muslo_max}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Muslo medio</td>
                        <td class="text-center">{{$viewsNutrition->muslo_medio}}</td>
                      </tr>
                      <tr>
                        <td class="text-center">Pierna</td>
                        <td class="text-center">{{$viewsNutrition->pierna_cm}}</td>
                      </tr>
    
                      <tr>
                        <td class= "bg-primary-100" style=" text-align: center; font-weight: bold;">Pliegues (mm)</td>
                        <td class= "bg-primary-100"></td>
                      </tr>
                      <tr>
                        <td class="text-center">Tríceps</td>
                        <td class="text-center">{{$viewsNutrition->tricep}}</td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Subescapular</td>
                        <td class="text-center">{{$viewsNutrition->subescapular}}</td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Bíceps</td>
                        <td class="text-center">{{$viewsNutrition->biceps}}</td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Cresta iliaca</td>
                        <td class="text-center">{{$viewsNutrition->cresta_iliaca}}</td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Supraespinal</td>
                        <td class="text-center">{{$viewsNutrition->supraespinal}}</td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Abdominal</td>
                        <td class="text-center">{{$viewsNutrition->abdominal}}</td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Muslo medial</td>
                        <td class="text-center">{{$viewsNutrition->muslo_medial}}</td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Pierna</td>
                        <td class="text-center">{{$viewsNutrition->pierna_mm}}</td>
                      </tr>
    
                    </tbody>
                  </table>
                </div>
    
                <div class="ml-5 h-full md:col-span-2">
                  <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
                    <thead cabecera>
                      <tr class="bg-primary-100 text-sm font-semibold tracking-wide text-left">
                        <th class="text-center py-2 min-w-4/8 w-6/12">Masa</th>
                        <th colspan="2" class="text-center py-2 min-w-4/8 w-6/12 ">valores</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">Adiposa</td>
                        <td class="text-center">{{round($viewsNutrition->masa_adiposa, 2)}} kg</td>
                        <td class="text-center">{{round(($viewsNutrition->masa_adiposa_porc), 2)}}%  </td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Muscular</td>
                        <td class="text-center">{{round($viewsNutrition->masa_muscular, 2)}} kg</td>
                        <td class="text-center">{{round(($viewsNutrition->masa_muscular_porc), 2)}}%</td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Osea</td>
                        <td class="text-center">{{round($viewsNutrition->masa_osea, 2)}} kg</td>
                        <td class="text-center">{{round(($viewsNutrition->masa_osea_porc), 2)}}%</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table-fixed w-full overflow-hidden shadow-lg p-6">
                    <thead>
                      <tr class="bg-primary-100 text-sm font-semibold tracking-wide text-left">
                        <th class="text-center py-2 min-w-4/8 w-6/12">Indices</th>
                        <th class="text-center py-2 min-w-4/8 w-6/12 "></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">Músculo/Óseo:</td>
                        <td class="text-center">{{round($viewsNutrition->indice_musculo, 2)}}</td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Adiposo/Muscular</td>
                        <td class="text-center">{{round($viewsNutrition->indice_adiposo, 2)}}</td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Masa corporal</td>
                        <td class="text-center">{{round($viewsNutrition->indice_corporal, 2)}} Kg/m2</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table-fixed w-full overflow-hidden shadow-lg p-6">
                    <thead>
                      <tr class="bg-primary-100 text-sm font-semibold tracking-wide text-left">
                        <th class="text-center py-2 min-w-4/8 w-6/12">Somatotipos</th>
                        <th class="text-center py-2 min-w-4/8 w-6/12 ">valor</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">Endomorfo</td>
                        <td class="text-center">{{round($viewsNutrition->endo, 1)}}</td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Mesomorfo</td>
                        <td class="text-center">{{round($viewsNutrition->meso, 1)}}</td>
                      </tr>
    
                      <tr>
                        <td class="text-center">Ectomorfo</td>
                        <td class="text-center">{{round($viewsNutrition->ecto, 1)}}</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table-fixed w-full overflow-hidden shadow-lg p-6">
                    <thead>
                      <tr class="bg-primary-100 text-sm font-semibold tracking-wide text-left">
                        <th class="text-center py-2 min-w-4/8 w-6/12">Composición corporal</th>
                        <th class="text-center py-2 min-w-4/8 w-6/12 ">valor</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">Sumatoria 6 plieges</td>
                        <td class="text-center">{{($viewsNutrition->tricep + $viewsNutrition->subescapular + $viewsNutrition->supraespinal + $viewsNutrition->abdominal + $viewsNutrition->muslo_medial +  $viewsNutrition->pierna_mm)}} mm</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table-fixed w-full overflow-hidden shadow-lg p-6">
                    <thead>
                      <tr class="bg-primary-100 text-sm font-semibold tracking-wide text-left">
                        <th class="text-center py-2 min-w-4/8 w-6/12">Información Adicional</th>
                        <th colspan="2" class="text-center py-2 min-w-4/8 w-6/12 "></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">Diferencia PE/PB</td>
                        <td class="text-center">{{$viewsNutrition->diferencia_peso}}</td>
                        <td class="text-center">{{round(($viewsNutrition->peso_estructurado - $viewsNutrition->peso)/$viewsNutrition->peso*100, 2)}}%</td>
                      </tr>
                      <tr>
                        <td class="text-center">Masa Osea Referencial</td>
                        <td class="text-center">{{App\Models\Nutrition::where('rut',$user->rut)->oldest()->value('masa_osea')}}</td>
                        <td class="text-center">{{round(($viewsNutrition->masa_osea)/$viewsNutrition->peso*100, 2)}}%</td>
                      </tr>
                    </tbody>
                  </table>
    
                    <p class="mt-4 font-bold">Comentario Nutricional</p>
                    <x-admin.input class="mb-2 col-span-6 sm:col-span-2" type="text" name="commentary" readonly="edit" value="{{ old('commentary') }}"></x-admin.input>
                    <p class="inline-flex justify-right py-2 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" wire:click='addCommentary()'>
                      Incluir Comentario
                    </p>
                    @if (session()->has('comentarioMensaje'))
                    <p style="color: #28a745;" x-data="{ showFlash: true }" x-init="setTimeout(() => showFlash = false, 3000)" x-show.transition.duration.1000ms="showFlash" class="alert alert-success">
                        {{ session('comentarioMensaje') }}
                    </p>
                    @endif
                </div>
                @endif
                </div>
              </div>
            </div>
          </div>
          @endif

          @if($section == 3)
          <div class="mx-8 shadow sm:rounded-md sm:overflow-hidden">
            <div class="grid grid-cols-8 items-center bg-gray-500">
              <h3 class="m-5 col-span-8 sm:col-span-8 text-lg font-medium leading-6 text-white">Vista PDF</h3>
            </div>
            
            @if(!is_null($viewsNutrition))
            <div>
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-1 bg-gray-500"></div>

                <div class=" ml-3 col-span-4 grid grid-cols-1 gap-1">
                  <div class="mt-16 mb-5 grid grid-cols-6 gap-6">
                    <h1 class="col-span-4 self-end place-self-end text-3xl text-right font-bold">Evaluación Nutricional</h1>
                    <img class="col-span-2 self-start place-self-center logo" src="/img/logo-black.png">
                  </div>
                  <p class="col-span-1">Nombre: {{$viewsNutrition->plan}}</p>
                  <p class="col-span-1">Fecha: {{Carbon\Carbon::parse($viewsNutrition->fecha)->format('d-m-Y')}}</p>
                  <p class="col-span-1">Edad: {{$viewsNutrition->edad}}</p>
                
                  <div class="mt-3 grid grid-cols-4 gap-3">
                    <table class="col-span-1 w-1/3 border-collapse border border-black table-fixed w-full overflow-hidden shadow-lg p-6">
                      <thead class="cabecera">
                        <tr class="bg-primary-100 text-sm font-semibold tracking-wide text-left">
                          <th class="text-center border-black py-1 min-w-4/8 w-3/4">Básicos</th>
                          <th class="border-collapse border border-black text-center border-black py-1 min-w-4/8 w-1/4 ">Datos</th>
                        </tr>
                      </thead>
                      <tbody class="border-collapse border border-black">
                        <tr>
                          <td class="border-collapse border border-black text-right">Peso (kg)</td>
                          <td class="border-collapse border border-black text-center w-1/2">{{$viewsNutrition->peso}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Talla (cm)</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->talla_parado}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Talla sentado (cm)</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->talla_sentado}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black bg-primary-100 text-center font-bold">Diametros</td>
                          <td class="border-collapse border border-black bg-primary-100"></td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Biacromial</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->biacromial}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Tórax Transverso</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->torax_t}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Tórax Anteropost</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->torax_ap}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Bi-iliocrestídeo</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->iliocrestideo}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Humeral</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->humeral}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Femoral</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->femoral}}</td>
                        </tr>
              
                        <tr>
                          <td class="border-collapse border border-black bg-primary-100 text-center font-bold">Perimetros (cm)</td>
                          <td class="border-collapse border border-black bg-primary-100"></td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Cabeza</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->cabeza}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Brazo relajado</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->brazo_r}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Brazo flexionado</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->brazo_flex}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Antebrazo máximo</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->antebrazo_max}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Tórax</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->torax_meso}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Cintura</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->cintura}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Cadera máximo</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->cadera}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Muslo máximo</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->muslo_max}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Muslo medio</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->muslo_medio}}</td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Pierna</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->pierna_cm}}</td>
                        </tr>
              
                        <tr>
                          <td class="border-collapse border border-black bg-primary-100 text-center font-bold">Pliegues (mm)</td>
                          <td class="border-collapse border border-black bg-primary-100"></td>
                        </tr>
                        <tr>
                          <td class="border-collapse border border-black text-right">Tríceps</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->tricep}}</td>
                        </tr>
              
                        <tr>
                          <td class="border-collapse border border-black text-right">Subescapular</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->subescapular}}</td>
                        </tr>
              
                        <tr>
                          <td class="border-collapse border border-black text-right">Bíceps</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->biceps}}</td>
                        </tr>
              
                        <tr>
                          <td class="border-collapse border border-black text-right">Cresta iliaca</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->cresta_iliaca}}</td>
                        </tr>
              
                        <tr>
                          <td class="border-collapse border border-black text-right">Supraespinal</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->supraespinal}}</td>
                        </tr>
              
                        <tr>
                          <td class="border-collapse border border-black text-right">Abdominal</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->abdominal}}</td>
                        </tr>
              
                        <tr>
                          <td class="border-collapse border border-black text-right">Muslo medial</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->muslo_medial}}</td>
                        </tr>
              
                        <tr>
                          <td class="border-collapse border border-black text-right">Pierna</td>
                          <td class="border-collapse border border-black text-center">{{$viewsNutrition->pierna_mm}}</td>
                        </tr>
                      </tbody>
                    </table>

                    <div class="ml-5 col-span-3 w-5/6">
                      <h4 class="mb-4 font-bold">Resultados Antropometría:</h4>
                      <table class="border-collapse border border-black table-fixed w-full overflow-hidden shadow-lg p-6">
                        <thead class="cabecera">
                          <tr class="bg-primary-100 text-sm font-semibold tracking-wide text-left">
                            <th class="border-collapse border border-black text-center  py-1 w-2/5">Composición Corporal</th>
                            <th class="border-collapse border border-black text-center  py-1 w-2/5" colspan="2">Valor</th>
                            <th class="border-collapse border border-black text-center py-1/5">Clasificación</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="border-collapse border border-black text-left">Masa Adiposa</td>
                            <td class="border-collapse border border-black text-center border-black">{{round(($viewsNutrition->masa_adiposa_porc), 2)}}%</td>
                            <td class="border-collapse border border-black text-center">{{$viewsNutrition->masa_adiposa}} kg</td>
                            <td class="border-collapse border border-black text-center">
                              @if($viewsNutrition->gender == 'f')
                                @if($viewsNutrition->habito == 'D')
                                  @if(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 21)Excelente  
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 21.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 24)Bueno
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 24.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 29)Aceptable
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 29.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 34)Elevado
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 > 34)Muy Elevado
                                  @endif
                                @else
                                  @if(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 26)Excelente
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 26.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 28)Bueno
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 28.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 30)Aceptable
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 30.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 36)Elevado
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 > 36)Muy Elevado
                                  @endif
                                @endif
                              @else
                                @if($viewsNutrition->habito == 'D')
                                  @if(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 16.5)Excelente
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 16.6  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 20)Bueno
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 20.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 26)Aceptable
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 26.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 30.6)Elevado
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 > 30.6)Muy Elevado
                                  @endif
                                @else
                                  @if(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 18.9)Excelente
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 19.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 23.1)Bueno
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 23.2  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 27.5)Aceptable
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 27.6  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 33)Elevado
                                    @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 > 33)Muy Elevado
                                  @endif
                                @endif
                              @endif
                            </td>
                          </tr>
              
                          <tr>
                            <td class="border-collapse border border-black text-left">Masa Muscular</td>
                            <td class="border-collapse border border-black text-center">{{round(($viewsNutrition->masa_muscular_porc), 2)}}%</td>
                            <td class="border-collapse border border-black text-center">{{$viewsNutrition->masa_muscular}} kg</td>
                            <td class="border-collapse border border-black text-center">
                              @if($viewsNutrition->gender == 'f')
                                @if($viewsNutrition->habito == 'D')
                                  @if(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 > 47.5)Excelente
                                  @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 43.9  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 <= 47.5)Bueno
                                  @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 36.4  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 43.9)Aceptable
                                  @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 32.7  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 36.4)Bajo
                                  @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 32.7)Muy Bajo
                                  @endif
                                @else
                                  @if(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 > 45.2)Excelente
                                    @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 41  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 <= 45.2)Bueno
                                    @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 32.3  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 41)Aceptable
                                    @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 28  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 32.3)Bajo
                                    @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 28)Muy Bajo
                                  @endif
                                @endif
                              @else
                                @if($viewsNutrition->habito == 'D')
                                  @if(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 > 54.2)Excelente
                                    @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 50.8  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 <= 54.2)Bueno
                                    @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 44  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 50.8)Aceptable
                                    @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 40.6  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 44)Bajo
                                    @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 40.6)Muy Bajo
                                  @endif
                                @else
                                  @if(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 > 50.7)Excelente
                                    @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 47.4  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 <= 50.7)Bueno
                                    @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 40.5  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 47.3)Aceptable
                                    @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 37.1  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 40.5)Bajo
                                    @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 37.1)Muy Bajo
                                  @endif
                                @endif
                              @endif
                            </td>
                          </tr>
              
                          <tr>
                            <td class="border-collapse border border-black text-left">Masa Osea</td>
                            <td class="border-collapse border border-black text-center">{{round(($viewsNutrition->masa_osea_porc), 2)}}%</td>
                            <td class="border-collapse border border-black text-center">{{$viewsNutrition->masa_osea}} kg</td>
                            <td class="border-collapse border border-black text-center">---</td>
                          </tr>
              
                          <tr>
                            <td class="border-collapse border border-black text-left">Indice músculo/óseo:</td>
                            <td class="border-collapse border border-black text-center">{{$viewsNutrition->indice_musculo}}</td>
                            <td class="border-collapse border border-black text-center">-</td>
                            <td class="border-collapse border border-black text-center">
                              @if($viewsNutrition->gender == 'f')
                                @if($viewsNutrition->indice_musculo > 4.3)Excelente
                                  @elseif($viewsNutrition->indice_musculo >= 3.91  && $viewsNutrition->indice_musculo <= 4.3)Bueno
                                  @elseif($viewsNutrition->indice_musculo >= 3.51  && $viewsNutrition->indice_musculo < 3.91)Aceptable
                                  @elseif($viewsNutrition->indice_musculo >= 3.1  && $viewsNutrition->indice_musculo < 3.51)Bajo
                                  @elseif($viewsNutrition->indice_musculo < 3.1)Muy Bajo
                                @endif
                              @else
                                @if($viewsNutrition->indice_musculo > 4.6)Excelente
                                  @elseif($viewsNutrition->indice_musculo >= 4.21  && $viewsNutrition->indice_musculo <= 4.6)Bueno
                                  @elseif($viewsNutrition->indice_musculo >= 3.81  && $viewsNutrition->indice_musculo < 4.21)Aceptable
                                  @elseif($viewsNutrition->indice_musculo >= 3.5  && $viewsNutrition->indice_musculo < 3.81)Bajo
                                  @elseif($viewsNutrition->indice_musculo < 3.5)Muy Bajo
                                @endif
                              @endif
                            </td>
                          </tr>
              
                          <tr>
                            <td class="border-collapse border border-black text-left">Indice adiposo/muscular</td>
                            <td class="border-collapse border border-black text-center">{{$viewsNutrition->indice_adiposo}}</td>
                            <td class="border-collapse border border-black text-center">-</td>
                            <td class="border-collapse border border-black text-center">
                              @if($viewsNutrition->gender == 'f')
                                @if($viewsNutrition->indice_adiposo < 0.55)Excelente
                                  @elseif($viewsNutrition->indice_adiposo >= 0.55  && $viewsNutrition->indice_adiposo < 0.7)Bueno
                                  @elseif($viewsNutrition->indice_adiposo >= 0.7  && $viewsNutrition->indice_adiposo < 0.88)Aceptable
                                  @elseif($viewsNutrition->indice_adiposo >= 0.88  && $viewsNutrition->indice_adiposo < 1.06)Elevado
                                  @elseif($viewsNutrition->indice_adiposo >= 1.06)Muy Elevado
                                @endif
                              @else
                                @if($viewsNutrition->indice_adiposo < 0.36)Excelente
                                  @elseif($viewsNutrition->indice_adiposo >= 0.36  && $viewsNutrition->indice_adiposo < 0.41)Bueno
                                  @elseif($viewsNutrition->indice_adiposo >= 0.42  && $viewsNutrition->indice_adiposo < 0.54)Aceptable
                                  @elseif($viewsNutrition->indice_adiposo >= 0.54  && $viewsNutrition->indice_adiposo < 0.65)Elevado
                                  @elseif($viewsNutrition->indice_adiposo >= 0.65)Muy Elevado
                                @endif
                              @endif
                            </td>
                          </tr>
              
                          <tr>
                            <td class="border-collapse border border-black text-left">Indice masa corporal</td>
                            <td class="border-collapse border border-black text-center">{{$viewsNutrition->indice_corporal}} Kg/m2</td>
                            <td class="border-collapse border border-black text-center">-</td>
                            <td class="border-collapse border border-black text-center">
                              @if($viewsNutrition->indice_corporal < 18.5)
                                Bajo
                              @elseif(24.9 < $viewsNutrition->indice_corporal)
                                Alto
                              @else
                                Normal
                              @endif
                            </td>
                          </tr>
              
                          <tr>
                            <td class="border-collapse border border-black text-left">Somatotipo</td>
                            <td class="border-collapse border border-black text-center">{{round($viewsNutrition->endo, 1)}} {{round($viewsNutrition->meso, 1)}} {{round($viewsNutrition->ecto, 1)}}</td>
                            <td class="border-collapse border border-black text-center">-</td>
                            <td class="border-collapse border border-black text-center">
                              @if((round($viewsNutrition->endo, 1) >= round($viewsNutrition->meso, 1)) && (round($viewsNutrition->endo, 1) >= round($viewsNutrition->ecto, 1)))Endomorfo
                                @elseif((round($viewsNutrition->meso, 1) >= round($viewsNutrition->endo, 1)) && (round($viewsNutrition->meso, 1) >= round($viewsNutrition->ecto, 1)))Mesomorfo
                                @else Ectomorfo
                              @endif
                            </td>
                          </tr>
              
                          <tr>
                            <td class="border-collapse border border-black text-left">Sumatoria 6 plieges</td>
                            <td class="border-collapse border border-black text-center">{{($viewsNutrition->tricep + $viewsNutrition->subescapular + $viewsNutrition->supraespinal + $viewsNutrition->abdominal + $viewsNutrition->muslo_medial +  $viewsNutrition->pierna_mm)}} mm</td>
                            <td class="border-collapse border border-black text-center">-</td>
                            <td class="border-collapse border border-black text-center">
                              @if (($viewsNutrition->tricep + $viewsNutrition->subescapular + $viewsNutrition->supraespinal + $viewsNutrition->abdominal + $viewsNutrition->muslo_medial +  $viewsNutrition->pierna_mm) > App\Models\NutritionSport::where('descripcion','=',$viewsNutrition->deporte)->value('sumatoria_6_plieges'))Alto
                                @else Bien
                              @endif
                            </td>
                          </tr>
              
                        </tbody>
                      </table>
                      
                      <h4 class="mb-3 mt-4 font-bold">Referencias Antropometría:</h4>
                      <table class="border-collapse border border-black table-fixed w-full overflow-hidden shadow-lg p-6">
                        <thead>
                          <tr class="bg-primary-100 text-sm font-semibold tracking-wide text-left">
                            <th class="border-collapse border border-black text-center py-1 min-w-4/8 w-4/10">Composición corporal</th>
                            <th class="border-collapse border border-black text-center w-3/10">Valor Aceptable</th>
                            <th class="border-collapse border border-black text-center w-3/10">Valor Bueno</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="border-collapse border border-black text-center text-left">Masa Adiposa</td>
                            <td class="border-collapse border border-black text-center text-center">
                              @if($viewsNutrition->gender == 'f')
                                @if($viewsNutrition->habito == 'D')24.1 - 29 % @else 28.1 - 30 % @endif
                              @else
                                @if($viewsNutrition->habito == 'D')20.1 - 26 % @else 23.2 - 27.5 % @endif
                              @endif
                            </td>
                            <td class="border-collapse border border-black text-center text-center">
                              @if($viewsNutrition->gender == 'f')
                                @if($viewsNutrition->habito == 'D')21.1 - 24 % @else 26.1 - 28 % @endif
                              @else
                                @if($viewsNutrition->habito == 'D')16.6 - 20 % @else 19 - 23.1 % @endif
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td class="border-collapse border border-black text-center text-left">Masa Muscular</td>
                            <td class="border-collapse border border-black text-center text-center">
                              @if($viewsNutrition->gender == 'f')
                                @if($viewsNutrition->habito == 'D')36.4 - 43.8 % @else 32.3 - 40.9 % @endif
                              @else
                                @if($viewsNutrition->habito == 'D')44 - 50.7 % @else 40.5 - 47.3 % @endif
                              @endif
                            </td>
                            <td class="border-collapse border border-black text-center text-center">
                              @if($viewsNutrition->gender == 'f')
                                @if($viewsNutrition->habito == 'D')42.9 - 47.5 % @else 41 - 45.2 % @endif
                              @else
                                @if($viewsNutrition->habito == 'D')50.8 - 54.2 % @else 47.4 - 50.7 % @endif
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <td class="border-collapse border border-black text-center text-left">Indice músculo/óseo</td>
                            <td class="border-collapse border border-black text-center text-center">
                              @if($viewsNutrition->gender == 'f')3.51 - 3.9 @else 3.81 - 4.2 @endif
                            </td>
                            <td class="border-collapse border border-black text-center text-center">
                              @if($viewsNutrition->gender == 'f')3.91 - 4.3 @else 4.21 - 4.6 @endif
                            </td>
                          </tr>
                          <tr>
                            <td class="border-collapse border border-black text-center text-left">Indice adiposo/musc</td>
                            <td class="border-collapse border border-black text-center text-center">
                              @if($viewsNutrition->gender == 'f')0.71 - 0.88 @else 0.42 - 0.54 @endif
                            </td>
                            <td class="border-collapse border border-black text-center text-center">
                              @if($viewsNutrition->gender == 'f')0.54 -  0.7 @else 0.36 - 0.41 @endif
                            </td>
                          </tr>
                          <tr>
                            <td class="border-collapse border border-black text-center text-left">Indice masa corporal</td>
                            <td class="border-collapse border border-black text-center text-center">18.5 - 24.9 Kg/m2</td>
                            <td class="border-collapse border border-black text-center text-center">---</td>
                          </tr>
                          <tr>
                            <td class="border-collapse border border-black text-center text-left">Sumatoria 6 pliegues</td>
                            <td class="border-collapse border border-black text-center text-center"> {{App\Models\NutritionSport::where('descripcion','=',$viewsNutrition->deporte)->value('sumatoria_6_plieges')}}</td>
                            <td class="border-collapse border border-black text-center text-center">-</td>
                          </tr>
                        </tbody>
                      </table>

                      <table class="mb-4 border-collapse border border-black mt-7 table-fixed w-3/5 overflow-hidden shadow-lg p-6">
                        <thead>
                          <tr class="bg-primary-100 text-sm font-semibold tracking-wide text-left">
                            <th class="border-collapse border border-black text-center py-1 w-3/5">Composición corporal</th>
                            <th class="border-collapse border border-black text-center w-2/5">Porcentaje</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="border-collapse border border-black text-center text-left">Masa Adiposa</td>
                            <td class="border-collapse border border-black text-center text-center">{{round(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100, 0)}}%</td>
                          </tr>
                          <tr>
                            <td class="border-collapse border border-black text-center text-left">Masa Muscular</td>
                            <td class="border-collapse border border-black text-center text-center">{{round(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100, 0)}}%</td>
                          </tr>
                          <tr>
                            <td class="border-collapse border border-black text-center text-left">Masa Ósea</td>
                            <td class="border-collapse border border-black text-center text-center">{{round(($viewsNutrition->masa_osea/$viewsNutrition->peso_estructurado)*100, 0)}}%</td>
                          </tr>
                          <tr>
                            <td class="border-collapse border border-black text-center text-left">Masa Residual</td>
                            <td class="border-collapse border border-black text-center text-center">{{round(($viewsNutrition->masa_residual/$viewsNutrition->peso_estructurado)*100, 0)}}%</td>
                          </tr>
                          <tr>
                            <td class="border-collapse border border-black text-center text-left">Masa Piel</td>
                            <td class="border-collapse border border-black text-center text-center">{{round(($viewsNutrition->masa_piel/$viewsNutrition->peso_estructurado)*100, 0)}}%</td>
                          </tr>
                        </tbody>
                      </table>

                      <div>
                        <h4 class="ml-3 font-bold">Análisis:</h4>
                        <p class="mt-3 mb-3">La masa adiposa está en
                          @if($viewsNutrition->gender == 'f')
                            @if($viewsNutrition->habito == 'D')
                              @if(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 21)rangos excelentes
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 21.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 24)buenos rangos
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 24.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 29)rangos aceptables
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 29.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 34)rangos elevados
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 > 34)rangos muy elevados
                              @endif
                            @else
                              @if(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 26)rangos excelentes
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 26.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 28)buenos rangos
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 28.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 30)rangos aceptables
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 30.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 36)rangos elevados
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 > 36)rangos muy elevados
                              @endif
                            @endif
                          @else
                            @if($viewsNutrition->habito == 'D')
                              @if(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 16.5)rangos excelentes
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 16.6  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 20)buenos rangos
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 20.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 26)rangos aceptables
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 26.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 30.6)rangos elevados
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 > 30.6)rangos muy elevados
                              @endif
                            @else
                              @if(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 18.9)rangos excelentes
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 19.1  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 23.1)buenos rangos
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 23.2  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 27.5)rangos aceptables
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 >= 27.6  && ($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 <= 33)rangos elevados
                                @elseif(($viewsNutrition->masa_adiposa/$viewsNutrition->peso_estructurado)*100 > 33)rangos muy elevados
                              @endif
                            @endif
                          @endif según porcentaje.</p>

                        <p>La masa muscular se encuentra en @if($viewsNutrition->gender == 'f')
                          @if($viewsNutrition->habito == 'D')
                            @if(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 > 47.5)rangos excelentes
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 43.9  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 <= 47.5)buenos rangos
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 36.4  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 43.9)rangos aceptables
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 32.7  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 36.4)rangos bajos
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 32.7)rangos muy bajos
                            @endif
                          @else
                            @if(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 > 45.2)rangos excelentes
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 41  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 <= 45.2)buenos rangos
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 32.3  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 41)rangos aceptables
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 28  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 32.3)rangos bajos
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 28)rangos muy bajos
                            @endif
                          @endif
                        @else
                          @if($viewsNutrition->habito == 'D')
                            @if(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 > 54.2)rangos excelentes
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 50.8  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 <= 54.2)buenos rangos
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 44  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 50.8)rangos aceptables
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 40.6  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 44)rangos bajos
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 40.6)rangos muy bajos
                            @endif
                          @else
                            @if(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 > 50.7)rangos excelentes
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 47.4  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 <= 50.7)buenos rangos
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 40.5  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 47.3)rangos aceptables
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 >= 37.1  && ($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 40.5)rangos bajos
                              @elseif(($viewsNutrition->masa_muscular/$viewsNutrition->peso_estructurado)*100 < 37.1)rangos muy bajos
                            @endif
                          @endif
                        @endif.</p>
                      </div>
                    </div>
                  
                  <div class="mt-3 col-span-4">
                      <p class="mb-3">Según su índice músculo/óseo este se encuentra @if($viewsNutrition->gender == 'f')
                        @if($viewsNutrition->indice_musculo > 4.3)excelente
                          @elseif($viewsNutrition->indice_musculo >= 3.91  && $viewsNutrition->indice_musculo <= 4.3)bueno
                          @elseif($viewsNutrition->indice_musculo >= 3.51  && $viewsNutrition->indice_musculo < 3.91)aceptable
                          @elseif($viewsNutrition->indice_musculo >= 3.1  && $viewsNutrition->indice_musculo < 3.51)bajo
                          @elseif($viewsNutrition->indice_musculo < 3.1)muy bajo
                        @endif
                      @else
                        @if($viewsNutrition->indice_musculo > 4.6)excelente
                          @elseif($viewsNutrition->indice_musculo >= 4.21  && $viewsNutrition->indice_musculo <= 4.6)bueno
                          @elseif($viewsNutrition->indice_musculo >= 3.81  && $viewsNutrition->indice_musculo < 4.21)aceptable
                          @elseif($viewsNutrition->indice_musculo >= 3.5  && $viewsNutrition->indice_musculo < 3.81)bajo
                          @elseif($viewsNutrition->indice_musculo < 3.5)muy bajo
                        @endif
                      @endif. Este índice expresa la relación entre
                      los kg de músculo que tiene una persona y sus kg de masa ósea. Un valor óptimo máximo es
                      cercano a 5, es decir 5 kg de músculo por cada kg de hueso. Este valor se correlaciona con un
                      nivel de salud y de rendimiento deportivo.</p>
                  
                      <p class="mb-3">El índice adiposo/muscular se encuentra @if($viewsNutrition->gender == 'f')
                        @if($viewsNutrition->indice_adiposo < 0.55)excelente
                          @elseif($viewsNutrition->indice_adiposo >= 0.55  && $viewsNutrition->indice_adiposo < 0.7)bueno
                          @elseif($viewsNutrition->indice_adiposo >= 0.7  && $viewsNutrition->indice_adiposo < 0.88)aceptable
                          @elseif($viewsNutrition->indice_adiposo >= 0.88  && $viewsNutrition->indice_adiposo < 1.06)elevado
                          @elseif($viewsNutrition->indice_adiposo >= 1.06)muy elevado
                        @endif
                      @else
                        @if($viewsNutrition->indice_adiposo < 0.36)excelente
                          @elseif($viewsNutrition->indice_adiposo >= 0.36  && $viewsNutrition->indice_adiposo < 0.41)bueno
                          @elseif($viewsNutrition->indice_adiposo >= 0.42  && $viewsNutrition->indice_adiposo < 0.54)aceptable
                          @elseif($viewsNutrition->indice_adiposo >= 0.54  && $viewsNutrition->indice_adiposo < 0.65)elevado
                          @elseif($viewsNutrition->indice_adiposo >= 0.65)muy elevado
                        @endif
                      @endif. Este índice expresa cuantos kg de masa
                      adiposa tiene que transportar cada kg de masa muscular. Mientras más bajo es este valor más
                      eficiente será la actividad para desplazarse.</p>
                  
                      <p class="mb-3">La sumatoria de 6 pliegues es de {{($viewsNutrition->tricep + $viewsNutrition->subescapular + $viewsNutrition->supraespinal + $viewsNutrition->abdominal + $viewsNutrition->muslo_medial +  $viewsNutrition->pierna_mm)}} mm. Al disminuir esta sumatoria se indica que ha
                      bajado la masa adiposa.
                      </p>
                  
                      <p class="mb-3">El índice de masa corporal (IMC) es la relación del peso con la estatura, encontrándose
                        @if($viewsNutrition->indice_corporal < 18.5)bajo
                          @elseif(24.9 < $viewsNutrition->indice_corporal)alto
                          @else normal
                        @endif. El IMC no refleja la composición corporal, por tanto no es representativo en el
                      diagnóstico nutricional.
                      </p>
                  
                      <p class="mb-3">El somatotipo es @if((round($viewsNutrition->endo, 1) >= round($viewsNutrition->meso, 1)) && (round($viewsNutrition->endo, 1) >= round($viewsNutrition->ecto, 1)))
                        endomorfo
                      @elseif((round($viewsNutrition->meso, 1) >= round($viewsNutrition->endo, 1)) && (round($viewsNutrition->meso, 1) >= round($viewsNutrition->ecto, 1)))
                        mesomorfo
                      @else
                        ectomorfo
                      @endif.
                        @if($viewsNutrition->endo >= 7.5)Extremadamente alta adiposidad relativa; muy abundante grasa subcutánea y grandes cantidades de grasa abdominen el tronco; concentración proximal de grasa en extremidades.
                          @elseif($viewsNutrition->endo >= 5.5)Alta adiposidad relativa; grasa subcutánea abundante; redondez en tronco y extremidades; mayor acumulación de grasa en el abdomen.
                          @elseif($viewsNutrition->endo >= 3)Moderada adiposidad relativa; la grasa subcutánea cubre los contornos musculares y óseos; apariencia más blanda.
                          @else Baja adiposidad relativa; poca grasa subcutánea; contornos musculares y óseos visibles.
                        @endif El somatotipo
                      provee una descripción general de la forma corporal, no tienen relación en la composición
                      corporal, por tanto no indica la cantidad precisa de grasa, músculo y hueso.
                      </p>
                  
                      <h3 class="mb-3 text-xl font-bold">DIAGNÓSTICO NUTRICIONAL:</h3>
                      <p class="mb-3">Masa adiposa elevada y masa muscular normal.</p>
                  
                      <p class="mb-5">@if(empty($viewsNutrition->comment))
                          @else
                          {{$viewsNutrition->comment}}
                          @endif
                      </p>
                      <div class="mb-3" style="font-size: 20px; color: purple; text-align: right;">
                        <p class="mb-2" style="font-weight: bold;">Melissa Ross Guerra</p>
                        <p class="mb-8">Nutricionista Deportiva</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-span-1 bg-gray-500"></div>
                
              </div>
              <div class="py-4 text-right bg-gray-500">
                <a href= "{{route('livewire.admin-nutrition',['id' => $viewsNutrition->id])}}" class="mr-5 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer">
                  Descargar PDF
                </a>
              </div>
              <x-flash-message></x-flash-message>
              </div>
            @endif
            
          </div>
          @endif

          @if($section == 4)
            <div>Sección 4</div>
          @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

