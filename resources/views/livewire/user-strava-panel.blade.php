<div class="w-10/12 mx-auto text-white mt-10">
        <div class="flex flex-col gap-y-2 md:gap-y-0 md:grid md:grid-cols-3 md:justify-between items-start" x-data="{ charges: false,progress: false }">
            <h2 class="text-2xl mb-2 flex items-center"><img class="mr-10 rounded-full w-28" src="{{$user->strava->avatar}}"> {{$user->fullname()}}</h2>

            <div class="flex flex-col">
                <div class="w-auto mx-1 bg-{{$chargeColor}}-300 border-{{$chargeColor}}-300 rounded-lg shadow-xl flex flex-col">
                    <div class="flex flex-row items-center p-5">
                        <div class="flex-1 text-right md:text-center">
                            <p class="font-bold uppercase text-sm">Ratio Carga Actual vs Previa</p>
                            <p class="font-bold text-md mt-2">{{ round($charges,4) > 0 ? round($charges,4) : "Falta Información" }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col bg-{{$chargeColor}}-500 rounded-b-lg px-5 py-1">
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col">
                                <span>Rango Sugerido: 0.8 - 1.3</span>
                                <span class="text-xs">Para más información consulte a un profesional</span>
                            </div>
                            <i class="fas fa-info-circle" x-on:click="charges = ! charges"></i>
                        </div>
                        <span class="text-sm mt-2" x-show="charges" x-transition x-cloak>
                            Este indicador contrasta la carga de los últimos 7 días con las 3 semanas previas
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col">
                <div class="w-auto mx-1 bg-{{$progresColor}}-300 border-{{$progresColor}}-300 rounded-lg shadow-xl flex flex-col">
                    <div class="flex flex-row items-center p-5">
                        <div class="flex-1 text-right md:text-center">
                            <p class="font-bold uppercase text-sm">Progresión Semanal Carga</p>
                            <p class="font-bold text-md mt-2">{{ round($progress,2) > 0 ? round($progress,2)."%" : "Falta Información" }}
                        </div>
                    </div>
                    <div class="flex flex-col bg-{{$progresColor}}-500 rounded-b-lg px-5 py-1">
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col">
                                <span>Rango Sugerido: Menor o igual al 10%</span>
                                <span class="text-xs">Para más información consulte a un profesional</span>
                            </div>
                            <i class="fas fa-info-circle" x-on:click="progress = ! progress"></i>
                        </div>
                        <span class="text-sm mt-2" x-show="progress" x-transition x-cloak>
                            Este indicador contrasta la carga de los últimos 7 días con las 3 semanas previas
                        </span>
                    </div>
                </div>
            </div>

        </div>
            <h3 class="mb-2 text-2xl mt-4">Actividades de Running usadas en el calculo</h3>
            <table class="table-fixed w-full">
                <thead>
                    <tr class="text-left">
                      <th class="w-auto sm:w-1/5">Nombre</th>
                      <th>Distancia (Km)</th>
                      <th>Tiempo en Movimiento</th>
                      <th class="hidden sm:table-cell">Tiempo Total</th>
                      <th class="hidden sm:table-cell">Ganancia de Eleveación</th>
                      <th class="hidden sm:table-cell">Tipo</th>
                      <th class="hidden sm:table-cell">Fecha</th>
                    </tr>
                </thead>
                <tbody class="mt-3">
                @foreach($activities_run_used as $activity)
                    <tr>
                        <td>{{$activity->name}}</td>
                        <td>{{round($activity->distance/1000,2)}}</td>
                        <td>{{gmdate("H:i:s",$activity->moving_time)}}</td>
                        <td class="hidden sm:table-cell">{{gmdate("H:i:s",$activity->elapsed_time)}}</td>
                        <td class="hidden sm:table-cell">{{$activity->total_elevation_gain}}</td>
                        <td class="hidden sm:table-cell">{{$activity->type}}</td>
                        <td class="hidden sm:table-cell">{{date_format(date_create($activity->start_date), 'Y-m-d')}}</td>
                    </tr>
                @endforeach
            </table>
    </div>
