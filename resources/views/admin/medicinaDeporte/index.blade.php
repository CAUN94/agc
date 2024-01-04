<x-admin.layout>
	<div class="bg-white p-4">
		<h1 class="admin-title-nav">
	        Hola {{Auth::user()->fullname()}}
	    </h1>
	</div>
	<div class="m-4">
		<div class="shadow sm:rounded-md sm:overflow-hidden">
    		<div class="px-4 py-5 bg-white space-y-6 sm:p-6">
				<!-- form with checbox with 5 random word -->
				@php
					$infos = [];
					$infos = array("hola", "chao", "como", "estas", "bien");
				@endphp
				<form action="/medicinadeporte/pdf" method="POST">
					@csrf
					@foreach ($infos as $i => $info)
						<label>
							<input type="checkbox" name="datos[]" value="{{$i}}">
							{{$info}}
						</label><br>
					@endforeach

					<button type="submit">Generar PDF</button>
				</form>
			</div>
		</div>
	</div>
</x-admin.layout>
