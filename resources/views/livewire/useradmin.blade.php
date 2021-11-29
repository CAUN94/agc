<div class="flex flex-row gap-3 m-2 mt-4">
  <div class="flex-grow admin-box">
    <div class="bg-light-grey rounded-t-lg p-3 h-16 flex items-center justify-between">
      <p>Usuarios</p>
      <div class="flex border-2 rounded">
        <input wire:model.debounce.300ms="search" type="text" class="px-4 py-1 w-60" placeholder="Buscar..">
      </div>
    </div>
    <div class="rounded-b-lg h-full p-3">
      <table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6">
        <thead>
          <tr class="bg-gray-400 text-sm font-semibold tracking-wide text-left">
            <th class="px-3 py-2 w-16">Foto</th>
            <th class="py-2 min-w-1/8 w-auto">Nombre y Mail</th>
            <th class="py-2 min-w-1/8 w-2/12 ">Rut y Telefono</th>
            <th class="py-2 min-w-1/8 w-2/12">Fecha Nacimiento</th>
            <th class="py-2 min-w-1/8 w-auto">Dirección</th>
            <th class="py-2 min-w-1/8 w-1/12">Genero</th>
            <th class="px-3 min-w-1/8 w-2/12">Opciones</th>
          </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr class="{{ $loop->iteration%2 == 1 ? 'bg-gray-200' : 'bg-gray-300'}}">
          <td class="p-2">
            <img class="h-10 w-10 rounded-full" src="{{$user->profilePic()}}">
          </td>
          <td class="py-2">
            <div class="flex flex-col items-left justify-between">
              <span>{{$user->fullName()}}</span>
              <span class="text-xs">{{$user->email}}</span>
            </div>
          </td>
          <td>
             <div class="flex flex-col items-left justify-between">
              <span class="text-sm">{{$user->rut}}</span>
              <span class="text-sm">{{$user->phone}}</span>
            </div>
          </td>
          <td>
            <div class="flex flex-col items-left justify-between">
               <span class="text-sm">{{date('d M Y', strtotime($user->birthday ))}}</span>
                <span class="text-sm">Edad: {{$user->age()}}</span>
          </td>
          <td>
            <span class="text-sm">{{$user->address()}}</span>
          </td>
          <td>
            <span class="text-sm">{{$user->gender()}}</span>
          </td>
          <td class="px-3 py-2 flex flex-col items-left justify-between">
            <a href="#"><i class="fab fa-500px mr-2"></i>Ver</a>
            <a href="#"><i class="fab fa-500px mr-2"></i>Editar</a>
            <a href="#"><i class="fab fa-500px mr-2"></i>Borrar</a>
          </td>
        </tr>
        @endforeach
        </tbody>
      </table>
      <div class="pt-2 px-3">{{$users}}</div>
    </div>
  </div>
  <div class="flex-none w-1/4 admin-box">
    <div class="bg-light-grey rounded-t-lg p-3 h-12">Hola</div>
    <div class="rounded-b-lg h-full p-3">
      Hola
    </div>
  </div>
</div>
