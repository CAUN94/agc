{{-- Lista de pacientes para el PDF --}}

<h1>Listado de Info</h1>

@foreach ($infos as $info)
    <p>{{ $info }}</p>
@endforeach