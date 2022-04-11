<x-landing.layout>
    <div class="w-10/12 mx-auto text-white mt-10">
        <div class="flex flex-col gap-y-2 md:gap-y-0 md:grid md:grid-cols-3 md:justify-between items-center">
            <h2 class="text-2xl mb-2 flex items-center"><img class="mr-10 rounded-full w-28" src="{{$user->strava->avatar}}"> {{$user->fullname()}}</h2>

            <div class="w-2/3 bg-gradient-to-b from-primary-100 to-primary-100 border-b-4 border-primary-500 rounded-lg shadow-xl p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-1 text-right md:text-center">
                        <p class="font-bold uppercase text-md">Carga Carrera</p>
                        <p class="font-bold text-md">{{round($charges,4)}}</p>
                    </div>
                </div>
            </div>

            <div class="w-2/3 bg-gradient-to-b from-primary-100 to-primary-100 border-b-4 border-primary-500 rounded-lg shadow-xl p-5">
                <div class="flex flex-row items-center">
                    <div class="flex-1 text-right md:text-center">
                        <p class="font-bold uppercase text-md">Progresión Carga</p>
                        <p class="font-bold text-md">{{round($progress,4)}}</p>
                    </div>
                </div>
            </div>

        </div>

            <h3 class="text-lg mb-2">Actividades</h3>
            <table class="table-fixed w-full">
                <thead>
                    <tr class="text-left">
                      <th class="w-auto sm:w-1/5">Nombre</th>
                      <th>Distancia</th>
                      <th>Movimiento</th>
                      <th class="hidden sm:table-cell">Tiempo transcurrido</th>
                      <th class="hidden sm:table-cell">Ganancia de Eleveación</th>
                      <th class="hidden sm:table-cell">Tipo</th>
                      <th class="hidden sm:table-cell">Fecha</th>
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
                        <td class="hidden sm:table-cell">{{$activity->elapsed_time}}</td>
                        <td class="hidden sm:table-cell">{{$activity->total_elevation_gain}}</td>
                        <td class="hidden sm:table-cell">{{$activity->type}}</td>
                        <td class="hidden sm:table-cell">{{date_format(date_create($activity->start_date), 'Y-m-d H:i:s')}}</td>
                    </tr>
                @endforeach
            </table>
    </div>
</x-landing.layout>
