<x-landing.layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-auto fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="mb-2 text-lg flex flex-col">
        	<span>Paciente: {{$appointment->nombre_paciente}}</span>
        	<span>Profesional: {{$appointment->nombre_profesional}}</span>
        	<span>Fecha: {{$appointment->fecha}} {{Carbon\Carbon::parse($appointment->hora_inicio)->format('H:i')}}
            </span>
            <span>Valor: {{Helper::moneda_chilena($atention->total)}}</span>
        </div>
        <!-- AppointmenMl find -->
        @if(!App\Models\AppointmentMl::where('Tratamiento_Nr',$appointment->id_atencion)->first()->ispay)
            <x-custompay class id="{{$appointment->id}}">Pagar y Confirmar Hora</x-custompay>
        @else
            <span class="normal-button bg-green-500">Pagado</span>
        @endif

        @if(in_array($appointment->estado_cita, ['Agenda Online', 'No confirmado']))
            <form action="/apim/addAppointment" method="POST">
                @csrf
                <input type="hidden" name="id_appointment" value="{{$appointment->id}}">
                <input type="hidden" name="id_estado" value="{{$appointment->id_estado}}">
                <input class="normal-button bg-blue-500"  type="submit" value="Confirmar Hora">
            </form>
        @else
            <form action="/apim/addAppointment" method="POST">
                @csrf
                <input type="hidden" name="id_appointment" value="{{$appointment->id}}">
                <input type="hidden" name="id_estado" value="{{$appointment->id_estado}}">
                <input class="normal-button bg-red-500"  type="submit" value="Anular Hora">
            </form>
        @endif


        
        


    </x-auth-card>
</x-landing.layout>