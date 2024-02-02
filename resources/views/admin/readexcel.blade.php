<x-admin.layout>
	<div class="bg-white p-4">
		<h1 class="admin-title-nav">
	        Whatsapp
	    </h1>
	</div>
	
    <div class="bg-white m-2 p-4 rounded-md">
    <form action="/excelprocess_actions" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="archivo_excel_actions" accept=".xlsx, .xls">
        <button type="submit">Procesar Actions</button>
    </form>
    <form action="/excelprocess_appointments" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="archivo_excel_appointments" accept=".xlsx, .xls">
        <button type="submit">Procesar Appointments</button>
    </form>
    </div>
</x-admin.layout>
