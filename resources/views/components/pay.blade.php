@php
	// SDK de Mercado Pago
	require base_path('/vendor/autoload.php');
	// Agrega credenciales
	MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
	$preference = new MercadoPago\Preference();

	// Crea un ítem en la preferencia
	foreach(Auth::user()->notSettledPlan as $product){
		$item = new MercadoPago\Item();
		$item->id = $product->id;
		$item->title = $product->training->planComplete();
		$item->description = $product->training->planComplete();
		$item->quantity = 1;
		$item->unit_price = $product->training->price;

		$products[] = $item;
	}
	$userId = Auth::user()->id;
	$preference->back_urls = array(
	    "success" => url("/pay/{$userId}/success"),
	    "failure" => url("/pay/{$userId}/failure"),
	    "pending" => url("/pay/{$userId}/pending")
	);
	$preference->auto_return = "approved";
	$preference->items = $products;
	$preference->save();
@endphp

<span class="cho-container"></span>

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
            label: '{{$slot}}', // Cambia el texto del botón de pago (opcional)
      },
});
</script>
