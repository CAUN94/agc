@component('mail::message')
# ¡Feliz Cumpleaños {{$user->name}}!

<p>
En este día especial como You queremos celebrarte y hacer que sea aun mejor!. 🎉
</p>

<p>
Nos encanta que formes parte de nuestra comunidad, y para disfrutar tu cumpleaños, te regalamos un 10% de descuento adicional en cualquiera de nuestros servicios. Queremos que disfrutes al máximo este día y que puedas consentirte como tú te mereces.
</p>

@component('mail::button', ['url' => 'https://api.whatsapp.com/send?phone=56933809726&text=Hola%2C%20%0A%0AQuiero%20usar%20el%20descuento%20de%2010%25%20que%20me%20dieron%20por%20mi%20cumplea%C3%B1os'])
Pide tu regalo
@endcomponent

<p>
Este descuento es solo para ti, así que asegúrate de aprovecharlo al máximo. ¡Es nuestro pequeño regalo para ti en tu día especial!
</p>

<p>
Esperamos que tengas un cumpleaños increíble, tengas un tremendo día y que se venga un nuevo año de vida lleno de éxitos. ¡Felicidades!
</p>






Con cariño,<br>
Team You
<img src="http://justbetter.cl/img/logo.png" alt="foto" style="max-width: 40%; background-color: #2C2C2C; padding:10px; display: block">
@endcomponent
