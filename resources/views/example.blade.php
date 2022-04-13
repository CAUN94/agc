<x-landing.layout>
@foreach($split as $string)
    @php
    $jsonobj = "{".$string."}";
    $value = json_decode($jsonobj,true);
    @endphp
    {{$loop}}
    {{-- @if($value["rut"] != "")
    	{{$value["nombre"]}} <a href="https://youjustbetter.softwaremedilink.com/agendas/semanalJSON/2022-03-28/?id_profesional={{$value["id"]}}">Agenda</a>
    	<br>
    @endif --}}
@endforeach
</x-landing.layout>
