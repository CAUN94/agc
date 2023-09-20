<x-admin.layout>
	<div class="bg-white p-4">
		<h1 class="admin-title-nav">
	        Hola {{Auth::user()->fullname()}}
	    </h1>
		<div class="p-4">
			<!-- table with rut,email,nombre,user and evolutioon -->
			<table class="table-fixed w-full overflow-hidden rounded-lg shadow-lg p-6" id="myTable">
				<thead>
					<tr>
						<th>Rut</th>
						<th>Email</th>
						<th>Nombre</th>
						<th>Usuario</th>
						<th>Evolución</th>
					</tr>
				</thead>
				<tbody>
					@foreach($allusers as $user)
					<tr>
						<td>{{$user->rut}}</td>
						<td style="word-break:break-all;">{{$user->email}}</td>
						<td style="word-break:break-all;">{{$user->nombre}} {{$user->apellidos}}</td>
						<td>
							<a href="/datauser/show/{{$user->id}}" class="btn btn-primary">Ver</a>
						</td>
						<td>
							<a href="/datauser/evolution/{{$user->id}}" class="btn btn-primary">Ver</a>
						</td>
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
</x-admin.layout>
