<x-admin.layout>
	<div class="bg-white  p-4">
		<h1 class="text-3xl font-bold text-gray-600">
	        Tabla de Clases {{Auth::user()->fullname()}}
	    </h1>
	</div>
	<div class="container mx-auto mt-4 px-4">
		<livewire:trainer-train-appointment></livewire:trainer-train-appointment>
	</div>
</x-admin.layout>
