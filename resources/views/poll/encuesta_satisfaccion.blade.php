{{-- Para poder agregar una pregunta también hay que agregar la validación en el controlador "FormData.php" --}}

<x-poll.layout action="encuesta_satisfaccion">
    @slot('title')
        Encuesta seguimiento y satisfacción usuario/a
    @endslot
    @slot('text')
        El objetivo de esta encuesta es generar un seguimiento de su atención, obtener feedback de su condición de salud y su percepción de la calidad de su atención.
    @endslot
    <x-poll.rut>
    </x-poll.rut>

    <x-poll.box>
        <x-poll.box-title>
        En una escala del 0% al 100%, siendo 100% lo normal o lo mejor para usted.
        ¿Cómo puntuaría el estado actual de su lesión o dolor?
        </x-poll.box-title>

        <x-poll.likert>0%,100%,0,10,pain</x-poll.likert>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
            En relación a su última atención. ¿Qué tan satisfecho se encuentra con la atención brindada?
        </x-poll.box-title>

        <x-poll.likert>Poco Satisfecho,Muy Satisfecho,1,10,satisfaction</x-poll.likert>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
            Puntuando del 1 al 5 e incluyendo desde el ingreso en recepción hasta la atención del
            profesional de salud ¿Con qué nota calificaría su experiencia en You?
        </x-poll.box-title>

        <x-poll.likert>Mala,Muy Buena,1,5,experience</x-poll.likert>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
            Con respecto a su última atención. ¿Qué probabilidad existe de que nos recomiende a un
            amigo o colega?
        </x-poll.box-title>

        <x-poll.likert>0%,100%,1,5,friend</x-poll.likert>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
            ¿Cuales fueron las cosas que más te gustaron de You?
        </x-poll.box-title>

        <x-poll.checkbox-answer>
            El trabajo de los internos,El gimnasio,El lugar,La atención que me dieron,La accesibilidad del lugar,gustos
        </x-poll.checkbox-answer>
    </x-poll.box>

    <x-poll.box>
        <x-poll.box-title>
            Nos encantaría mejorar. ¿Nos podrías comentar algo que te gustaría que cambiáramos?
        </x-poll.box-title>

        <x-poll.text-answer></x-poll.text-answer>
    </x-poll.box>
</x-poll.layout>
