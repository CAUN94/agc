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
        <h1>Agenda de {{$value["nombre"]}} {{$value["apellidos"]}}</h1><br>
        <p>
            @foreach($professional as $key => $day)
                @php $date = Carbon\Carbon::createFromFormat('Y-m-d', $key) @endphp
                @php $now= Carbon\Carbon::now()->format('Y-m-d') @endphp
                @if($date < $now)
                    @continue
                @endif
                @php $count = 0 @endphp
                @foreach($day as $hour)
                    @if($hour['id'] == "")
                        @php $count = $count + 1 @endphp
                    @endif
                @endforeach
                @if($count == 0)
                    @continue
                @endif
                {{$days_dias[$date->format('l')]}}:
                @foreach($day as $hour)
                    @php
                    $hour = json_encode($hour,true);
                    $hour = json_decode($hour,true);
                    @endphp
                    @if($hour['id'] == "")
                        {{substr_replace($hour['inicio'] ,"", -3)}}
                    @endif
                @endforeach
                <br>
            @endforeach
        </p>
    </div>
</x-landing.layout>
