<x-admin.layout>
	<div class="bg-white p-4">
		<h1 class="text-3xl font-bold text-gray-600">
	        Encuesta de Satisfacción
	    </h1>
	</div>
	<livewire:datatable
	model="App\Models\EncuestaSatisfaccion"
	hideable="select"
	searchable="rut,pain,satisfaction,experience,friend,comment,gustos,created at"
    exportable
	exclude="updated_at,id" />
</x-admin.layout>
