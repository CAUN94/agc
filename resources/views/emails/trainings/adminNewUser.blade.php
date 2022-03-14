@component('mail::message')
# Nuevo Usuario Registrado {{$user->fullname()}}

- Nombre: {{$user->fullname()}}
- Ruu: {{$user->rut}}
- Genero: {{$user->gender()}}
- Mail: {{$user->email}}
- Celular: {{$user->phone}}
- Fecha de Nacimiento: {{$user->birthday}}

Saludos,<br>
Team You
<img src="http://justbetter.cl/img/logo.png" alt="" style="max-width: 40%; background-color: #2C2C2C; padding:10px; display: block">
@endcomponent
