<x-landing.layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-auto fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <div class="mb-2 text-lg flex flex-col">
        	<span>Paciente: {{$appointmentMl->Nombre_paciente}} {{$appointmentMl->Apellidos_paciente}}</span>
        	<span>Profesional: {{$appointmentMl->Profesional}}</span>
        	<span>Fecha: {{$appointmentMl->dayhour()}}</span>
        	<span>Valor: {{$appointmentMl->treatments()->totalPrice()}}</span>
        </div>
        <x-custompay class appointmentMl="{{$appointmentMl->id}}">Pagar Plan</x-custompay>

    </x-auth-card>
</x-landing.layout>
