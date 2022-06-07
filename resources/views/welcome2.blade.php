<x-landing2.layout>
        <x-landing2.header>

        </x-landing2.header>

        <x-landing2.call>
        </x-landing2.call>

        <x-landing2.service>
        </x-landing2.service>

        <x-landing2.why-us>
        </x-landing2.why-us>

        <x-landing2.contact>
            <x-slot name="img">
                img1.jpg|img3.jpg|img4.jpg
            </x-slot>
        </x-landing2.contact>

        <x-landing2.team>
        </x-landing2.team>

        <x-landing2.alliance>
        </x-landing2.alliance>

        <x-landing2.reviews>
        </x-landing2.reviews>

        <x-landing2.instagram>
        </x-landing2.instagram>

        <x-slot name="script">
            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
            <script src="{{ asset('js/map.js')}}"></script>
        </x-slot>

</x-landing2.layout>
