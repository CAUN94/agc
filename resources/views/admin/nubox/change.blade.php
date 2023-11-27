<x-admin.layout>
	<div class="bg-white  p-4">
		<h1 class="admin-title-nav">
	        Emitir Pack
	    </h1>
	</div>
	<div class="container mx-auto mt-4 px-4">
		<!-- Form Post to emit route-->
        <form action="/nubox/emit" method="POST">
            @csrf
            <div class="flex flex-col">

                <label for="professional" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Profesional: {{$professional->user->name}} {{$professional->user->lastnames}}</label>
                <input type="hidden" id="professional" name="professional" value="{{$professional->id}}" class="border border-gray-300 rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="pack" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Pack: {{$pack_choise->name}}</label>
                <input type="hidden" id="pack" name="pack" value="{{$pack_choise->id}}" class="border border-gray-300 rounded-lg" required>
            </div>

            <div class="flex flex-col">
                <label for="patient" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Paciente: {{$patient->data->nombre}} {{$patient->data->apellidos}}</label>
                <input type="hidden" id="patient" name="patient" value="{{$patient->data->id}}" class="border border-gray-300 rounded-lg" required>
            </div>

            
            
            <div class="flex flex-col">
                <label for="alliance" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Con alianza: 
                    @if($alliance == 'true') Si 
                    @else No 
                    @endif</label>
                <input type="hidden" id="alliance" name="alliance" value="{{$alliance}}" class="border border-gray-300 rounded-lg" required>
            </div>

            <div class="flex flex-col">
                @foreach($packs as $pack)
                    <label for="alliance" class="mb-2 text-md font-medium text-gray-900 dark:text-white">
                        {{$pack->producto}}
                    </label>
                    <input id="values" name="values[{{$pack->id}}]" value="@if($alliance == 'true') {{$pack->alliance_price}} @else {{$pack->price}} @endif" class="border border-gray-300 rounded-lg" required>
                @endforeach
            </div>

            <div class="mt-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Emitir</button>
            </div>
        </form>
	</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>

    <!-- Crea una función para normalizar una cadena -->
    <script>
    function normalizarCadena(cadena) {
    return cadena.toLowerCase().replace(/[\sáéíóúü]/g, function(letra) {
        switch (letra) {
        case 'á': return 'a';
        case 'é': return 'e';
        case 'í': return 'i';
        case 'ó': return 'o';
        case 'ú': return 'u';
        case 'ü': return 'u';
        default: return '';
        }
    });
    }

    document.addEventListener('DOMContentLoaded', function() {
    // Selecciona el elemento select
    var miSelect = document.querySelector('#patient');

    // Inicializa Select2
    var select2 = new Select2(miSelect, {
        minimumInputLength: 1,
        matcher: function(term, text, opt) {
        // Normaliza la cadena para comparar sin considerar mayúsculas, espacios ni acentos
        var textNormalizada = normalizarCadena(text);
        var termNormalizada = normalizarCadena(term);
        return textNormalizada.indexOf(termNormalizada) >= 0;
        }
    });
    });
    </script>
</x-admin.layout>
