@component('mail::message')
# ¡Hola {{$nombreUsuario}}!

<p style="color: rgb(243, 143, 125) ">
Esperamos que te encuentres bien. Hemos notado que hace un tiempo no has consultado con nosotros, nos alegra saber que no has tenido lesiones ni problemas de salud, pero una revisión de rutina nunca está de más.
</p>
<p style="color: rgb(243, 143, 125) ">
En You Just Better, estamos comprometidos con tu bienestar y nos gustaría invitarte a volver a experimentar nuestros servicios. Puedes elegir entre una variedad de opciones, que incluyen:
</p>
<ul>
    <li>Kinesiología</li>
    <li>Nutrición</li>
    <li>Traumatología</li>
    <li>Entrenamiento</li>
    <li>Medicina Deportiva</li>
    <li>Biomecánica</li>
</ul>

@component('mail::button', ['url' => 'yjb.cl/youphone'])
    Contactanos
@endcomponent

<p style="color: rgb(243, 143, 125) ">
Como muestra de nuestro agradecimiento por tu confianza en nosotros, te ofrecemos un 10% de descuento adicional por una compra única en el servicio que elijas.
</p>

<p style="color: rgb(243, 143, 125) ">
Recuerda que tu salud y bienestar son nuestra principal prioridad. Si tienes alguna pregunta o deseas programar una cita, no dudes en ponerte en contacto con nosotros.
</p>

<p style="color: rgb(243, 143, 125) ">
Esperamos verte pronto y cuidar de ti como te mereces.

¡Te esperamos con los brazos abiertos!

</p>

Saludos,<br>
Team You
<img src="http://justbetter.cl/img/logo.png" alt="" style="max-width: 40%; background-color: #2C2C2C; padding:10px; display: block">
@endcomponent
