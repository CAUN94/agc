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
                fotos-01.jpg|fotos-02.jpg|fotos-03.jpg|fotos-04.jpg|fotos-05.jpg|fotos-06.jpg|fotos-07.jpg|fotos-08.jpg
            </x-slot>
            <x-slot name="texts">
                Alonso Niklischeck|Camila Valentini|Matias Rebolledo|Jaime Pantoja|Cesar Moya|Melissa Ross|Rocio Nuche|Cristóbal Ugarte
            </x-slot>
            <x-slot name="team">
                Kinesiologo|Kinesiologo|Entrenador|Kinesiologa|Kinesiologa|Nutricionista|Medico del Deporte|Desarrollador
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
                Atleta y Entrenador|Corredora|Record Chileno 400m con Vallas|Montañista, Ciclista y Runner
            </x-slot>
            <x-slot name="description">
                Soy Paula Cofré Saphier, 26 años, deportista de alto rendimiento de montaña, ciclismo, running y escalada. Ingeniera Civil Industrial de la Universidad de Chile|Hola! Soy Coti Echeverría, atleta nacional, corredora de 400 metros planos. Orgullosa madres de 4 pequeños y directora de proyectos de Fundación Ganbaru. Me siento afortunada de ser parte de la familia You. Su apoyo ha sido vital para esta nueva etapa de atleta adulta. Y me ha permitido llevar mi cuerpo a su maximo potencial alcanzando un desempeño deportivo que jamás imagine a mi edad|Yo soy una profesora de educación física que el destino quiso que encontrara su pasión en los cerros. Al principio no lo tenía claro, pero el tiempo me llevó a amar mi trabajo. Soy una persona persistente, valiente y auténtica cualidades que han servido para sentirme orgullosa de quién soy hoy.|Katherine Cañete Arredondo. Madre, esposa, corredora y entrenadora de Trail Running.

            </x-slot>
            <x-slot name="insta">
                https://instagram.com/cesardiazhz?igshid=YmMyMTA2M2Y=|https://instagram.com/gringaperochilena?igshid=YmMyMTA2M2Y=|https://instagram.com/javi.errazurizs?igshid=YmMyMTA2M2Y=|https://instagram.com/pausaphier?igshid=YmMyMTA2M2Y=
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
