<x-admin.layout>
	<div class="bg-white  p-4">
		<h1 class="text-3xl font-bold text-gray-600">
	       	Mes Vencido del 2022-11-21 al 2022-12-20
	    </h1>
	    <p>{{$pays[0][0]->nombre_profesional}}</p>
	</div>
	<div class="container mx-auto mt-4 px-4">
		<div>
		    <div class="w-full overflow-x-auto gap-y-2 box-white p-3">
		        <div class="mb-2 w-full flex justify-between font-bold text-gray-600">
		            Total {{\App\Helpers\Helper::moneda_chilena($total_final)}} <br>
		            Cantidad: {{count($pays)}} <br>
		            Remuneración {{\App\Helpers\Helper::moneda_chilena(round($total_final*$coff))}}
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
					            <th class="text-center">Pagado</th>
					            <th class="text-center">Total</th>
					            <th class="text-center">Remuneración</th>
					        </tr>
					    </thead>
					    <tbody>
						
					    	@foreach($pays as $pay)
					    	@php
				            	$total_p = 0;
				            	$total_a = 0;
				            	foreach($pay[1] as $t){
				            		$total_p += $t->pagado;
				            		$total_a += $t->subtotal;
									
				            	}
					        @endphp
					        <tr>
					            <td>{{$pay[0]->id}}</td>
					            <td>{{$pay[0]->nombre_paciente}}</td>
					            <td>{{$pay[0]->estado_cita}}</td>
					            <td>{{$pay[0]->fecha}}</td>
					            <td>{{$pay[0]->hora_inicio}}</td>
					            <td>{{\App\Helpers\Helper::moneda_chilena(round($total_p))}}</td>
					            <td>{{\App\Helpers\Helper::moneda_chilena(round($total_a))}}</td>
					            <td>{{\App\Helpers\Helper::moneda_chilena(round($total_a*$coff))}}</td>
					        </tr>
					        @endforeach
					    </tbody>
					</table>
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


		{{-- <livewire:admin-remuneration></livewire:admin-remuneration> --}}
	</div>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>
</x-admin.layout>
