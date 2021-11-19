<div class="flex flex-row gap-3 m-2 mt-4">
  <div class="flex-grow admin-box">
    <div class="bg-light-grey rounded-t-lg p-3 h-12 flex justify-between">
      <p>Usuarios</p>
      <p>Aquí va el buscador</p>
    </div>
    <div class="rounded-b-lg h-full p-3">
      <div class="flex-row items-center">
        @foreach($users as $user)
          <div class="
          {{ $loop->first ? 'rounded-t-lg ' : ''}}
          {{ $loop->last ? 'rounded-b-lg ' : ''}}
          {{ $loop->iteration%2 == 1 ? 'bg-gray-200' : 'bg-gray-300'}}
            px-6 py-4 whitespace-nowrap flex justify-between items-center"
          >
            <img class="h-10 w-10 mr-5 rounded-full" src="{{$user->profilePic()}}">
            <div class="w-auto flex-grow flex flex-col">
              <p>{{$user->fullName()}}</p>
              <p class="text-sm">{{$user->email}}</p>
            </div>
            <div class="w-auto flex-grow flex flex-col">
              <p class="text-sm">{{$user->rut}}</p>
              <p class="text-sm">{{$user->phone}}</p>
            </div>
            <div class="w-auto flex-grow flex flex-col">
              <p>{{date('d M Y', strtotime($user->birthday ))}}</p>
            </div>
            <div class="w-auto flex-grow flex flex-col">
              <p>{{$user->address()}}</p>
            </div>
            <div class="w-auto flex-grow flex flex-col">
              <p>{{$user->gender()}}</p>
            </div>
            <div class="w-auto flex-grow flex flex-col justify-between content-end">
              <p class="text-xs">Ver</p>
              <p class="text-xs">Editar</p>
              <p class="text-xs">Borrar</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="flex-none w-1/4 admin-box">
    <div class="bg-light-grey rounded-t-lg p-3 h-12">Hola</div>
    <div class="rounded-b-lg h-full p-3">
      Hola
    </div>
  </div>
</div>
