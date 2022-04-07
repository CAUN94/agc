<x-landing.layout>
    <div class="w-10/12 mx-auto text-white mt-10">
        <h2 class="text-lg mb-2 flex items-center"><img class="mr-10 rounded-full w-28" src="{{$user->avatar}}"> {{$user->username}}</h2>
        <p class="my-3">Carga Carrera: {{round($charges,4)}}</p>
        <p class="my-3">Progresón Carga: {{round($progress,4)}}</p>

            <h3 class="text-lg mb-2">Actividades</h3>
            <table class="table-auto w-full">
                <thead>
                    <tr class="text-left">
                      <th>Nombre</th>
                      <th>Distancia</th>
                      <th>Movimiento</th>
                      <th>Tiempo transcurrido</th>
                      <th>Ganancia de Eleveación</th>
                      <th>Tipo</th>
                      <th>Fecha</th>
                    </tr>
                </thead>
                <tbody class="mt-3">
                @foreach($activities as $activity)
                    {{-- @php $activity = json_encode($activity) @endphp
                    {{json_encode($activity) }} --}}
                    <tr>
                        <td>{{$activity->name}}</td>
                        <td>{{$activity->distance}}</td>
                        <td>{{$activity->moving_time}}</td>
                        <td>{{$activity->elapsed_time}}</td>
                        <td>{{$activity->total_elevation_gain}}</td>
                        <td>{{$activity->type}}</td>
                        <td>{{$activity->start_date}}</td>
                    </tr>
                @endforeach
            </table>
    </div>
</x-landing.layout>
