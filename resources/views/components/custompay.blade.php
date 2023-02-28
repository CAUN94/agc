@props(['id'])

@php
	
    $token = config('app.medilink');
    $client = new \GuzzleHttp\Client();

    $url = 'https://api.medilink.healthatom.com/api/v1/citas/'.$id;

    $response = $client->request('GET', $url, [
        'headers'  => [
            'Authorization' => 'Token ' . $token
        ]
    ]);

    $appointment = json_decode($response->getBody())->data;

    $id_atencion = $appointment->id_atencion;
    $client = new \GuzzleHttp\Client();
    $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/'.$id_atencion;

    $response = $client->request('GET', $url, [
        'headers'  => [
            'Authorization' => 'Token ' . $token
        ]
    ]);

    $atention = json_decode($response->getBody())->data;

    // SDK de Mercado Pago
	require base_path('/vendor/autoload.php');
	// Agrega credenciales
	MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
	$preference = new MercadoPago\Preference();

	// Crea un ítem en la preferencia
	$item = new MercadoPago\Item();
	$item->id = $atention->id;
	$item->title = 'Pago You Just Better';
	$item->description = 'Hora con '.$appointment->nombre_profesional;
	$item->quantity = 1;
	$item->unit_price = $atention->total;

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
