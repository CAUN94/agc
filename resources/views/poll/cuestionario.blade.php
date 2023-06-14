{{-- Para poder agregar una pregunta también hay que agregar la validación en el controlador "FormData.php" --}}

<x-poll.layout action="cuestionario">
    @slot('title')
        Cuestionario Actividad Física y Bienestar
    @endslot
    @slot('text')
        Este cuestionario está basado en el Cuestionario Mundial sobre Actividad Física (GPAQ) e incluye preguntas complementarias de Bienestar  preparadas por el equipo clínico de You Just Better
    @endslot

    <x-poll.mail></x-poll.mail>

    <x-poll.box>
        <x-poll.box-text>

        Actividad Física

        A continuación voy a preguntarle por el tiempo que pasa realizando diferentes tipos de actividad física. Le ruego que intente contestar a las preguntas aunque no se considere una persona activa.<br>
        En estas preguntas, las "actividades físicas intensas" se refieren a aquellas que implican un esfuerzo físico importante y que causan una gran aceleración de la respiración o del ritmo cardíaco.<br>
        Por otra parte, las "actividades físicas de intensidad moderada" son aquellas que implican un esfuerzo físico moderado y causan una ligera aceleración de la respiración o del ritmo cardíaco.
        </x-poll.box-text>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-text>

        En el Trabajo<br>
        Piense primero en el tiempo que pasa en el trabajo, que se trate de un empleo remunerado o no, de estudiar, de mantener su casa, de cosechar, de pescar, de cazar, de buscar trabajo o estar de vacaciones.
        </x-poll.box-text>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P1. ¿Exige su trabajo una actividad física intensa que implica una aceleración importante de la respiración o del ritmo cardíaco, como [levantar pesos, cavar o trabajos de construcción] durante al menos 10 minutos consecutivos? <br>
        <br>
        <strong>En caso que su respuesta sea NO, saltar a la P4</strong>
        </x-poll.box-title>

        <x-poll.radio-answer>
            Sí,No,P1
        </x-poll.radio-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P2. En una semana típica, ¿cuántos días realiza usted actividades físicas intensas en su trabajo?<br>
        Número de Días
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                P2
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P3. En uno de esos días en los que realiza actividades físicas intensas, ¿cuánto tiempo suele dedicar a esas actividades?<br>
        Horas: Minutos
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                P3
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P4. ¿Exige su trabajo una actividad de intensidad moderada que implica una ligera aceleración de la respiración o del ritmo cardíaco, como caminar deprisa [o transportar pesos ligeros] durante al menos 10 minutos consecutivos?
        <br>En caso que su respuesta sea NO, saltar a la P7
        </x-poll.box-title>

        <x-poll.radio-answer>
            Sí,No,P4
        </x-poll.radio-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P5.  En una semana típica, ¿Cuántos días realiza usted actividades de intensidad moderada en su trabajo?
        Número de días
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                P5
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P6. En uno de esos días en los que realiza actividades físicas de intensidad moderada, ¿Cuánto tiempo suele dedicar a esas actividades?<br>
        Horas:Minutos
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                P6
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-text>
        Para Desplazarse<br>
        En las siguientes preguntas dejaremos de lado las actividades físicas en el trabajo de las que ya hemos tratado. Ahora me gustaría saber cómo se desplaza de un sitio a otro.
        </x-poll.box-text>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P7. ¿Camina usted o usa usted una bicicleta al menos 10 minutos consecutivos en sus desplazamientos?<br>
        En caso que su respuesta sea NO, saltar a la P10
        </x-poll.box-title>

        <x-poll.radio-answer>
            Sí,No,P7
        </x-poll.radio-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P8.  En una semana típica, ¿Cuántos días camina o va en bicicleta al menos 10 minutos consecutivos en sus desplazamientos?<br>
        Número de Días
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                P8
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P9. En un día típico, ¿Cuánto tiempo pasa caminando o yendo en bicicleta para desplazarse?
        <br>Horas:Minutos
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                P9
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-text>
        En el Tiempo Libre<br>
        Las preguntas que van a continuación excluyen la actividad física en el trabajo y para desplazarse que ya hemos mencionado. Ahora me gustaría tratar de deportes, fitness u otras actividades físicas que practica en su tiempo libre.
        </x-poll.box-text>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P10. ¿En su tiempo libre, practica usted deportes/fitness intensos que implican una aceleración importante de la respiración o del ritmo cardíaco como [correr, jugar al fútbol] durante al menos 10 minutos consecutivos?<br>
        En caso que su respuesta sea NO, saltar a la P13
        </x-poll.box-title>

        <x-poll.radio-answer>
            Sí,No,P10
        </x-poll.radio-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P11.  En una semana típica, ¿Cuántos días practica usted deportes/fitness intensos en su tiempo libre?<br>
        Número de Días
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                P11
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P12.  En uno de esos días en los que practica deportes/fitness intensos, ¿Cuánto tiempo suele dedicar a esas actividades?<br>
        Horas:Minutos
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                P12
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P13. ¿En su tiempo libre practica usted alguna actividad de intensidad moderada que implica una ligera aceleración de la respiración o del ritmo cardíaco, como caminar deprisa, [ir en bicicleta,  nadar, jugar al volleyball] durante al menos 10 minutos consecutivos? *
        <strong>En caso que su respuesta sea NO, saltar a la P16</strong>
        </x-poll.box-title>

        <x-poll.radio-answer>
            Sí,No,P13
        </x-poll.radio-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P14.  En una semana típica, ¿Cuántos días practica usted actividades físicas de intensidad moderada en su tiempo libre?<br>
        Horas:Minutos
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                P14
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P15.  En uno de esos días en los que practica actividades físicas de intensidad moderada, ¿Cuánto tiempo suele dedicar a esas actividades?<br>
        Horas:Minutos
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                P15
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-text>
        Comportamiento Sedentario<br>
        La siguiente pregunta se refiere al tiempo que suele pasar sentado o recostado en el trabajo, en casa, en los desplazamientos  o con sus amigos. Se incluye el tiempo pasado [ante una mesa de trabajo, sentado con los amigos, viajando en autobús o en tren, jugando a las cartas o viendo la televisión], pero no se incluye el tiempo pasado durmiendo.
        </x-poll.box-text>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P16. ¿Cuándo tiempo suele pasar sentado o recostado en un día típico?<br>
        Horas:Minutos
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                P16
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-text>
        Bienestar<br>
        Las siguientes preguntas tienen por objetivo sondear tu situación de bienestar desde otros puntos de vista más allá de la Actividad Física.
        </x-poll.box-text>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P17. ¿Tienes un malestar físico (ej. lesión) que te limite a realizar alguna actividad (física, social,laboral, académica, etc)?
        </x-poll.box-title>

        <x-poll.radio-answer>
            Sí,No,P17
        </x-poll.radio-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P18. ¿Estás conforme con tu peso actual?
        </x-poll.box-title>

        <x-poll.radio-answer>
            Sí,No,P18
        </x-poll.radio-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P19. ¿Cuántas veces a la semana te alimentas con ultraprocesados como comida rápida, delivery, snacks?
        </x-poll.box-title>

        <x-poll.radio-answer>
            1 o menos,2 a 4,5 o más,P19
        </x-poll.radio-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P20. ¿Te sientes en un nivel de stress que te perjudique?
        </x-poll.box-title>

        <x-poll.radio-answer>
            Sí,No,P20
        </x-poll.radio-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        P21. ¿Tienes alguna meta u objetivo en el que creas que podemos ayudarte? (ej. competencia, maratón, pre temporada, "estar fit", volver a entrenar, post parto etc)
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                P21
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        Selecciona la opción que se adecúe a ti. En cuanto a pausas activas:
        </x-poll.box-title>

        <x-poll.radio-answer>
        Las conozco y hago recurrentemente,Las conozco, he hecho alguna vez,Las conozco, nunca he hecho y me gustaría hacer,Las conozco y no me interesa hacer,No sé lo que son las pausas activas,PA
        </x-poll.radio-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
        ¿Quieres acceder a los beneficios de alianza que ofrece You Just Better para tu organización (descuentos en sesiones, charlas de bienestar, pausas activas y más)? Déjanos tu nombre, mail, teléfono de contacto e información adicional que consideres relevante.<br>Nosotros somos You Just Better, y nos puedes encontrar en you@justbetter.cl, +569 3380 9726 ig:  @you.justbetter web: www.yjb.cl
        </x-poll.box-title>

        <x-poll.text-answer>
            @slot('name')
                Comment
            @endslot
        </x-poll.text-answer>
    </x-poll.box>

</x-poll.layout>
