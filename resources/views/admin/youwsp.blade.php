<x-admin.layout>
	<div class="bg-white p-4">
		<h1 class="admin-title-nav">
	        Whatsapp
	    </h1>
	</div>
	
    <div class="bg-white m-2 p-4 rounded-md">
        <input type="file" id="input-excel" />
        <div id="json-output" style="white-space: pre-wrap;"></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script>
        document.getElementById('input-excel').addEventListener('change', leerArchivo, false);

        function leerArchivo(event) {
            const archivo = event.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function(event) {
                const data = new Uint8Array(event.target.result);
                const workbook = XLSX.read(data, {type: 'array'});
                const firstSheetName = workbook.SheetNames[0];
                const worksheet = workbook.Sheets[firstSheetName];
                const json = XLSX.utils.sheet_to_json(worksheet);
                document.getElementById('json-output').textContent = JSON.stringify(json, null, 2);
            };

            reader.readAsArrayBuffer(archivo);
        }
    </script>
</x-admin.layout>
