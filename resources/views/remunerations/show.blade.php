<x-admin.layout>
<style>
	.active {
		background-color: #f2715a;
		color: white;
	}
</style>
	<div class="bg-white  p-4">
		<h1 class="admin-title-nav">
	       	Mes Vencido del 2022-11-21 al 2022-12-20
	    </h1>
	    <p>{{$pays[0][0]->nombre_profesional}}</p>
	</div>
	<div class="container mx-auto mt-4 px-4">
		<div>
		    <div class="w-full overflow-x-auto gap-y-2 box-white p-3">
		        <div class="mb-2 w-full flex justify-between font-bold text-gray-600">
		            Total {{\App\Helpers\Helper::moneda_chilena(round($total_final*(Auth::user()->professional->coff/100)))}} <br>
		            Cantidad de atenciones: {{count($pays)}}
		        </div>
		    </div>

		    <div class="flex flex-col lg:flex-row gap-3 mt-2">
		      <div class="w-full lg:w-3/4 flex flex-col overflow-x-auto gap-y-2">
		        <div class="w-full overflow-x-auto gap-y-2 box-white p-3 mt-3">
		          <div class="w-full font-medium flex justify-between ml-3">
		            Atendidos
		          </div>
		          <div class="rounded-b-lg h-full p-3">
		          	<table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6" id="table">
					    <thead>
					        <tr>
					            <th class="text-center">#id</th>
					            <th class="text-center">Paciente</th>
					            <th class="text-center">Estado</th>
					            <th class="text-center">Fecha</th>
					            <th class="text-center">Hora</th>
					            <th class="text-center">Remuneración</th>
					        </tr>
					    </thead>
					    <tbody>
					    	@foreach($pays as $pay)

					        <tr>
					            <td>{{$pay[0]->id}}</td>
					            <td>{{$pay[0]->nombre_paciente}}</td>
					            <td>{{$pay[0]->estado_cita}}</td>
					            <td>{{$pay[0]->fecha}}</td>
					            <td>{{$pay[0]->hora_inicio}}</td>
					            <td>{{\App\Helpers\Helper::moneda_chilena(round($pay[2]*(Auth::user()->professional->coff/100)))}}</td>
					        </tr>
					        @endforeach
					    </tbody>
					</table>
					<script>
                    $(document).ready( function () {
                        $('#myTable').DataTable();

                    } );
                  </script>
		          </div>
		        </div>
		      </div>
		      <div class="w-full lg:w-1/4 flex flex-col overflow-x-auto gap-y-2">
		        <div class="w-full overflow-x-auto gap-y-2 box-white p-3 mt-3">
		          <div class="w-full font-medium flex justify-between ml-3">Información Adicional</div>
		        </div>
		      </div>
		    </div>

		</div>


		<livewire:admin-remuneration></livewire:admin-remuneration> --}}
	</div>

</x-admin.layout>
