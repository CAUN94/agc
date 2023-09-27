@component('mail::message')

# Hola {{ $emailData['contactName'] }},

<p>Espero que hayas tenido una muy buena celebración de fiestas patrias. Te escribo por la alianza que tienen en {{ $emailData['allianceName'] }} con You, ya que estamos actualizando las bases de datos de nuestras alianzas para poder aplicar correctamente los beneficios a sus alumnos.</p>
    
<p>Para esto, te pido por favor nos puedas mandar un listado en excel de tus alumnos que contenga, nombre, apellido paterno y materno, rut y mail. En caso de no tener alguno de esos datos, dejar ese espacio en blanco pero enviar los que sí tienen.</p>
    
<p>Quedo atento a cualquier duda que puedas tener, Gracias por tu ayuda !</p>

Con cariño,<br>
Team You
<img src="http://justbetter.cl/img/logo.png" alt="" style="max-width: 40%; background-color: #2C2C2C; padding:10px; display: block">

@endcomponent
