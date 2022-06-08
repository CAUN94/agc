<x-admin.layout>
	<div class="bg-white  p-4">
		<h1 class="text-3xl font-bold text-gray-600">
	        Alianzas
	    </h1>
	</div>
	<div class="flex">
		<div class="bg-white p-4 m-2 shadow overflow-hidden sm:rounded-md w-1/2 h-72">
			Crear Alianza Nueva
			<form action="/adminalliance/create" method="POST">
				@csrf
				<x-admin.input class="mt-2" type="text" name="name" value="" readonly="edit" >Nombre</x-admin.input>
				<x-admin.input class="mt-2" type="number" name="desc" value="" readonly="edit" >Descuento</x-admin.input>
				<div class="flex justify-end">
					<input type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer mt-2">
				</div>
			</form>
		</div>
		<div class="bg-white m-2 shadow overflow-hidden sm:rounded-md w-1/2">
			<livewire:alliance-table/>
		</div>
	</div>
</x-admin.layout>
