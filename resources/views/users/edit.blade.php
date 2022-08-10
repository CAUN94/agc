<x-landing.layout>
  <x-landing.user-panel>
  <form action="/users/{{$user->id}}" method="POST" class="order-2 sm:order-1" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="flex gap-4">
        <div class="w-2/3 bg-white shadow overflow-hidden sm:rounded-lg">
          <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-primary-500">
              {{ $user->fullName() }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
              Perfil personal de usuarios You Just Better
            </p>
          </div>
          <div class="border-t border-gray-200">
            <dl>
              <div class="bg-light-grey px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Nombre y Apellido
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex">
                  <x-admin.input class="col-span-2 sm:col-span-3 mr-2" type="text" name="name" value="{{$user->name}}" readonly="edit" ></x-admin.input>
                  <x-admin.input class="col-span-2 sm:col-span-3" type="text" name="lastnames" value="{{$user->lastnames}}" readonly="edit" ></x-admin.input>
                </dd>
              </div>
              <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Rut
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex">
                  <x-admin.input class="col-span-2 sm:col-span-3 mr-2" type="text" name="rut" value="{{$user->rut}}" readonly="edit" ></x-admin.input>
                </dd>
              </div>
              <div class="bg-light-grey px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Email
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex">
                  <x-admin.input class="col-span-2 sm:col-span-3 mr-2" type="text" name="email" value="{{ $user->email }}" readonly="edit" ></x-admin.input>
                </dd>
              </div>
              <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Genero
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex">
                  <x-admin.input-select class="col-span-6 sm:col-span-2" name="gender" readonly="edit">
                    <x-slot name="options">
                        <x-admin.input-option value="m" actual="{{$user->gender}}">Masculino</x-admin.input-option>
                        <x-admin.input-option value="f" actual="{{$user->gender}}">Femenino</x-admin.input-option>
                        <x-admin.input-option value="n" actual="{{$user->gender}}">No Especifica</x-admin.input-option>
                    </x-slot>
                  </x-admin.input-select>
                </dd>
              </div>
              <div class="bg-light-grey px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Fecha de Nacimieno
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex">
                    <x-admin.input class="col-span-6 sm:col-span-3" type="date" name="birthday" value="{{ $user->birthday }}" readonly="edit" ></x-admin.input>
                </dd>
              </div>
              <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Celular
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex">
                  <x-admin.input class="col-span-2 sm:col-span-3 mr-2" type="number" name="phone" value="{{ $user->phone }}" readonly="edit" ></x-admin.input>
                </dd>
              </div>
              <div class="bg-light-grey px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Dirección
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <x-admin.input class="col-span-2 sm:col-span-3 mr-2" type="text" name="address" placeholder="Dirección" value="{{ $user->address }}" readonly="edit" ></x-admin.input>
                </dd>
              </div>
              <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Descripcion
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex">
                  <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Descripción">{{ $user->description }}</textarea>
                  @error("description") <span class="error text-primary-500">{{ $message }}</span> @enderror
                </dd>
              </div>
              <div class="bg-light-grey px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                  Registrado desde
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                  {{ $user->created_at->format('d M Y'); }}
                </dd>
              </div>
            </dl>
            <div class="px-4 py-3 bg-white text-right sm:px-6">
              <a href="/users" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-900">
                Volver
              </a>
              <a href="/change-password" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-900">
                Cambiar Clave
              </a>
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-900">
                Hacer Cambios
              </button>
            </div>
          </div>
        </div>
        <div class="w-1/3">
            {{-- <div class="flex flex-col gap-2"> --}}
                <div class="bg-white shadow overflow-hidden sm:rounded-lg p-4 flex flex-col gap-2">
                    <img src="{{$user->profilePic()}}" class="object-contain h-48 w-full">
                    <input name="profile" type="file" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-primary-500 focus:outline-none">
                    @error("profile") <span class="error text-primary-500">{{ $message }}</span> @enderror
                </div>
            {{-- </div> --}}
        </div>

    </div>
  </form>
  </x-landing.user-panel>
</x-landing.layout>
