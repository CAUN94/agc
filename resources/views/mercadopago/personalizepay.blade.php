<x-landing.layout>
@php
    // SDK de Mercado Pago
    require base_path('/vendor/autoload.php');
    // Agrega credenciales
    MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
    $preference = new MercadoPago\Preference();

    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();
    $item->id = 1;
    $item->title = 'Pago You Just Better';
    $item->description = 'Pago You Just Better';
    $item->quantity = 1;
    $item->unit_price = 10000;

    $products[] = $item;

    $preference->back_urls = array(
        "success" => url("/pay/success"),
        "failure" => url("/pay/failure"),
        "pending" => url("/pay/pending")
    );
    $preference->auto_return = "approved";
    $preference->items = $products;
    $preference->save();
@endphp

<span id="mpa" class="cho-container"></span>

<script src="https://sdk.mercadopago.com/js/v2"></script>

<script>
// Agrega credenciales de SDK
  const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
        locale: 'es-AR'
  });

  // Inicializa el checkout
  mp.checkout({
      preference: {
          id: '{{$preference->id}}'
      },
      render: {
            container: '.cho-container', // Indica el nombre de la clase donde se mostrará el botón de pago
            label: 'Pagar2', // Cambia el texto del botón de pago (opcional)
      },
});

</script>
{{--     <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-auto fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <div class="mb-2 text-lg flex flex-col">
            <x-label for="rut" :value="__('Descripción')" />
        	<x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="'Descripción'" required autofocus />
            <x-label for="rut" :value="__('Monto')" />
            <x-input id="number" class="block my-2 w-full" type="number" name="number" :value="'0'" required autofocus />
        </div>
        <x-custompaypersonalize>Pagar Plan</x-custompaypersonalize>

    </x-auth-card> --}}
</x-landing.layout>
