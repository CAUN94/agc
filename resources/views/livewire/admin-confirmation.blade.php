<div class="flex gap-x-3">
    <div class="w-2/3 overflow-x-auto gap-y-2 box-white p-3">
        <table class="table-auto w-full text-left">
            <thead>
                <tr>
                  <th>Paciente</th>
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
                        <td><a class="text-primary-500 hover:text-primary-900" href="/confirmation/{{$appointment->id_tratamiento}}" target="_blank">Enviar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="w-1/3 overflow-x-auto gap-y-2 box-white p-3">
        {{-- <a href="/confirmation/{{$appointment->id_tratamiento}}" target="_blank">Mensaje</button> --}}
        Nada por aquí aun.
    </div>
</div>
