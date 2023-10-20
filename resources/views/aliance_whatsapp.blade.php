<x-admin.layout>
	<div class="bg-white p-4">
		<h1 class="admin-title-nav">
	        Alianzas Whatsapp
	    </h1>
	</div>
	<div class="p-4">
    <div class="flex flex-col md:flex-row gap-x-3 gap-y-1 md:gap-y-0">
        <div class="md:w-2/3 order-2 md:order-1 overflow-x-auto gap-y-2 box-white p-3">
            <table class="table-data">
                <thead>
                    <tr>
                        <th>Alianza</th>
                        <th>Nombre Alianza</th>
                        <th>Contacto</th>
                        <th>Mail</th>
                        <th>Whatsapp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alliances as $alliance)
                    <!-- largo de $alliance->contact_phone_1 -->
                    @if(strlen($alliance->contact_phone_1) < 10 or $alliance->contact_phone_1 == '56933809726' or $alliance->contact_phone_1 == '')
                        @continue
                    @endif
                    <tr>
                        <td>{{$alliance->name}}</td>
                        <td>{{$alliance->alliance_name}}</td>
                        <td>{{$alliance->contact_name}}</td>
                        <td>{{$alliance->email}}</td>
                        <td>
                            <a href="{{$alliance->getLinkWhatsappAttribute()}}" target="_blank" class="text-primary-500">
                                {{$alliance->contact_phone_1}}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="md:w-1/3 order-1 md:order-2 overflow-x-auto gap-y-2 box-white p-3">
            Alianzas sin info<br>
            <table class="table-data">
                <thead>
                    <tr>
                        <th>Alianza</th>
                        <th>Mail</th>
                    </tr>
                </thead>
                <tbody
                    @foreach($alliances as $alliance)
                        @if(strlen($alliance->contact_phone_1) < 10 or $alliance->contact_phone_1 == '56933809726' or $alliance->contact_phone_1 == '')
                            <tr>
                                <td>{{$alliance->alliance_name}}</td>
                                <td>{{$alliance->email}}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

	</div>
</x-admin.layout>
