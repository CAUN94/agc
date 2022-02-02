<x-poll.layout>
    <x-poll.box>
        <x-poll.box-title>
        En una escala del 0 al 100%, siendo 100% lo normal o lo mejor para usted.
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
            Nos encantaría mejorar. ¿Nos podrías comentar algo que te gustaría que cambiáramos?
        </x-poll.box-title>

        <x-poll.text-answer></x-poll.text-answer>
    </x-poll.box>
</x-poll.layout>
