<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Models\Alliance;
use Carbon\Carbon;
use Session as FlashSession;

class LandingController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }

    public function packverano()
    {
        return view('packverano');
    }

    public function personalize_whatsapp(){
        return view('personalize_whatsapp');
    }

    public function aliance_whatsapp(){
        // All Alliance where contavt_phone_1 is not null and contact_phone_1 has more than 7 characters
        $alliances = Alliance::all();
        return view('aliance_whatsapp',compact('alliances'));
    }

    public function confirmations()
    {
        return view('confirmation');
    }

    public function confirmation($id)
    {
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

        $id_paciente = $appointment->id_paciente;
        $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/'.$id_paciente;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $token
            ]
        ]);

        $patient = json_decode($response->getBody())->data;

    }

    public function sendconfirmation($id)
    {
        $url = "https://web.whatsapp.com/send?phone=56976693894&text=Hola%20".$id;
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

        $id_paciente = $appointment->id_paciente;
        $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/'.$id_paciente;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $token
            ]
        ]);

        $patient = json_decode($response->getBody())->data;
        // ddd($appointment);
        // ddd($atention);
        // ddd($patient);

        $hora = Carbon::parse($appointment->hora_inicio)->format('H:i');
        $phone = str_replace(' ','',$patient->celular);
        $phone = "569".substr($phone, strlen($phone) -8);
        $day = Carbon::parse($appointment->fecha);
        $days = array(
            'Sunday' => 'Domingo',
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miercoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sabado'
        );
        if(strtolower($appointment->comentarios) == 'grupal'){
            $text = '¡Hola '.$patient->nombre.'! ¿Cómo estás?%0A%0ASabemos que estás motivado para continuar entrenando con nosotros. Te invitamos a renovar tu plan de entrenamiento con un valor de '.Helper::moneda_chilena($atention->total).'. Puedes realizar el pago fácilmente a través de http://yjb.cl/pago.%0A%0ASi tienes alguna duda o pregunta, no dudes en comentarnos. Saludos!';
            
        } else {
            $text = 'Hola '.$patient->nombre.'! Te recordamos que tienes atención el '.$days[$day->format('l')].' '.$day->format('d').' con '.$atention->nombre_profesional.' a las '.$hora.' hrs.';
            $text .= '--*Para confirmar tu asistencia haz click en el siguiente link o confirma con un mensaje*: http://yjb.cl/confirmacion/'.$id;
            if($atention->total != $atention->abonado){
                $text .= '--También puedes pagar tu atención de '.Helper::moneda_chilena($atention->total).' en el mismo link.';
                // ddd('Pago');
            }  

            
            if ($atention->nombre_profesional == "Melissa Ross Guerra"){                
                if(strtolower($appointment->comentarios) == 'evaluacion'){
                    $text .= '--Además, necesitamos que previo a tu evaluación inicial contestes la siguiente encuesta que será utilizada durante la sesión '.url('/sesion_nutricional').'.';
                }
                $text .= '--Traer short y/o peto';
            }
            else {
                $text .= '--Trae ropa cómoda';
            }
            

            $text .= ', estamos en San pascual 309, Las Condes. Contamos con estacionamiento afuera del local.';
            $text .= '--Puedes revisar nuestros terminos y condiciones de agendamiento en www.yjb.cl/terms';

            $text = str_replace('--','%0A%0A',$text);
        }
        $whatsapp = "https://web.whatsapp.com/send?phone=".$phone."&text=".$text;

        return \Redirect::away($whatsapp);
    }

    public function terms()
    {
        return redirect('/pdf/tyc_you.pdf');
    }

    public function aranceles()
    {
        return redirect('/pdf/aranceles.pdf');
    }


    public function team()
    {
        $team = [
            [
                'name' => 'Alonso Niklitschek',
                'img' => '/img/equipo/alonso.jpg',
                'info' => '<li>Kinesiologia, Universidad Mayor, 2014</li><li>Diplomado en Terapia Manual, Universidad de Chile, 2016</li><li>Diplomado en Terapia Manual, Universidad de Chile, 2016</li><li>Cursando Magister en Terapias Ortopédicas, Universidad Andrés Bello</li>'
            ]
        ];
        return view('team',compact('team'));
    }

    public function calendar(){
        $user = Auth::user();
        return view('users.calendar',compact('user'));
    }

    public function healthy(){
        $user = Auth::user();
        return view('users.healthy',compact('user'));
    }

    public function nutrition(){
        $user = Auth::user();
        return view('users.nutrition',compact('user'));
    }

    public function mailverano(Request $request)
    {
        $details = [
            'name' => $request->name,
            'phone' => $request->phone,
            'pack' => $request->pack,
         ];
        \Mail::to('cristobalugarte6@gmail.com')->send(new \App\Mail\PackVerano($details));

        FlashSession::flash('primary', 'Inscripción Lista');
        return redirect('/packverano');
    }

    public function tables()
    {
        return view('tables');
    }

    public function example(){
        return view('example');
    }

    public function renew()
    {
        return view('users.renew');
    }

    public function youwsp(){
        return view('admin.youwsp');
    }

    public function precios(){
        return view('precios');
    }

    public function contactanos(){
        return view('contactanos');
    }


}
