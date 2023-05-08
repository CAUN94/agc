<div class="m-4">
  <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-cloak>
    <div class="md:grid md:grid-cols-4 md:gap-6">
      <div class="mb-3 mt-5 md:mt-0 md:col-span-3">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-6">  <label for="user" class="block text-sm font-medium text-gray-700">Usuario</label>  <input type="text" name="user" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="searchTerm" placeholder="Escribe Rut nombre o usuario">
                  </div>
                  @if($users && $users->count() > 0)<ul class="border border-gray-200 rounded overflow-hidden shadow-md col-span-6">    @foreach($users as $user)      <li wire:click="selectUser({{$user->id}})" class="px-4 py-2 bg-white  hover:bg-primary-100 border-b last:border-none border-gray-200 transition-all duration-300 ease-in-out">{{$user->rut}} {{$user->name}} {{$user->lastnames}}</li>    @endforeach</ul>
                  @endif

                  @if($user)<div class="col-span-6 sm:col-span-6">{{$user->rut}} {{$user->name}} {{$user->lastnames}} {{\Carbon\Carbon::parse($user->birthday)->diff(\Carbon\Carbon::now())->format('%y años')}}</div>
                  @endif

                  <x-admin.input class="col-span-6 sm:col-span-6" type="date" name="fecha" readonly="edit" >Fecha de Examen</x-admin.input>


                  <div class="mb-3 col-span-6 sm:col-span-2">
                    <x-label for="Sexo" :value="__('Sexo')" />
                        <select wire:model= 'sexo' class="form-select w-full mt-1 rounded-md shadow-sm border-gray-300 focus:border-primary-100 focus:ring focus:ring-primary-100 focus:ring-opacity-50">
                              <option>Seleccione el sexo</option>
                              <option value='f'>Femenino</option>
                              <option value='m'>Masculino</option>
                        </select>
                  </div>

                  <div class="mb-3 col-span-6 sm:col-span-4 ">
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

                  <p class="col-span-7 sm:col-span-7 font-bold">Datos Deporte</p>
                  <x-admin.input class="col-span-7 sm:col-span-2" type="text" name="deporte" readonly="edit" value="{{ old('deporte') }}">Deporte</x-admin.input>
                  <x-admin.input class="col-span-7 sm:col-span-1" type="number" name="deporteEndo" readonly="edit" value="{{ old('deporteEndo') }}">Endomorfo</x-admin.input>
                  <x-admin.input class="col-span-7 sm:col-span-1" type="number" name="deporteMeso" readonly="edit" value="{{ old('deporteMeso') }}">Mesomorfo</x-admin.input>
                  <x-admin.input class="col-span-7 sm:col-span-1" type="number" name="deporteEcto" readonly="edit" value="{{ old('deporteEcto') }}">Ectomorfo</x-admin.input>
                  <x-admin.input class="col-span-7 sm:col-span-1" type="number" name="deporteSumatoria" readonly="edit" value="{{ old('deporteSumatoria') }}">Sum. Plieges</x-admin.input>

                  <p class="col-span-6 sm:col-span-6 font-bold">Datos Basicos</p>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="peso" readonly="edit" value="{{ old('peso') }}">Peso</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="talla_parado" readonly="edit" value="{{ old('talla_parado') }}">Talla Parado</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="talla_sentado" readonly="edit" value="{{ old('talla_sentado') }}">Talla Sentado</x-admin.input>

                  <p class="col-span-6 sm:col-span-6 font-bold">Diametros (cm)</p>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="biacromial" readonly="edit" value="{{ old('biacromial') }}">Biacromial</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="t_transverso" readonly="edit" value="{{ old('t_transverso') }}">Tórax Transverso</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="t_antero_posterior" readonly="edit" value="{{ old('t_antero_posterior') }}">Tórax Antero-Posterior</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="bi_iliocrestideo" readonly="edit" value="{{ old('bi_iliocrestideo') }}">Bi-iliocestídeo</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="humeral" readonly="edit" value="{{ old('humeral') }}">Humeral</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="femoral" readonly="edit" value="{{ old('femoral') }}">Femoral</x-admin.input>

                  <p class="col-span-6 sm:col-span-6 font-bold">Perimetros (cm)</p>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="cabeza" readonly="edit" value="{{ old('cabeza') }}">Cabeza</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="brazo_relajado" readonly="edit" value="{{ old('brazo_relajado') }}">Brazo Relajado</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="brazo_flexionado" readonly="edit" value="{{ old('brazo_flexionado') }}">Brazo Flexionado</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="antebrazo_maximo" readonly="edit" value="{{ old('antebrazo_maximo') }}">Antebrazo Máximo</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="t_mesoesternal" readonly="edit" value="{{ old('t_mesoesternal') }}">Tórax-Mesoesternal</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="cintura" readonly="edit" value="{{ old('cintura') }}">Cintura (mínima)</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="cadera" readonly="edit" value="{{ old('cadera') }}">Cadera</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="muslo_maximo" readonly="edit" value="{{ old('muslo_maximo') }}">Muslo (máxima)</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="muslo_medio" readonly="edit" value="{{ old('muslo_medio') }}">Muslo (medial)</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="pierna_cm" readonly="edit" value="{{ old('pierna_cm') }}">Pantorrilla</x-admin.input>

                  <p class="col-span-6 sm:col-span-6 font-bold">Pliegues Cutaneos (mm)</p>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="triceps" readonly="edit" value="{{ old('triceps') }}">Tríceps</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="subescapular" readonly="edit" value="{{ old('subescapular') }}">Subescapular</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="biceps" readonly="edit" value="{{ old('biceps') }}">Bíceps</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="cresta_iliaca" readonly="edit" value="{{ old('cresta_iliaca') }}">Cresta iliaca</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="supraespinal" readonly="edit" value="{{ old('supraespinal') }}">Supraespinal</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="abdominal" readonly="edit" value="{{ old('abdominal') }}">Abdominal</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="muslo_medial" readonly="edit" value="{{ old('muslo_medial') }}">Muslo Medial</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="pierna_mm" readonly="edit" value="{{ old('´pierna_mm') }}">Pantorrilla</x-admin.input>

                  <p class="col-span-6 sm:col-span-6 font-bold">Masa Osea Referencial</p>
                  <x-admin.input class="col-span-6 sm:col-span-1" type="number" name="masa_osea_ref" readonly="edit" value="{{ old('masa_osea_ref') }}">Masa Osea de referencia</x-admin.input>
              </div>
            </div>
            <div class=" px-4 py-3 bg-gray-50 text-right sm:px-6">
              @if (session()->has('nutricionMensaje'))
              <p style="color: #28a745;" x-data="{ showFlash: true }" x-init="setTimeout(() => showFlash = false, 3000)" x-show.transition.duration.1000ms="showFlash" class="alert alert-success">
                  {{ session('nutricionMensaje') }}
              </p>
              @endif
              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" wire:click='nutrionCreate()'>
                Cargar Información
              </p>
              <a href= "{{route('livewire.admin-nutrition')}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer">
                Generar PDF
              </a>
            </div>
      </div>
    </div>

    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Analisís de Nutrición</h3>
        <p class="mt-1 text-sm text-gray-600">
          Panel para cargar información nutricional de paciente
        </p>
      </div>
    </div>
      </div>

    <div class="md:grid md:grid-cols-4 md:gap-6">
      <div class="mb-3 mt-5 md:mt-0 md:col-span-3">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <div class="grid grid-cols-5 gap-5">
              <h3 class="col-span-4 sm:col-span-4 text-lg font-medium leading-6 text-gray-900">Resultados de Antrometría</h3>
              <select class="col-span-1 sm:col-span-1 bg-gray-200 border-gray-200 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="nutritionID" id="nutritionID" name="nutritionID">
              Fechas
              @if(!is_null($user))
                @foreach($user->nutrition()->orderby('Fecha','desc')->get() as $control)
                  <option value="{{$control->id}}">{{$control->fecha()}}</option>
                @endforeach
              @endif
            </select>

            <div class="md:col-span-2">
              <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
                <thead class="cabecera">
                  <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
                    <th class="text-center py-2 min-w-4/8 w-6/12">Básicos</th>
                    <th class="text-center py-2 min-w-4/8 w-6/12 ">Datos</th>
                  </tr>
                </thead>
                <tbody>
                  @if(!is_null($viewsNutrition))
                  <tr>
                    <td class="text-center">Peso (kg)</td>
                    <td class="text-center">{{$viewsNutrition->peso}}</td>
                  </tr>
                  <tr>
                    <td class="text-center">Talla (cm)</td>
                    <td class="text-center">{{$viewsNutrition->talla_parado}}</td>
                  </tr>
                  <tr>
                    <td>Talla sentado (cm)</td>
                    <td class="text-center">{{$viewsNutrition->talla_sentado}}</td>
                  </tr>
                  <tr>
                    <td style="text-align: center; font-weight: bold;">Diametros</td>
                    <td style=""></td>
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
                    <td style=" text-align: center; font-weight: bold;">Perimetros (cm)</td>
                    <td style=""></td>
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
                    <td style=" text-align: center; font-weight: bold;">Pliegues (mm)</td>
                    <td style=""></td>
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
                  @endif
                </tbody>
              </table>
            </div>

            <div class="rounded-b-lg h-full md:col-span-3">
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
                    <td class="text-center">{{round($indice_M_O, 1)}}</td>
                  </tr>

                  <tr>
                    <td class="text-center">Adiposo/Muscular</td>
                    <td class="text-center">{{round($indice_A_M, 1)}}</td>
                  </tr>

                  <tr>
                    <td class="text-center">Masa corporal</td>
                    <td class="text-center">{{$indice_masa_corporal}} Kg/m2</td>
                  </tr>

                  <tr>
                    <td class="text-center">Diferencia PE/PB</td>
                    <td class="text-center">{{$diferencia_PE_PB}}</td>
                    <td class="text-center">{{$diferencia_porc}}%</td>
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
              <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
                <thead>
                  <tr class="bg-gray-300 text-sm font-semibold tracking-wide text-left">
                    <th class="text-center py-2 min-w-4/8 w-6/12">Información Adicional</th>
                    <th colspan="2" class="text-center py-2 min-w-4/8 w-6/12 "></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center">Diferencia PE/PB</td>
                    <td class="text-center">{{round($diferencia_PE_PB, 1)}}</td>
                    <td class="text-center">{{round($diferencia_porc, 1)}}%</td>
                  </tr>
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div>


      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Visualización de Nutrición</h3>
          <p class="mt-1 text-sm text-gray-600">
            Panel para visualizar la información nutricional de paciente de cada examen.
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

    <div class="mb-3 mt-5 md:mt-0 md:col-span-3">
      <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <x-admin.input class="col-span-3 sm:col-span-2" type="number" name="Talla_cm" readonly="edit">Talla (cm)</x-admin.input>
            <x-admin.input class="col-span-3 sm:col-span-2" type="number" name="S6_pliegues" readonly="edit">sumatoria 6 pliegues</x-admin.input>
            <x-admin.input class="col-span-3 sm:col-span-2" type="number" name="Masa_Adiposa" readonly="edit">Masa Adiposa Actual</x-admin.input>
          </div>
        </div>
      </div>
      @if($this->showMasaAdiposa)
        <div>
          <p>Z-adiposa: {{round($Z_Adiposa_show, 3)}}</p>
          <p>Masa adiposa (Kg) {{round($Kg_adiposa_show, 1)}}</p>
          <p>Masa adiposa a bajar: {{round($adiposa_bajar_show, 0)}}</p>
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
            <x-admin.input class="col-span-3 sm:col-span-2" type="number" name="M_osea" readonly="edit">Masa ósea (Kg)</x-admin.input>
            <x-admin.input class="col-span-3 sm:col-span-2" type="number" name="Indice_MO" readonly="edit">obj. Índice M/O</x-admin.input>
            <x-admin.input class="col-span-3 sm:col-span-2" type="number" name="M_muscular" readonly="edit">Masa muscular actual (Kg)</x-admin.input>
          </div>
        </div>
      </div>
      @if($this->showMasaMuscular)
        <div>
          <p>Masa muscular (Kg) {{round($M_muscular_show, 1)}}</p>
          <p>Masa muscular a aumentar: {{round($M_muscular_aumentar_show, 1)}}</p>
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
