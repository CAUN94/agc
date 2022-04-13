<x-landing.layout>
<div class="bg-white p-4 w-1/2 mx-auto mt-10">
@foreach($professionals as $professional)
    @php
    $value = json_decode("{".$professional."}",true);
    @endphp
    @if($value["rut"] != "")
    	{{$value["nombre"]}} {{$value["apellidos"]}} <a class="underline" href="/professionals/{{$value["id"]}}">Agenda</a>
    	<br>
    @endif
@endforeach
</div>
</x-landing.layout>
