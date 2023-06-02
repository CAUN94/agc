<x-landing.layout>
<div class="bg-white p-4 w-1/3 mx-auto mt-10 flex flex-col">
@foreach($professionals as $professional)
    <span>{{$professional->user->name}} {{$professional->user->lastnames}} <a class="underline" href="/professionals/{{$professional->id}}">Agenda</a></span>
@endforeach
</div>
</x-landing.layout>
