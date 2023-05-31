<div class="flex flex-col md:flex-row gap-x-3 gap-y-1 md:gap-y-0">
    <div class="md:w-2/3 order-2 md:order-1 overflow-x-auto gap-y-2 box-white p-3">
        <table class="table-auto w-full text-left">
            <thead>
                <tr>
                  <th>Pacientes del {{$this->newdate}}</th>
                  <th>Estado</th>
                  <th class="hidden md:block">Hora</th>
                  <th>Whatsapp</th>
                  <th class="hidden md:block">Mercadopago</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td>{{$appointment->nombre_paciente}}</td>
                        <td>{{$appointment->estado_cita}}</td>
                        <td class="hidden md:block">{{\Carbon\Carbon::parse($appointment->hora_inicio)->format('H:i')}}</td>
                        <td><a class="text-primary-500 hover:text-primary-900" href="/confirmation/{{$appointment->id}}" target="_blank" onclick="myFunction(this)">Enviar</a></td>
                        <td class="hidden md:block"><a class="text-primary-500 hover:text-primary-900" href="/confirmacion/{{$appointment->id}}" target="_blank">Link</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="md:w-1/3 order-1 md:order-2 overflow-x-auto gap-y-2 box-white p-3">
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
