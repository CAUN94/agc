<x-landing.layout>
        <x-landing.header>
            <x-slot name="img">
                bg-first.jpg|bg-first.jpg|bg-first.jpg
            </x-slot>
            <x-slot name="text">
                You, Just Better es un centro integral de salud y medicina deportiva que promueve los estilos de vida saludables, entregando un servicio de atención personalizada y adaptando la integridad de nuestros servicios al proceso de autorealización.|El área de entrenamiento de You busca desde su base el presentar el ejercicio físico de manera amigable y cercana, donde la invitación está puesta hacia aumentar el movimiento de la persona, preocupándonos de manera individualizada por el bienestar del alumno.|Se desarrolla en un ámbito clínico docente, especializado y personalizado, usando la educación, ejercicio, terapia manual ortopédica y razonamiento clínico como herramientas. Bajo un modelo personalizado, su finalidad es rehabilitar y/o realizar un reintegro deportivo correcto y eficiente para quienes hayan sufrido alguna lesión, tengan molestia o dolor y deseen volver a sus actividades normales.
            </x-slot>
            <x-slot name="url">
                0|/trainings|https://f8f6bc91ed06a41fb6527cdbb7dd65b9638c84fd.agenda.softwaremedilink.com/agendas/agendamiento
            </x-slot>

        </x-landing.header>

        <x-landing.service>
        </x-landing.service>

        <x-landing.call>
        </x-landing.call>

        <x-landing.instagram>
        </x-landing.instagram>

        <x-landing.contact>
        </x-landing.contact>

        <x-slot name="script">
            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
            <script src="{{ asset('js/map.js')}}"></script>
        </x-slot>

</x-landing.layout>
