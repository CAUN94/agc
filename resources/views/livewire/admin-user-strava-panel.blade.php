<div class="w-10/12 mx-auto text-white mt-10">
    <div class="my-10">
        <h1 class="font-futura text-white font-bold text-center uppercase text-2xl lg:text-6xl">You Just <span class="text-primary-500">Better</span></h1>
    </div>
    <div class="flex flex-col gap-y-2 md:gap-y-0 md:grid md:grid-cols-4 md:justify-between items-start" x-data="{ charges: false,progress: false }">
        <div class="flex flex-col items-center">
            <img class="rounded-full w-28" src="{{$user->strava->avatar}}">
        </div>
        <div class="flex flex-col">
            <h2 class="text-2xl">{{$user->fullname()}}</h2>
            <h3 class="text-xl">Edad: {{$user->age()}}</h3>
            <h3 class="text-lg">Deportes:</h3>
            <ul class="list-disc list-inside">
            @foreach(App\Models\User::find($userid)->sports() as $key => $sports)
                <li>{{$key}}</li>
            @endforeach
            </ul>
        </div>
        <div class="flex flex-col">
            <div class="w-auto mx-1 bg-{{$chargeColor}}-300 border-{{$chargeColor}}-300 rounded-lg shadow-xl flex flex-col">
                <div class="flex flex-row items-center p-5">
                    <div class="flex-1 text-right md:text-center">
                        <p class="font-bold uppercase text-sm">Ratio Carga Actual vs Previa {{ round($charges,4) > 0 ? round($charges,4) : "Falta Información" }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-col bg-{{$chargeColor}}-500 rounded-b-lg px-5 py-1">
                    <div class="flex justify-between items-center">
                        <div class="flex flex-col">
                            <span class="text-xs">Rango Sugerido: 0.8 - 1.3</span>
                        </div>
                        <i class="fas fa-info-circle" x-on:click="charges = ! charges"></i>
                    </div>
                    <div x-show="charges" x-transition x-cloak>
                        <div class="text-xs mt-2">
                            Este indicador contrasta la carga de los últimos 7 días con los 21 días previos.
                            <br>
                            Para más información consulte a un profesional
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="w-auto mx-1 bg-{{$progresColor}}-300 border-{{$progresColor}}-300 rounded-lg shadow-xl flex flex-col">
                <div class="flex flex-row items-center p-5">
                    <div class="flex-1 text-right md:text-center">
                        <p class="font-bold uppercase text-sm">Progresión Semanal Carga {{ round($progress,2)."%" }}
                    </div>
                </div>
                <div class="flex flex-col bg-{{$progresColor}}-500 rounded-b-lg px-5 py-1">
                    <div class="flex justify-between items-center">
                        <div class="flex flex-col">
                            <span class="text-xs">Rango Sugerido: Menor o igual al 10%</span>
                        </div>
                        <i class="fas fa-info-circle" x-on:click="progress = ! progress"></i>
                    </div>
                    <div class="text-sm mt-2" x-show="progress" x-transition x-cloak>
                        Este indicador contrasta la carga de los últimos 7 días con los 7 días previos.
                        <br>
                        Para más información consulte a un profesional
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container-col">
        <a href="https://www.strava.com/clubs/youjustbetter?utm_source=com.whatsapp&utm_medium=referral" target="_blank" class="bg-primary-500 hover:bg-primary-900 text-white text-base sm:text-xl font-bold rounded-lg text-center uppercase border-white border-2 py-4 w-4/5 lg:w-2/5 my-0.5">Únete a nuestro equipo de Strava</a>
    </div>

    <div class="grid grid-cols-2 gap-x-2">
        <div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
            <div class="container block ">
              <canvas id="examChart"></canvas>
            </div>
            <script>
                var ctx = document.getElementById("examChart").getContext("2d");
                var myChart = new Chart(ctx, {
                  type: 'line',
                  options: {
                    scales: {
                      xAxes: [{
                        type: 'time',
                      }]
                    }
                  },
                  data: {
                    labels: {!! json_encode(array_keys(array_slice($this->allData,count($this->allData)-4,count($this->allData),true))) !!},
                    datasets: [{
                      label: 'Indicadores de Carga',
                      data: [
                        @foreach($this->dataCharges as $key => $value)
                        {
                            t: '{{$key}}',
                            y: {{round($value,4)}}
                        } {{(!$loop->last) ? ',' : ''}}
                        @endforeach
                        ,
                      ],
                      backgroundColor: 'rgba(242, 113, 90, 0.1)',
                      borderColor: 'rgba(242, 113, 90, 1)',
                      borderWidth: 2
                    }]
                  }
                });
            </script>
        </div>
        <div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
            <div class="container block ">
              <canvas id="examChart2"></canvas>
            </div>
            <script>
                var ctx = document.getElementById("examChart2").getContext("2d");
                var myChart = new Chart(ctx, {
                  type: 'line',
                  options: {
                    scales: {
                      xAxes: [{
                        type: 'time',
                      }]
                    }
                  },
                  data: {
                    labels: {!! json_encode(array_keys(array_slice($this->allData,count($this->allData)-4,count($this->allData),true))) !!},
                    datasets: [{
                      label: 'Indicadores de Progresión',
                      data: [
                        @foreach($this->dataProgress as $key => $value)
                        {
                            t: '{{$key}}',
                            y: {{round($value,4)}}
                        } {{(!$loop->last) ? ',' : ''}}
                        @endforeach
                        ,
                      ],
                      backgroundColor: 'rgba(242, 113, 90, 0.1)',
                      borderColor: 'rgba(242, 113, 90, 1)',
                      borderWidth: 2
                    }]
                  }
                });
            </script>
        </div>
    </div>
    <div class="grid grid-cols-4 mt-10">
        <div class="col-span-4">
            <h3 class="mb-2 text-2xl">Actividades de Running usadas en el calculo</h3>
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
                      <th class="hidden sm:table-cell">Periodo</th>
                    </tr>
                </thead>
                <tbody class="mt-3">
                @foreach($allData as $week)
                    @if($loop->index == 0)
                        @php $actualKey = 'Últimos 7 días'  @endphp
                    @elseif($loop->index == 1)
                        @php $actualKey = '8 a 14 días atrás'  @endphp
                    @elseif($loop->index == 2)
                        @php $actualKey = '15 a 21 días atrás'  @endphp
                    @elseif($loop->index == 3)
                        @php $actualKey = '22 a 29 días atrás'  @endphp
                    @elseif($loop->index == 4)
                        @php $actualKey = 'Fuera de Rango'  @endphp
                    @endif
                    @foreach($week as $activity)
                        <tr>
                            <td>{{$activity->name}}</td>
                            <td>{{round($activity->distance/1000,2)}}</td>
                            <td>{{gmdate("H:i:s",$activity->moving_time)}}</td>
                            <td class="hidden sm:table-cell">{{gmdate("H:i:s",$activity->elapsed_time)}}</td>
                            <td class="hidden sm:table-cell">{{$activity->total_elevation_gain}}</td>
                            <td class="hidden sm:table-cell">{{$activity->type}}</td>
                            <td class="hidden sm:table-cell">{{date_format(date_create($activity->start_date), 'Y-m-d')}}
                            </td>
                            <td class="hidden sm:table-cell">{{$actualKey}}</td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
        </div>
    </div>
</div>
