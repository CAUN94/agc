<x-landing.layout>
        <x-landing.header>
            <x-slot name="img">
                bg-first.jpg|bg-gym.jpg
            </x-slot>
            <x-slot name="text">
                You, Just Better es un centro integral de salud y medicina deportiva que promueve los estilos de vida saludables, entregando un servicio de atención personalizada y adaptando la integridad de nuestros servicios al proceso de autorealización.|
                El área de entrenamiento de You busca desde su base el presentar el ejercicio físico de manera amigable y cercana, donde la invitación está puesta hacia aumentar el movimiento de la persona, preocupándonos de manera individualizada por el bienestar del alumno.<br>Llegamos a nuestro a alumnos en formato presencial, online e híbrido. Por motivos de la contingencia mundial COVID-19, la modalidad presencial será posible sólo si las medidas sanitarias propuestas por el MINSAL lo permiten.

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
