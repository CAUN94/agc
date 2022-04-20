@component('mail::message')
# Inscripción {{$user->fullName()}} en Entrenamiento

Estamos muy felices de tu inscripción en el plan {{$user->student()->trainingPlan()}}.
Este iniciará el {{$user->student()->start_day}}.

En tu perfil encontraras habilitada la opción de pago.
@component('mail::button', ['url' => url('/users')])
Perfil
@endcomponent

Además te dejamos invitado a que revises nuestras horas disponibles.
@component('mail::button', ['url' => url('/students')])
Horarios
@endcomponent
Es muy importante que reserves tus clases.

Saludos,<br>
Team You
<img src="http://justbetter.cl/img/logo.png" alt="" style="max-width: 40%; background-color: #2C2C2C; padding:10px; display: block">
@endcomponent
