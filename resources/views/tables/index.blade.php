<x-admin.layout>
<div class="flex flex-row gap-3 m-2 mt-4">
  <div class="flex flex-col">
    <div class="w-full">
        <livewire:datatable
        model="App\Models\User"
        include="name|nombre,lastnames|Apellido,rut,birthday|fecha de nacimiento,gender|genero,email"
        searchable="name,lastnames,rut,birthday,gender"

        hideable="inline"
        exportable/>
    </div>
    <div class="w-full">
        <livewire:datatable
        model="App\Models\Training"
        :exclude="['created_at', 'updated_at']"
        hideable="inline"
        per-page="10"
        exportable/>
    </div>
    <div class="w-full">
        <livewire:datatable
        model="App\Models\TrainAppointment"
        :exclude="['created_at', 'updated_at']"
        hideable="inline"
        per-page="10"
        exportable/>
    </div>
    <div class="w-full">
        <livewire:datatable
        model="App\Models\Student"
        :exclude="['created_at', 'updated_at']"
        hideable="inline"
        per-page="10"
        exportable/>
    </div>
  </div>
</div>
</x-admin.layout>
