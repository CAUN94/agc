<x-landing.layout>
<div x-data="{ exampleOpen: true }">
<button class="text-white text-lg w-full bg-primary-500 hover:bg-primary-900 text-center text-sm text-gray-900 sm:mt-0 sm:col-span-2 py-2 cursor-pointer" x-on:click="exampleOpen = ! exampleOpen">Cambiarme a Este Plan</button>
<x-landing.modal>
	<x-slot name="xshow">
		exampleOpen
	</x-slot>

	<x-slot name="title">
		<span>Cambiarme a plan </span>
	</x-slot>

	¿Estas seguro de querer cambiarte?

	<x-slot name="important">
	El cambio de plan quedaria para el proximo periodo de pago.
	</x-slot>

	<x-slot name="button">
		Cerrar
	</x-slot>

</x-landing.modal>
</div>

</x-landing.layout>
