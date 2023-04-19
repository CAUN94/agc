<?php

namespace App\Http\Controllers;

use App\Models\AppointmentMl;
use App\Models\Student;
use App\Models\TreatmentMl;
use App\Models\User;
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
				$student->payment_type = $response->payment_type_id;
				$student->payment_id = $response->id;
				$student->save();
			}
			FlashSession::flash('primary', 'Pago Realizado');
		} elseif ($status == 'failure') {
			// $student->status = 'denied';
			FlashSession::flash('primary', 'Pago Fallido');
		} elseif ($status == 'pending') {
			FlashSession::flash('primary', 'Pago Pendiente');
		}
		return redirect('/users');
	}

	public function payMedilink($status,$appointmentId, Request $request) {
		$token = config('app.medilink');
        $client = new \GuzzleHttp\Client();

        $url = 'https://api.medilink.healthatom.com/api/v1/citas/'.$appointmentId;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $token
            ]
        ]);

		$appointment = json_decode($response->getBody())->data;

		$response = Http::get("https://api.mercadopago.com/v1/payments/$request->payment_id" . "?access_token=" . config('services.mercadopago.token'));
		$response = json_decode($response);

		if ($status == 'success') {
			FlashSession::flash('primary', 'Pago Realizado');
			$appointmentML = AppointmentMl::where('Tratamiento_Nr',$appointment->id_atencion)->first();
			$appointmentML->ispay = True;
			$appointmentML->payment_id = $response->id;
			$appointmentML->save();

			$id_cita = $appointmentId;
			$url = 'https://api.medilink.healthatom.com/api/v1/citas/'.$id_cita;

			$id_estado = 3;		

			$response = $client->request('PUT', $url, [
				'headers'  => [
						'Authorization' => 'Token ' . config('app.medilink')
					],
					'json'  => [
					'id_estado'             => $id_estado,
					'comentario'            => 'Update de Cita',
				]
				]);

			
		} elseif ($status == 'failure') {
			$student->status = 'denied';
			FlashSession::flash('primary', 'Pago Fallido');
		} elseif ($status == 'pending') {
			FlashSession::flash('primary', 'Pago Pendiente');
		}
		return redirect('/confirmacion/'.$appointmentId);
	}

	public function payMedilinkStatus(User $user, TreatmentMl $treatmentMl, $status, Request $request) {
		if ($status == 'success') {
			$response = Http::get("https://api.mercadopago.com/v1/payments/$request->payment_id" . "?access_token=" . config('services.mercadopago.token'));
			$response = json_decode($response);
			ddd($response);

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
