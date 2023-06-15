@component('mail::message')
# Hola {{$selled_pack->user_name}}

<p style="color: rgb(243, 143, 125) ">Muchas gracias por tu compra, adjuntamos tu boleta.</p>

@component('mail::button', ['url' => $emit['UrlBoleta']])
Boleta
@endcomponent


Saludos,<br>
Team You
<img src="http://justbetter.cl/img/logo.png" alt="" style="max-width: 40%; background-color: #2C2C2C; padding:10px; display: block">
@endcomponent
