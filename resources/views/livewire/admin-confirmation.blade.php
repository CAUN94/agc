<div class="flex gap-x-3">
    <div class="w-2/3 overflow-x-auto gap-y-2 box-white p-3">
        <table class="table-auto w-full text-left">
            <thead>
                <tr>
                  <th>Pacientes del {{$this->newdate}}</th>
                  <th>Estado</th>
                  <th>Hora</th>
                  <th>-</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{$appointment->nombre_paciente}}</td>
                        <td>{{$appointment->estado_cita}}</td>
                        <td>{{\Carbon\Carbon::parse($appointment->hora_inicio)->format('H:i')}}</td>
                        <td><a class="text-primary-500 hover:text-primary-900" href="/confirmation/{{$appointment->id}}" target="_blank" onclick="myFunction(this)">Enviar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="w-1/3 overflow-x-auto gap-y-2 box-white p-3">
        {{-- <a href="/confirmation/{{$appointment->id_tratamiento}}" target="_blank">Mensaje</button> --}}
        Seleccione Fecha
        <x-admin.input class="col-span-6 sm:col-span-2" type="date" name="newdate"  :readonly="$view">Fecha de Confirmación</x-admin.input>
{{--         <button wire:click="New" class="w-full mt-2 bg-primary-500 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded-full">
          Cargar
        </button> --}}
    </div>
</div>
<script type="text/javascript">
    function myFunction(obj) {
        console.log(obj)
        obj.parentElement.parentElement.classList.add('bg-gray-300')
    }
</script>
