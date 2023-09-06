@component('mail::message')
# ¡Hola {{$nombreUsuario}}!

<p>
Esperamos que te encuentres bien. Hemos notado que hace un tiempo no has consultado con nosotros, nos alegra saber que no has tenido lesiones ni problemas de salud, pero una revisión de rutina nunca está de más.
</p>
<p>
En You Just Better, estamos comprometidos con tu bienestar y nos gustaría invitarte a volver a experimentar nuestros servicios. Puedes elegir entre una variedad de opciones, que incluyen:
</p>
<ul>
    <li>Kinesiología</li>
    <li>Nutrición</li>
    <li>Traumatología</li>
    <li>Entrenamiento</li>
    <li>Masoterapia</li>
    <li>Medicina Deportiva</li>
    <li>Biomecánica</li>
</ul>

@component('mail::button', ['url' => 'https://api.whatsapp.com/send?phone=56933809726&text=Hola%2C%20%0A%0AQuiero%20pedir%20una%20hora%20con%20el%2010%25%20de%20dscto%20que%20me%20ofrecieron%20por%20mail%20%3A)'])
Contáctanos
@endcomponent

<p>
Como muestra de nuestro agradecimiento por tu confianza en nosotros, te ofrecemos un 10% de descuento adicional por una compra única en el servicio que elijas.
</p>

<p>
Recuerda que tu salud y bienestar son nuestra principal prioridad. Si tienes alguna pregunta o deseas programar una cita, no dudes en ponerte en contacto con nosotros.
</p>

<p>
Esperamos verte pronto y cuidar de ti como te mereces.

¡Te esperamos con los brazos abiertos!

</p>

Saludos,<br>
Team You
<img src="http://justbetter.cl/img/logo.png" alt="" style="max-width: 40%; background-color: #2C2C2C; padding:10px; display: block">
@endcomponent
