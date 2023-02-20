<x-admin.layout>
    <div class="bg-white p-4">
        <!-- check if isset emit urlboleta -->
        @if(isset($emit['UrlBoleta']))
            <a href="{{$emit['UrlBoleta']}}" target="_blank" class="text-primary-500 hover:text-primary-700">Descargar</a>
        @else
            <p>Se creo borrador de la boleta, consultar a Cris para verla</p>
        @endif
    </div>
</x-admin.layout>
