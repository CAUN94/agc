@props([
    'id'
])
@php
	// SDK de Mercado Pago
	require base_path('/vendor/autoload.php');
	// Agrega credenciales
	MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));
	$preference = new MercadoPago\Preference();

	// Crea un ítem en la preferencia

	$treatment = App\Models\TreatmentMl::find($id);

	$item = new MercadoPago\Item();
	$item->id = $treatment->id;
	$item->title = "Hora con " .$treatment->Profesional;
	$item->description = "Pago Atencion" . $treatment->Atencion;
	$item->quantity = 1;
	$item->unit_price = $treatment->TotalAtencion;
	$products[] = $item;

	$userId = Auth::user()->id;
	$preference->back_urls = array(
	    "success" => url("/pay/{$userId}/{$treatment->id}/success"),
	    "failure" => url("/pay/{$userId}/{$treatment->id}/failure"),
	    "pending" => url("/pay/{$userId}/{$treatment->id}/pending")
	);
	$preference->auto_return = "approved";
	$preference->items = $products;
	$preference->save();
@endphp

<a class="text-red-500" href="{{$preference->init_point}}">Pagar {{$treatment->totalPrice()}}</a>
