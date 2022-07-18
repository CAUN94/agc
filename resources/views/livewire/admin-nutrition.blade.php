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
              @if("edit" == "edit")
                  <h1 class="text-primary-500">Modificar Usuario</h1>
              @endif
              <div class="grid grid-cols-6 gap-6">
                  <x-admin.input class="col-span-6 sm:col-span-3" type="text" name="name" value="name" >Nombre</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-3" type="text" name="lastnames" value="lastnames" >Apellidos</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-3" type="text" name="rut" value="rut" >Rut</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-3" type="email" name="email" value="email" >Mail</x-admin.input>

                  <x-admin.input class="col-span-6 sm:col-span-2" type="number" name="phone" value="phone" >Celular</x-admin.input>
                  <x-admin.input class="col-span-6 sm:col-span-2" type="date" name="birthday" value="birthday" >Fecha de Nacimiento</x-admin.input>
                  {{-- <x-admin.input class="col-span-6 sm:col-span-2" type="text" name="gender" value="{{$gender}}" >Genero</x-admin.input> --}}
                  <x-admin.input-select class="col-span-6 sm:col-span-2" name="gender">
                    Genero
                    <x-slot name="options">
                        <x-admin.input-option value="m">Masculino</x-admin.input-option>
                        <x-admin.input-option value="f">Femenino</x-admin.input-option>
                        <x-admin.input-option value="n">No Especifica</x-admin.input-option>
                    </x-slot>
                  </x-admin.input-select>

                  <x-admin.input class="col-span-6" type="text" name="address">Dirección</x-admin.input>

                  <div class="col-span-6 sm:col-span-2">
                    <label class="text-sm font-medium text-gray-700">
                      Foto Perfil
                    </label>
                    <div class="mt-1 flex items-center">
                      <span class="inline-block h-16 w-16 rounded-full overflow-hidden bg-gray-100">
                        <img src="" class="avatar h-16 w-16 mr-2" alt="Foto">
                      </span>
                    </div>
                  </div>

                  <div class="col-span-6 sm:col-span-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">
                      Descripción
                    </label>
                    <div class="mt-1">
                      <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md">dhioas</textarea>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                      Breve descripción
                    </p>
                    @error("description") <span class="error text-primary-500">{{ $message }}</span> @enderror
                  </div>
              </div>

            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer">
                Borrar Usuario
              </p>
            @if('edit' != "edit")

              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer"
              wire:click='activateEdit()'>
                Modificar Usuario
              </p>
            </div>
            @else
              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer">
                No Modificar Usuario
              </p>
              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer">
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


              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer">
                jska
              </p>
              <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer">
                djisoa
              </p>
            </div>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <h2>Panel Entrenadores</h2>
              <div class="grid grid-cols-6 gap-6">

              </div>
            </div>
          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer">
              Nothing
            </p>
          </div>
      </div>
    </div>


  </div>






  </div>
  <x-flash-message></x-flash-message>
</div>
