<x-admin.layout>
	<div class="bg-white  p-4">
		<h1 class="admin-title-nav">
	        Tabla Alumnos
	    </h1>
	</div>
	<div class="grid grid-cols-1">
		<div class="table w-full p-1">
		    <table class="w-full border table-fixed">
		        <thead>
		            <tr class="bg-gray-50 border-b">
		                <th class="border-r p-1">
		                    <input type="checkbox">
		                </th>
		                <th class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
		                    <div class="flex items-center justify-center">
		                        Rut
		                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
		                        </svg>
		                    </div>
		                </th>
		                <th class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
		                    <div class="flex items-center justify-center">
		                        Nombre
		                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
		                        </svg>
		                    </div>
		                </th>
		                <th class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
		                    <div class="flex items-center justify-center">
		                        Alianza
		                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
		                        </svg>
		                    </div>
		                </th>
		                <th class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
		                    <div class="flex items-center justify-center">
		                        Profesor a Cargo
		                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
		                        </svg>
		                    </div>
		                </th>
		                <th class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
		                    <div class="flex items-center justify-center">
		                        Tipo de Plan
		                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
		                        </svg>
		                    </div>
		                </th>
		                <th class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
		                    <div class="flex items-center justify-center">
		                        Clases x mes
		                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
		                        </svg>
		                    </div>
		                </th>
		                <th class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
		                    <div class="flex items-center justify-center">
		                        Fecha Renovación
		                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
		                        </svg>
		                    </div>
		                </th>
		                <th class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
		                    <div class="flex items-center justify-center">
		                        Valor Plan
		                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
		                        </svg>
		                    </div>
		                </th>
		                <th class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
		                    <div class="flex items-center justify-center">
		                        Monto a Pagar
		                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
		                        </svg>
		                    </div>
		                </th>
		                <th class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
		                    <div class="flex items-center justify-center">
		                        Estado
		                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
		                        </svg>
		                    </div>
		                </th>
		                <th class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
		                    <div class="flex items-center justify-center">
		                        Fecha Pago
		                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
		                        </svg>
		                    </div>
		                </th>
		            </tr>
		        </thead>
		        <tbody>
		            <tr class="bg-gray-50 text-center">
		                <td class="p-1">
		                	Filtrar
		                </td>
		                <td class="p-1">
		                    <input type="text" class="border p-1 block w-full">
		                </td>
		                <td class="p-1">
		                    <input type="text" class="border p-1 block w-full">
		                </td>
		                <td class="p-1">
		                    <input type="text" class="border p-1 block w-full">
		                </td>
		                <td class="p-1">
		                    <input type="text" class="border p-1 block w-full">
		                </td>
		                <td class="p-1">
		                    <input type="text" class="border p-1 block w-full">
		                </td>
		                <td class="p-1">
		                    <input type="text" class="border p-1 block w-full">
		                </td>
		                <td class="p-1">
		                    <input type="text" class="border p-1 block w-full">
		                </td>
		                <td class="p-1">
		                    <input type="text" class="border p-1 block w-full">
		                </td>
		                <td class="p-1">
		                    <input type="text" class="border p-1 block w-full">
		                </td>
		                <td class="p-1">
		                    <input type="text" class="border p-1 block w-full">
		                </td>
		                <td class="p-1">
		                    <input type="text" class="border p-1 block w-full">
		                </td>


		            </tr>
		            @for ($i = 1; $i <= 8; $i++)
			            <tr class="{{ $i%2 == 0 ? 'bg-green-100' : 'bg-red-100'}} text-center border-b text-sm text-gray-600">

			                <td class="p-1 border-r">
			                    <input type="checkbox">
			                </td>
			                <td>11111111-{{$i}}</td>
							<td>Orlando Jimenez Bustamante</td>
							<td>Apoderados SG</td>
							<td>Ángel</td>
							<td>Grupal presencial especial</td>
							<td>8</td>
							<td>18-09-2022</td>
							<td>$49,990</td>
							<td>$44,990</td>
							@if($i%2 == 0)
								<td>Pagado</td>
							@else
								<td>No Pagado</td>
							@endif
							@if($i%2 == 0)
								<td>2012-10-01</td>
							@else
								<td></td>
							@endif


	{{-- 		                <td>
			                    <a href="#" class="bg-blue-500 p-1 text-white hover:shadow-lg text-xs font-thin">Edit</a>
			                    <a href="#" class="bg-red-500 p-1 text-white hover:shadow-lg text-xs font-thin">Remove</a>
			                </td> --}}
			            </tr>
		            @endfor
		        </tbody>
		    </table>
		</div>
	</div>

</x-admin.layout>
