@component('mail::message')
# Nuevo Usuario Registrado en Entrenamiento {{$user->fullname()}}

- Nombre: {{$user->fullname()}}
- Rut: {{$user->rut}}
- Genero: {{$user->gender()}}
- Mail: {{$user->email}}
- Celular: {{$user->phone}}
- Fecha de Nacimiento: {{$user->birthday}}

{{$user->student->trainingPlan()}}
- Fecha de Inicio: {{$user->student->start_day}}
- Precio: {{$user->student->trainingPrice()}}

Saludos,<br>
Team You
<img src="http://justbetter.cl/img/logo.png" alt="" style="max-width: 40%; background-color: #2C2C2C; padding:10px; display: block">
@endcomponent
