<x-landing.layout>

        <x-landing.header>
            <x-slot name="img">
                <img src="{{asset('img/bg-first.jpg')}}">
            </x-slot>

            You, Just Better es un centro integral de salud y medicina deportiva que promueve los estilos de vida saludables, entregando un servicio de atención personalizada y adaptando la integridad de nuestros servicios al proceso de autorealización.

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
