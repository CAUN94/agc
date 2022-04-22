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
                @if(Carbon\Carbon::parse($key)->endofday()>=Carbon\Carbon::now())
                    @php $days_w_hours = array_filter($day,function($var){ if( $var["id"] == ""){return $var;}}) @endphp
                    @if(count($day)>0 and count($days_w_hours))
                        @foreach($days_w_hours as $hour)
                            @if($loop->first)
                                {{$days_dias[Carbon\Carbon::parse($hour['fecha'])->format('l')]}}:
                            @endif
                            @if(Carbon\Carbon::now()->format('H:i') <=
                            Carbon\Carbon::parse($hour['inicio'])->format('H:i'))
                                {{Carbon\Carbon::parse($hour['inicio'])->format('H:i')}}
                            @endif
                            @if($loop->last)
                                <br>
                            @endif
                        @endforeach
                    @endif
                @endif
            @endforeach
        </p>
    </div>
</x-landing.layout>
