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
        <x-custompay class id="{{$appointment->id}}">Pagar Plan</x-custompay>
        
        


    </x-auth-card>
</x-landing.layout>
