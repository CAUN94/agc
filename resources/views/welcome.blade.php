<x-landing.layout>
        <!-- <a href="/packverano">
            <img src="{{ asset('img/fotos/banner.png')}}" style="max-width: 100%;height: auto;">
        </a>  -->
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

        </x-landing.team>

        <!-- <x-landing.team>
            <x-slot name="img">
                fotos-01.jpg|fotos-02.jpg|fotos-03.jpg|fotos-04.jpg|fotos-05.jpg|fotos-06.jpg|fotos-08.jpg
            </x-slot>
            <x-slot name="texts">
                Alonso Niklischeck|Camila Valentini|Matias Rebolledo|Jaime Pantoja|César Moya|Melissa Ross|Cristóbal Ugarte
            </x-slot>
            <x-slot name="team">
                Kinesiologo|Kinesiologa|Entrenador|Kinesiologo|Kinesiologo|Nutricionista|Desarrollador
            </x-slot>
        </x-landing.team> -->

        <div id="embajadores"></div>
        <x-landing.alliance>
            <x-slot name="img">
                cesar.jpg|cotie.jpg|javi.jpg|katherine.jpg|sofi.jpg
            </x-slot>
            <x-slot name="texts">
                Cesar Diaz|Coti Echeverri|Javiera Errázuriz|Katherine Cañete|Sofia Cofre Saphier
            </x-slot>
            <x-slot name="team">
                Atleta y Entrenador|Corredora|Record Chileno 400m con Vallas|Montañista, Ciclista y Runner
            </x-slot>
            <x-slot name="description">
                Soy atleta aficionado, profesor de educación física y padre de familia. Practico atletismo desde los 18 años, cuando lo conocí en la Universidad, y me desempeño en las pruebas de medio fondo y fondo. Actualmente trabajo como profesor de colegio San Francisco de Asís, entrenador de la selección de cross country y atletismo (medio fondo/fondo) de la Pontificia Universidad Católica de Chile, entrenador de RunClub y Nike Running Club Santiago.|Hola! Soy Coti Echeverría, atleta nacional, corredora de 400 metros planos. Orgullosa madres de 4 pequeños y directora de proyectos de Fundación Ganbaru. Me siento afortunada de ser parte de la familia You. Su apoyo ha sido vital para esta nueva etapa de atleta adulta. Y me ha permitido llevar mi cuerpo a su maximo potencial alcanzando un desempeño deportivo que jamás imagine a mi edad||Soy una profesora de educación física que el destino quiso que encontrara su pasión en los cerros. Al principio no lo tenía claro, pero el tiempo me llevó a amar mi trabajo. Soy una persona persistente, valiente y auténtica cualidades que han servido para sentirme orgullosa de quién soy hoy.|Atleta de montaña con record femenino de ascenso al Cerro el Plomo (5424 msnm) y Volcán San José (5856 msnm), además de numerosas cumbres técnicas de nuestro país y podio en carreras de ultra distancia.

            </x-slot>
            <x-slot name="insta">
                https://instagram.com/cesardiazhz?igshid=YmMyMTA2M2Y=|https://instagram.com/gringaperochilena?igshid=YmMyMTA2M2Y=|https://instagram.com/javi.errazurizs?igshid=YmMyMTA2M2Y=|https://instagram.com/pausaphier?igshid=YmMyMTA2M2Y=
            </x-slot>
        </x-landing.alliance>

        <div id="testimonios"></div>
        <x-landing.reviews>
        </x-landing.reviews>

{{--         <x-landing.instagram>
        </x-landing.instagram> --}}

        <x-slot name="script">
            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
            <script src="{{ asset('js/map.js')}}"></script>

            <script>function loadScript(a){var b=document.getElementsByTagName("head")[0],c=document.createElement("script");c.type="text/javascript",c.src="https://tracker.metricool.com/resources/be.js",c.onreadystatechange=a,c.onload=a,b.appendChild(c)}loadScript(function(){beTracker.t({hash:"6512313e663a34e312952e4bcd8fe576"})});</script>
        </x-slot>

</x-landing.layout>
