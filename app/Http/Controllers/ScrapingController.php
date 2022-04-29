<?php

namespace App\Http\Controllers;

use App\Models\ActionMl;
use App\Models\AppointmentMl;
use App\Models\PaymentMl;
use App\Models\TreatmentMl;
use App\Models\UserMl;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\HttpClient\HttpClient;

class ScrapingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create_client($url, $filter = False){
        $client = new Client();
        $crawler = $client->request('GET', 'https://youjustbetter.softwaremedilink.com/reportesdinamicos');
        $form = $crawler->selectButton('Ingresar')->form();
        $form->setValues(['rut' => 'admin', 'password' => 'Pascual4900']);
        $crawler = $client->submit($form);
        if($filter){
            $first = strval(Carbon::now()->subYear()->subYear()->subMonth()->format('Y-m-d'));
            $last = strval(Carbon::now()->addmonth()->format('Y-m-d'));
            $url = $url."%5Bfecha_inicio%5D%5Bstatus%5D=activated&filters%5Bfecha_inicio%5D%5Bvalue%5D=".$first."&filters%5Bfecha_fin%5D%5Bstatus%5D=activated&filters%5Bfecha_fin%5D%5Bvalue%5D=".$last."";
        }
        $crawler = $client->request('GET', $url);
        $array = $crawler->text();
        $array = substr($array,2,-2);
        $split = explode('},{', $array);
        return $split;
    }

    public function userMl(){

        $split = self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/pacientes_nuevos");
        // return $split;
        $count = 0;
        foreach($split as $string){
            $jsonobj = "{".$string."}";
            $value = json_decode($jsonobj,true);
            $userMl = UserMl::updateOrCreate(
                ['RUT' => $value['RUT/DNI'],'Email' => $value['E-Mail']],
                [
                    'Nombre' => $value['Nombre paciente'],
                    'Apellidos' => $value['Apellidos paciente'],
                    'Fecha_Ingreso' => $value['Fecha Afiliación'],
                    'Ultima_Cita' => $value['Última Cita'],
                    'RUT' => $value['RUT/DNI'],
                    'Nacimiento' => $value['Fecha nacimiento'],
                    'Celular' => $value['Celular'],
                    'Ciudad' => $value['Ciudad'],
                    'Comuna' => $value['Comuna'],
                    'Direccion' => $value['Dirección'],
                    'Email' => $value['E-Mail'],
                    'Observaciones' => $value['Observaciones'],
                    'Sexo' => $value['Sexo'],
                    'Convenio' => $value['Convenio']
                ]
            );
            $count++;
            if($count == 100){
                break;
            }
        }
        return redirect('/userml');
    }

    public function professionals(){
        $professionals = self::create_client("https://youjustbetter.softwaremedilink.com/dentistas/autocomplete");
        return view('professionalsml.index',compact('professionals'));
    }

    public function professional($id){
        $client = new Client();
        $crawler = $client->request('GET', 'https://youjustbetter.softwaremedilink.com/reportesdinamicos');
        $form = $crawler->selectButton('Ingresar')->form();
        $form->setValues(['rut' => 'admin', 'password' => 'Pascual4900']);
        $crawler = $client->submit($form);
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $url = "https://youjustbetter.softwaremedilink.com/agendas/semanalJSON/".$weekStartDate."/?id_profesional=".$id;

        $crawler = $client->request('GET', $url);
        $professional = $crawler->text();
        $professional = json_decode($professional,true);
        $professionals = self::create_client("https://youjustbetter.softwaremedilink.com/dentistas/autocomplete");
        foreach($professionals as $names){
            $value = json_decode("{".$names."}",true);
            if($value['id'] == $id){
                break;
            }
        }
        // return $professional;
        return view('professionalsml.show',compact('professional','value'));
    }

    public function actionMl(){
        $actions = self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/listado_acciones?filters%5Bsucursal%5D%5Bstatus%5D=activated&filters%5Bsucursal%5D%5Bvalue%5D=1&filters",true);
        foreach($actions as $action){
            $value = json_decode("{".$action."}",true);

            $actionMl = ActionMl::updateOrCreate(
                [
                    'Prestacion_Nr' => $value['Id. Prestacion'],
                    'Tratamiento_Nr' => $value['# Tratamiento'],
                    'Fecha_Realizacion' => $value['Fecha Realizacion']
                ],
                [
                    'Sucursal' => $value['Sucursal'],
                    'Nombre' => $value['Nombre paciente'],
                    'Apellido' => $value['Apellidos paciente'],
                    'Categoria_Nr' => $value['Id. Categoria'],
                    'Categoria_Nombre' => $value['Nombre Categoria'],
                    'Tratamiento_Nr' => $value['# Tratamiento'],
                    'Profesional' => $value['Realizado por'],
                    'Estado' => $value['Estado de la consulta'],
                    'Convenio' => $value['Nombre Convenio'],
                    'Prestacion_Nr' => $value['Id. Prestacion'],
                    'Prestacion_Nombre' => $value['Nombre Prestacion'],
                    'Fecha_Realizacion' => $value['Fecha Realizacion'],
                    'Precio_Prestacion' => $value['Precio Prestación'],
                    'Abono' => $value['Abonado'],
                    'Total' => $value['Total a pagar Profesional'],
                ]
            );
        }
        return redirect('/medilink/actions');
    }

    public function appointmentMl(){
        $appointments = self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/citas?filters%5Bsucursal%5D%5Bstatus%5D=activated&filters%5Bsucursal%5D%5Bvalue%5D=1&filters",true);
        foreach($appointments as $appointment){
            $value = json_decode("{".$appointment."}",true);
            $actionMl = AppointmentMl::updateOrCreate(
                [
                    'Tratamiento_Nr' => $value['Atencion'],
                    'Rut_Paciente' => $value['Rut Paciente'],
                ],
                [
                    'Estado' => $value['Estado'],
                    'Fecha' => $value['Fecha'],
                    'Hora_inicio' => $value['Hora inicio'],
                    'Hora_termino' => $value['Hora termino'],
                    'Tratamiento_Nr' => $value['Atencion'],
                    'Profesional' => $value['Profesional/Recurso'],
                    'Rut_Paciente' => $value['Rut Paciente'],
                    'Nombre_paciente' => $value['Nombre paciente'],
                    'Apellidos_paciente' => $value['Apellidos paciente'],
                    'Mail' => $value['E-mail'],
                    'Celular' => $value['Celular'],
                    'Convenio' => $value['Convenio'],
                    'Sucursal' => $value['Sucursal'],
                ]
            );
        }
        return redirect('/medilink/appointments');
    }

    public function treatmentsMl(){
        $treatments = self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/resumen_tratamientos_saldos");
        foreach($treatments as $treatment){
            $value = json_decode("{".$treatment."}",true);
            $treatmentMl = TreatmentMl::updateOrCreate(
                [
                    'Ficha' => $value['Atencion'],
                    'Atencion' => $value['Atencion'],
                ],
                [
                    'Ficha' => $value['# Ficha'],
                    'Nombre' => $value['Nombre paciente'],
                    'Apellidos' => $value['Apellidos paciente'],
                    'Atencion' => $value['Atencion'],
                    'Profesional' => $value['Profesional'],
                    'TotalAtencion' => $value['Total Atencion'],
                    'TotalLaboratorios' => $value['Total Laboratorios'],
                    'TotalRealizado' => $value['Total Realizado'],
                    'TotalAbonado' => $value['Total Abonado'],
                    'Avance' => $value['Saldo por avance'],
                    'Global' => $value['Saldo Global'],
                    'Proxima_cita' => $value['Proxima cita']
                ]
            );
        }
        return redirect('/medilink/treatments');
    }

    public function paymentsMl(){
        $payments = self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/pagos_pacientes");
        foreach($payments as $payment){
            $value = json_decode("{".$payment."}",true);
            $paymentMl = PaymentMl::updateOrCreate(
                [
                    'Atencion' => $value['Atencion'],
                ],
                [
                  'Atencion' => $value['Atencion'],
                  'Profesional' => $value['Profesional atencion'],
                  'Especialidad' => $value['Especialidad Profesional atencion'],
                  'Pago_Nr' => $value['# Pago'],
                  'Fecha' => $value['Fecha de recepción'],
                  'Rut' => $value['Rut paciente'],
                  'Nombre' => $value['Nombre'],
                  'Apellidos' => $value['Apellidos'],
                  'Tipo_Paciente' => $value['Tipo Paciente'],
                  'Convenio' => $value['Convenio'],
                  'Convenio_Secundario' => $value['Convenio Secundario'],
                  'Boleta_Nr' => $value['# Boleta'],
                  'Total' => $value['Total pago'],
                  'Asociado' => $value['Total asociado a atencion'],
                  'Medio' => $value['Medio de pago'],
                  'Banco' => $value['Banco'],
                  'RutBanco' => $value['Rut'],
                  'Cheque' => $value['# Ref Cheque'],
                  'Vencimiento' => $value['Vencimiento'],
                  'Generado' => $value['Generado'],
                ]
            );
        }
        return redirect('/medilink/payments');
    }
}
