<x-landing.layout>
    @php
    $days_dias = array(
        'Monday'=>'Lunes',
        'Tuesday'=>'Martes',
        'Wednesday'=>'Miércoles',
        'Thursday'=>'Jueves',
        'Friday'=>'Viernes',
        'Saturday'=>'Sábado',
        'Sunday'=>'Domingo'
        );
    @endphp
    <div class="bg-white p-4 w-1/3 mx-auto mt-10">
        <h1>Agenda de {{$professional->nombre}} {{$professional->apellidos}}</h1><br>
        <div class="flex flex-col">
            @foreach($appointments as $key1 => $appointment)
                @php
                    $appointment = (array) $appointment;
                @endphp 
                @if(count($appointment) > 0)
                    @php
                        $day = Carbon\Carbon::parse($key1)->format('l');
                        $day_number = Carbon\Carbon::parse($key1)->format('d');                         
                    @endphp
                    {{$days_dias[$day]}} {{$day_number}}: 
                    @foreach($appointment['horas'] as $key2 =>$hour)
                        {{$key2}}
                    @endforeach
                    <br>
                @endif
            @endforeach
        </div>
    </div>
</x-landing.layout>
