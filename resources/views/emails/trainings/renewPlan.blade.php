@component('mail::message')
# Hola {{$user->fullName()}}

<p style="color: rgb(243, 143, 125) ">¿Listo para seguir entrenando con nosotros?</p>

<p>
	Tu plan {{$user->student()->trainingPlan()}} finalizara el {{$user->student()->lastdayformat()}}  y sabemos que estás motivado por seguir superándote, por lo que te recordamos que renueves tu plan.
</p>

<p style="font-weight: bold;font-style: italic;">Hazlo a través de nuestra plataforma, rápido y fácil</p>

@component('mail::button', ['url' => url('/renew')])
Renovar Plan
@endcomponent

Además, recuerda que debes <span style="color: rgb(243, 143, 125) ">reservar tus clases</span>, asegurando tus horarios y facilitando tu asistencia.

Saludos,<br>
Team You
<img src="http://justbetter.cl/img/logo.png" alt="" style="max-width: 40%; background-color: #2C2C2C; padding:10px; display: block">
@endcomponent
