<x-admin.layout>
	<div class="bg-white  p-4">
		<h1 class="text-3xl font-bold text-gray-600">
	        Alianzas
	    </h1>
	</div>
	<div class="flex">
		<div class="bg-white p-4 m-2 shadow overflow-hidden sm:rounded-md w-1/2 h-1/2">
			Crear Alianza Nueva
			<x-admin.input class="mt-2" type="text" name="name" value="" readonly="edit" >Nombre</x-admin.input>
			<x-admin.input class="mt-2" type="text" name="number" value="" readonly="edit" >Descuento</x-admin.input>
			<input type="" name="">
		</div>
		<div class="bg-white m-2 shadow overflow-hidden sm:rounded-md w-1/2">
			<livewire:alliance-table/>
		</div>
	</div>
</x-admin.layout>
