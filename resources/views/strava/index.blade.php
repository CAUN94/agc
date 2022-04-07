<x-landing.layout>
    <div class="w-10/12 mx-auto text-white mt-10">
        @foreach($users as $user)
            <h2 class="text-lg mb-2">Lista de Usuarios</h2>
            <ul class="w-1/3 ">
                <li class="flex items-center">
                    <img class="mr-10 rounded-full w-28" src="{{$user->avatar}}">
                    {{$user->username}}
                    <a class="ml-10" href="/strava/adminshow/{{$user->id}}">Ver Strava</a>
                </li>
            </ul>
        @endforeach
    </div>

</x-landing.layout>
