<x-admin.layout>
	<div class="bg-white  p-4">
		<h1 class="text-3xl font-bold text-gray-600">
	        Emitir Pack
	    </h1>
	</div>
	<div class="container mx-auto mt-4 px-4">
		<!-- Form Post to emit route-->
        <form action="/nubox/emit" method="POST">
            @csrf
            <div class="flex flex-col">

                <label for="professional" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profesional</label>
                <select id="professional" name="professional" class="border border-gray-300 rounded-lg" required>
                    <!-- foreach all professionals -->
                    <!-- option selected  -->
                    <option value="" selected disabled>Seleccione un profesional</option>
                    @foreach($professionals as $professional)
                        <option value="{{ $professional->id }}">
                            {{$professional->user->name}}&nbsp
                            {{$professional->user->lastnames}}&nbsp
                            {{$professional->user->rut}}
                        </option>
                    @endforeach
                </select>
                            
            </div>
            <div class="flex flex-col">

                <label for="pack" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pack</label>
                <select id="pack" name="pack" class="border border-gray-300 rounded-lg" required>
                    <!-- foreach all packs  -->
                    <!-- Option selected -->
                    <option value="" selected disabled>Seleccione un pack</option>
                    @foreach($packs as $pack)
                        <option value="{{ $pack->id }}">
                            {{$pack->name}}
                        </option>
                    @endforeach
                </select>
                            
            </div>

            <div class="flex flex-col">
                <label for="patient" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paciente</label>
                <select id="patient" name="patient" class="border border-gray-300 rounded-lg" required>
                    <option value="" selected disabled>Seleccione un paciente</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">
                            {{$patient->nombre}}&nbsp
                            {{$patient->apellidos}}&nbsp
                            {{$patient->rut}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col">
                <!-- checbokx label -->
                <label for="alliance" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alianza</label>
                <!-- Tailwind radio button -->

                <div class="flex items-center mb-4">
                    <input id="default-radio-1" type="radio" value="false" name="alliance" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required>
                    <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sin Alianza</label>
                </div>
                <div class="flex items-center">
                    <input id="default-radio-2" type="radio" value="true" name="alliance" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Con Alianza</label>
                </div>


            </div>
            
            <!-- submit button right side margin top 2 auto heigt right side from div  -->
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
