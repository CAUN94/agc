<x-admin.layout>
	<div class="bg-white flex justify-between items-center p-4">
		<h1 class="admin-title-nav">
	        {{$training->planComplete()}}
	    </h1>

	</div>
	<div class="m-4"><div>
	<div class="md:grid md:grid-cols-4 md:gap-6">
	  <div class="md:col-span-1">
	    <div class="px-4 sm:px-0">
	      <h3 class="text-lg font-medium leading-6 text-gray-900">Entrenamiento</h3>
	      <p class="mt-1 text-sm text-gray-600">
	        Esta sección muesta la información base de cualquier entrenamiento en you.
	      </p>
	    </div>
	  </div>
	  <div class="mt-5 md:mt-0 md:col-span-3">
	      <div class="shadow sm:rounded-md sm:overflow-hidden">
	        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
	          <h1 class="text-primary-500">Modificar Plan</h1>
	          <form action="/adminclass/{{$training->id}}" method="POST">
	          @csrf
	          @method('PUT')
	          <div class="grid grid-cols-6 gap-6">

				<x-admin.input class="col-span-6 sm:col-span-2" type="text" name="name" value="{{$training->name}}" readonly="edit" >Nombre</x-admin.input>

				<x-admin.input class="col-span-6 sm:col-span-2" type="number" name="class" value="{{$training->class}}" readonly="edit" >Cantidad de Clases</x-admin.input>

				<x-admin.input class="col-span-6 sm:col-span-2" type="number" name="days" value="{{$training->days}}" readonly="edit" >Días</x-admin.input>

				<x-admin.input-select class="col-span-6 sm:col-span-2" name="type" readonly="edit">
					Tipo
					<x-slot name="options">
						@foreach(App\Models\Training::where('id','>','0')->groupby('type')->get() as $group)
					    	<x-admin.input-option value="{{$group->type}}" actual="{{$training->type}}">{{$group->type}}</x-admin.input-option>
					    @endforeach
					</x-slot>
				</x-admin.input-select>

				<x-admin.input-select class="col-span-6 sm:col-span-2" name="format" readonly="edit">
					Formato
					<x-slot name="options">
						@foreach(App\Models\Training::where('id','>','0')->groupby('format')->get() as $format)
					    	<x-admin.input-option value="{{$format->format}}" actual="{{$training->format}}">{{$format->format}}</x-admin.input-option>
					    @endforeach
					</x-slot>
				</x-admin.input-select>

				<x-admin.input class="col-span-6 sm:col-span-2" type="number" name="extra" value="{{$training->extra}}" readonly="edit" >Valor Extra por Pauta</x-admin.input>

				<x-admin.input class="col-span-6 sm:col-span-2" type="number" name="time_in_minutes" value="{{$training->time_in_minutes}}" readonly="edit" >Duración en Minutos</x-admin.input>

				<x-admin.input class="col-span-6 sm:col-span-2" type="number" name="price" value="{{$training->price}}" readonly="edit" >Precio</x-admin.input>

				<x-admin.input-select class="col-span-6 sm:col-span-2" name="period" readonly="edit">
					Periodo
					<x-slot name="options">
						@foreach(App\Models\Training::where('id','>','0')->groupby('period')->get() as $period)
					    	<x-admin.input-option value="{{$period->period}}" actual="{{$training->period}}">{{$period->period}}</x-admin.input-option>
					    @endforeach
					</x-slot>
				</x-admin.input-select>

				<x-admin.input-select class="col-span-6 sm:col-span-2" name="is_published" readonly="edit">
					Publicado
					<x-slot name="options">
					    <x-admin.input-option value="1" actual="{{$training->is_published}}">Publicado</x-admin.input-option>
					    <x-admin.input-option value="0" actual="{{$training->is_published}}">Borrador</x-admin.input-option>
					</x-slot>
				</x-admin.input-select>

	            <div class="col-span-6 sm:col-span-6">
					<label for="description" class="block text-sm font-medium text-gray-700">
					  Descripción
					</label>
					<div class="mt-1">
					  <textarea id="description" name="description" rows="10" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" >{{$training->description}}</textarea>
					</div>
	                @error("description") <span class="error text-primary-500">{{ $message }}</span> @enderror
	            </div>
	        </div>

	        <div class="text-right mt-3">
	          <input type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cursor-pointer" value="Modificar Plan">
	  		</div>
  		</form>
	</div>
	</div>
</div>
<x-flash-message></x-flash-message>
</div>

</x-admin.layout>
