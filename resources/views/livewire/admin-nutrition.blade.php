<div class="m-4">
  <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-cloak>
    <div class="md:grid md:grid-cols-4 md:gap-6">
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
      <div class="mt-5 md:mt-0 md:col-span-3">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-6">  <label for="user" class="block text-sm font-medium text-gray-700">Usuario</label>  <input type="text" name="user" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" wire:model="searchTerm" placeholder="Rut Nombre Apellidos">
                  </div>
                  @if($users && $users->count() > 0)<ul class="border border-gray-200 rounded overflow-hidden shadow-md col-span-6">    @foreach($users as $user)      <li wire:click="selectUser({{$user->id}})" class="px-4 py-2 bg-white  hover:bg-primary-100 border-b last:border-none border-gray-200 transition-all duration-300 ease-in-out">{{$user->rut}} {{$user->name}} {{$user->lastnames}}</li>    @endforeach</ul>
                  @endif

                  @if($user)<div class="col-span-6 sm:col-span-6">{{$user->rut}} {{$user->name}} {{$user->lastnames}}</div>
                  @endif

                  <x-admin.input class="col-span-6 sm:col-span-6" type="date" name="fecha" readonly="edit" >Fecha</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="peso" readonly="edit">Peso</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="talla_parado" readonly="edit">Talla_parado</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="talla_sentado" readonly="edit">Talla_sentado</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="masa_adiposa" readonly="edit">Masa_adiposa</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="indice_musculo" readonly="edit">Indice_musculo</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="masa_muscular" readonly="edit">Masa_muscular</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="indice_adiposo" readonly="edit">Indice_adiposo</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="masa_osea" readonly="edit">Masa_osea</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="indice_corporal" readonly="edit">Indice_corporal</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="tricep" readonly="edit">Tricep</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="bicep" readonly="edit">Bicep</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="muslo_medial" readonly="edit">Muslo_medial</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="supraespinal" readonly="edit">Supraespinal</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="subescapular" readonly="edit">Subescapular</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="cresta_iliaca" readonly="edit">Cresta_iliaca</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="pierna" readonly="edit">Pierna</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="abdominal" readonly="edit">Abdominal</x-admin.input>

              </div>

            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" wire:click='nutrionCreate()'>
                Cargar Información
              </p>
            </div>
      </div>
    </div>
  </div>
</div>
<x-flash-message></x-flash-message>
</div>
