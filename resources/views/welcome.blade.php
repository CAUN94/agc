<x-landing.layout>
        <x-landing.header>

        </x-landing.header>

        <x-landing.call>
        </x-landing.call>

        <div id="servicios"></div>
        <x-landing.service>
        </x-landing.service>


        <x-landing.why-us>
        </x-landing.why-us>

        <x-landing.contact>
            <x-slot name="img">
                img1.jpg|img3.jpg|img4.jpg
            </x-slot>
        </x-landing.contact>

        <div id="equipo"></div>
        <x-landing.team>
            <x-slot name="img">
                alonso.jpg|cesar.jpg|daniella.jpg|francisco.jpg|camila.JPG|jaime.JPG|melissa.jpg
            </x-slot>
            <x-slot name="texts">
                Alonso Niklischeck|Cesar Moya|Daniella Vivallo|Francisco Guzman|Camila Valentini|Jaime Pantoja|Melissa Ross
            </x-slot>
            <x-slot name="team">
                Kinesiologo|Kinesiologo|Kinesiologa|Entrenador|Kinesiologa|Kinesiologo|Nutricionista
            </x-slot>
        </x-landing.team>

        <div id="embajadores"></div>
        <x-landing.alliance>
            <x-slot name="img">
                cesar.png|gringa.png|javierra.png|Paus.png
            </x-slot>
            <x-slot name="texts">
                Cesar Diaz|Andi Mcrostie|Javiera Errázuriz|Paula Cofre Safier
            </x-slot>
            <x-slot name="team">
                Atleta y Entrenador|Corredora|Record Chileno 400m con Ballas|Montañista, Ciclista y Runner
            </x-slot>
        </x-landing.alliance>

        <div id="testimonios"></div>
        <x-landing.reviews>
        </x-landing.reviews>

        <x-landing.instagram>
        </x-landing.instagram>

        <x-slot name="script">
            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
            <script src="{{ asset('js/map.js')}}"></script>
        </x-slot>

</x-landing.layout>
