
<div class="m-4">
    <div>
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
                    <h1>Modificar Usuario</h1>
                @endif
                <div class="grid grid-cols-6 gap-6">
                    <x-admin.input class="col-span-6 sm:col-span-3" type="text" name="name" wire:model="name" value="{{$name}}" :readonly="$view" >Nombre</x-admin.input>
                    <x-admin.input class="col-span-6 sm:col-span-3" type="text" name="lastnames" value="{{$lastnames}}" :readonly="$view" >Apellidos</x-admin.input>
                    <x-admin.input class="col-span-6 sm:col-span-3" type="text" name="rut" value="{{$rut}}" :readonly="$view" >Rut</x-admin.input>
                    <x-admin.input class="col-span-6 sm:col-span-3" type="email" name="email" value="{{$email}}" :readonly="$view" >Mail</x-admin.input>

                    <x-admin.input class="col-span-6 sm:col-span-2" type="text" name="phone" value="{{$phone}}" :readonly="$view" >Celular</x-admin.input>
                    <x-admin.input class="col-span-6 sm:col-span-2" type="date" name="birthday" value="{{$birthday}}" :readonly="$view" >Fecha de Nacimiento</x-admin.input>
                    <x-admin.input class="col-span-6 sm:col-span-2" type="text" name="gender" value="{{$gender}}" :readonly="$view" >Gender</x-admin.input>

                    <x-admin.input class="col-span-6" type="text" name="address" value="{{$address}}" :readonly="$view" >Dirección</x-admin.input>

                    <div class="col-span-6 sm:col-span-2">
                      <label class="text-sm font-medium text-gray-700">
                        Foto Perfil
                      </label>
                      <div class="mt-1 flex items-center">
                        <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                          <img src="{{$profile}}" class="p-1" alt="Foto">
                        </span>
                        @if($view == "edit")
                            <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                              Cambiar
                            </button>
                        @endif
                      </div>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                      <label for="about" class="block text-sm font-medium text-gray-700">
                        Descripción
                      </label>
                      <div class="mt-1">
                        <textarea id="about" name="about" rows="3" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Descripción" :readonly="$view" >{{$description}}</textarea>
                      </div>
                      <p class="mt-2 text-sm text-gray-500">
                        Breve descripción
                      </p>
                    </div>
                </div>

              </div>
              @if($view != "edit")
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <p class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer"
                wire:click='activateEdit()'>
                  Modificar Usuario
                </p>
              </div>
              @else
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
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
      </div>
    </div>
</div>
