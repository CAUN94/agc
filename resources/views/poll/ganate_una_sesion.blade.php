{{-- Para poder agregar una pregunta también hay que agregar la validación en el controlador "FormData.php" --}}

<x-poll.layout action="ganate_una_sesion">
    @slot('title')
        Gana una sesión de ¡xxxx gratuita!
    @endslot
    @slot('text')
        Participa por una evaluación preventiva con nuestra deportologa o con nuestro director clínico o kinesiólogo o una evaluación física gratuita con nuestros preparadores físicos" (lo que puede ser más llamativo para los ex usuarios y haga que quieran participar).
        <br><br>
        Respondiendo las siguientes preguntas:
        <br><br>
        *Todas las respuestas son de carácter confidencial y con el único propósito de conocer y mejorar el grado de satisfacción de nuestros usuarios.
    @endslot
    <x-poll.box>
        <x-poll.box-title>Correo electrónico</x-poll.box-title>

        <x-poll.field name="mail" type="email" :value="old('mail')">

        </x-poll.field>
    </x-poll.box>

    <center style="color:#fff"> Aquí falta la imagen </center>

    <x-poll.box>
        <x-poll.box-title>
            En la imagen de arriba, encontrarás todos los servicios de nuestra casa You: ¿Los conocías?
        </x-poll.box-title>

        <x-poll.radio-answer>
            Sí,No,services-radio
        </x-poll.checkbox-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
            ¿Qué servicio(s) has utilizado? Puedes marcar más de una.
        </x-poll.box-title>

        <x-poll.checkbox-answer>
            Kinesiólogía,Entrenamiento Personalizado,Entrenamiento Grupal,Recovery,Medicina Deportiva,Nutrición,Biomecánica,Nutriología,Psicología Deportiva,Psicología Clínica,Traumatología,Medicina General,Life Style Medicine,services
        </x-poll.checkbox--answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
            ¿Cómo calificarías tu experiencia en You?
        </x-poll.box-title>

        <x-poll.radio-answer>
            Mala,Regular,Buena,Muy Buena,satisfaction
        </x-poll.radio-answer>

        {{-- <x-poll.text-answer></x-poll.text-answer> --}}
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
            ¿Qué servicio(s) es/son de tú interés, actualmente? Puedes marcar más de una.
        </x-poll.box-title>

        <x-poll.checkbox-answer>
            Kinesiólogía,Entrenamiento Personalizado,Entrenamiento Grupal,Recovery,Medicina Deportiva,Nutrición,Biomecánica,Nutriología,Psicología Deportiva,Psicología Clínica,Traumatología,Medicina General,Life Style Medicine,servicesinterest
        </x-poll.checkbox--answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
            Por último, ¿Tienes alguna sugerencia respecto a los servicios y/o calidad de atención de nuestro centro?
        </x-poll.box-title>

        <x-poll.text-answer></x-poll.text-answer>
    </x-poll.box>


</x-poll.layout>
