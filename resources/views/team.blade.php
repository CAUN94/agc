<x-landing.layout>
	<x-landing.header>
	    <x-slot name="img">
	        <img src="{{asset('img/bg-first.jpg')}}">
	    </x-slot>

		Con una visión basada en el nuevo paradigma de la salud informática y centrada en la tecnología (Salud 4.0 o healthtech), You trabaja en el desarrollo tecnológico en la salud y en la creación de medios digitales que permiten lograr la personalización y la atención de alto valor centrada en el paciente en todo el proceso de atención en salud.

	</x-landing.header>

	<x-landing.team-service></x-landing.team-service>

	<x-landing.team-cards :team="$team">

	</x-landing.team-cards>

	<x-landing.contact>
	</x-landing.contact>

</x-landing.layout>
