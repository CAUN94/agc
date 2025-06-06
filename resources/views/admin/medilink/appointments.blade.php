<x-admin.layout>
    <div class="bg-white  p-4 flex justify-between w-full mr-3">
        <h1 class="admin-title-nav">
            Tabla de Appointments Medilink
        </h1>
        <a href="/scraping-appointmentml" class="text-lg no-underline  hover:underline text-primary-500 hover:text-primary-900">Recargar</a>
    </div>
    <div class="container mx-auto mt-4 px-4">
        <livewire:datatable model="App\Models\AppointmentMl" exclude="id" />
    </div>
</x-admin.layout>
