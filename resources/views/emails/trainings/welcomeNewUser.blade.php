@component('mail::message')
# Bienvenid{{$user->genderLetter()}} {{$user->fullName()}}

Ya estas registrado en nuestra plataforma web.
Te invitamos a que actualices tu información.

@component('mail::button', ['url' => url('/users')])
Revisa tu perfil
@endcomponent

Te invitamos a que veas nuestros planes de entrenamiento.

@component('mail::button', ['url' => url('/users')])
Planes de Entrenamiento
@endcomponent

Saludos,<br>
Team You
<img src="http://justbetter.cl/img/logo.png" alt="" style="max-width: 40%; background-color: #2C2C2C; padding:10px; display: block">
@endcomponent
