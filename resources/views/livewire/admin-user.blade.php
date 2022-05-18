<div class="m-4">
  <div x-data="{ 'showModal': false }" @keydown.escape="showModal = false" x-cloak>
    <div class="md:grid md:grid-cols-4 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Perfil de Usuario</h3>
          <p class="mt-1 text-sm text-gray-600">
            Esta sección muesta la información base de cualquier usuario registrado en you.
          </p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-3">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              @if($view == "edit")
                  <h1 class="text-primary-500">Modificar Usuario</h1>
              @endif
              <div class="grid grid-cols-6 gap-6">
                  <x-admin.input class="col-span-6 sm:col-span-3" type="text" name="name" value="{{$name}}" :readonly="$view" >Nombre</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-3" type="text" name="lastnames" value="{{$lastnames}}" :readonly="$view" >Apellidos</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-3" type="text" name="rut" value="{{$rut}}" :readonly="$view" >Rut</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-3" type="email" name="email" value="{{$email}}" :readonly="$view" >Mail</x-admin.input>

                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="phone" value="{{$phone}}" :readonly="$view" >Celular</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="date" name="birthday" value="{{$birthday}}" :readonly="$view" >Fecha de Nacimiento</x-admin.input>
                  {{-- <x-admin.input class="col-span-6 sm:col-span-2" type="text" name="gender" value="{{$gender}}" :readonly="$view" >Genero</x-admin.input> --}}
                  <x-admin.input-select class="col-span-6 sm:col-span-2" name="gender" :readonly="$view">
                    Genero
                    <x-slot name="options">
                        <x-admin.input-option value="m" actual="{{$gender}}">Masculino</x-admin.input-option>
                        <x-admin.input-option value="f" actual="{{$gender}}">Femenino</x-admin.input-option>
                        <x-admin.input-option value="n" actual="{{$gender}}">No Especifica</x-admin.input-option>
                    </x-slot>
                  </x-admin.input-select>

                  <x-admin.input class="col-span-6" type="text" name="address" value="{{$address}}" :readonly="$view" >Dirección</x-admin.input>

                  <div class="col-span-6 sm:col-span-2">
                    <label class="text-sm font-medium text-gray-700">
                      Foto Perfil
                    </label>
                    <div class="mt-1 flex items-center">
                      <span class="inline-block h-16 w-16 rounded-full overflow-hidden bg-gray-100">
                        <img src="{{$profile}}" class="avatar h-16 w-16 mr-2" alt="Foto">
                      </span>
                      @if($view == "edit")
                          <input type="file" wire:model="new_profile">
                      @endif
                    </div>
                  </div>

                  <div class="col-span-6 sm:col-span-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">
                      Descripción
                    </label>
                    <div class="mt-1">
                      <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Descripción" {{ ($view != "edit") ? 'disabled' : '' }} wire:model="description">{{$description}}</textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                      Breve descripción
                    </p>
                    @error("description") <span class="error text-primary-500">{{ $message }}</span> @enderror
                  </div>
              </div>

            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" @click="showModal = true">
                Borrar Usuario
              </p>
            @if($view != "edit")

              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer"
              wire:click='activateEdit()'>
                Modificar Usuario
              </p>
            </div>
            @else
              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer"
              wire:click='unActivateEdit()'>
                No Modificar Usuario
              </p>
              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer"
             wire:click="update()">
                Hacer Cambios
              </p>
            </div>
            @endif
      </div>
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2">
      <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <h2>Panel Alianza</h2>
              <div class="grid grid-cols-6 gap-6">
                @if($this->user->hasAlliance())
                <x-admin.input class="col-span-6 sm:col-span-3" type="text" name="alliance"  :readonly="''" >Alianza</x-admin.input>
                <x-admin.input class="col-span-6 sm:col-span-3" type="number" name="desc"  :readonly="''" >Dscto</x-admin.input>
                @endif
                <x-admin.input-select class="col-span-6 sm:col-span-6" name="newalliance" readonly="edit">
                  Alianzas
                  <x-slot name="options">
                    <option hidden>Seleccionar</option>
                    @foreach($this->allAlliance as $alliance)
                      <x-admin.input-option value="{{$alliance->id}}">{{$alliance->name}}</x-admin.input-option>
                    @endforeach
                  </x-slot>
                </x-admin.input-select>
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer"
              wire:click="storeAlliance()">
                Cargar Alianza
              </p>
            </div>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
          </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" @click="showModal = true">
              Borrar Usuario
            </p>
          </div>
      </div>
    </div>


  </div>


  <div x-show="showModal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
              <!-- Heroicon name: outline/exclamation -->
              <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Borrar a: {{$name}} {{$lastnames}}</h3>
              <div class="mt-2">
                <p class="text-sm text-gray-500">Estas seguro de querer borrar a este usuario?</p>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" wire:click='deleteUser()'>Borrar</button>
          <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="showModal = false">Cancelar</button>
        </div>
      </div>
    </div>
  </div>


  </div>
  <x-flash-message></x-flash-message>
</div>
