<x-landing.layout>
    <div class="w-10/12 mx-auto text-white mt-10">
        <h2 class="text-lg mb-2">Lista de Usuarios</h2>
        @foreach($users as $user)
            <ul class="w-1/3 mb-2">
                <li class="flex items-center">
                    <img class="mr-10 rounded-full w-28" src="{{$user->avatar}}">
                    {{$user->username}}
                    <a class="ml-10" href="/strava/adminshow/{{$user->id}}">Ver Strava</a>
                    <a class="ml-10" href="/strava/showjson/{{$user->id}}">Ver Json</a>
                </li>
            </ul>
        @endforeach
    </div>

</x-landing.layout>
