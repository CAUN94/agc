<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session as FlashSession;

class PayController extends Controller {

	public function payStatus(User $user, $status, Request $request) {
		// return $request->all();
		if ($status == 'success') {
			$response = Http::get("https://api.mercadopago.com/v1/payments/$request->payment_id" . "?access_token=" . config('services.mercadopago.token'));
			$response = json_decode($response);
			$items = $response->additional_info->items;
			foreach ($items as $item) {
				$student = Student::find($item->id);
				$student->settled = True;
				$student->status = 'approved';
				$student->payment_type = 'credit_card';
				$student->payment_id = '1245191589';
				$student->save();
			}
			FlashSession::flash('primary', 'Pago Realizado');
		} elseif ($status == 'failure') {
			$student->status = 'denied';
			FlashSession::flash('primary', 'Pago Fallido');
		} elseif ($status == 'pending') {
			FlashSession::flash('primary', 'Pago Pendiente');
		}
		return redirect('/users');
	}
}
