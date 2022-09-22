<?php

namespace App\Console\Commands;

use App\Models\ActionMl;
use App\Models\AppointmentMl;
use App\Models\CommandSchedule;
use App\Models\PaymentMl;
use App\Models\TreatmentMl;
use App\Models\UserMl;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Symfony\Component\HttpClient\HttpClient;

class UpdateMedilink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:UpdateMedilink';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Medilink';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $command = new CommandSchedule;
        $command->command = 'UpdateMedilink';
        $command->save();
        $this->actionMl();
        $this->info('----');
        $this->appointmentMl();
        $this->info('----');
        $this->treatmentsMl();
        $this->info('----');
        $this->paymentsMl();
    }

    public function create_client($url, $filter = False){
        $client = new Client();
        $crawler = $client->request('GET', 'https://youjustbetter.softwaremedilink.com/reportesdinamicos');
        $form = $crawler->selectButton('Ingresar')->form();
        $form->setValues(['rut' => 'admin', 'password' => 'Pascual4900']);
        $crawler = $client->submit($form);
        if($filter){
            $first = strval(Carbon::now()->subMonth()->subMonth()->format('Y-m-d'));
            $last = strval(Carbon::now()->addmonth()->format('Y-m-d'));
            $url = $url."%5Bfecha_inicio%5D%5Bstatus%5D=activated&filters%5Bfecha_inicio%5D%5Bvalue%5D=".$first."&filters%5Bfecha_fin%5D%5Bstatus%5D=activated&filters%5Bfecha_fin%5D%5Bvalue%5D=".$last."";
        }
        $crawler = $client->request('GET', $url);
        $array = $crawler->text();
        $array = substr($array,2,-2);
        $split = explode('},{', $array);
        return $split;
    }

    public function actionMl(){
        $time1 = time();
        $this->info("Actions: ".ActionMl::all()->count());
        $actions = $this->create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/listado_acciones?filters%5Bsucursal%5D%5Bstatus%5D=activated&filters%5Bsucursal%5D%5Bvalue%5D=1&filters",true);
        foreach($actions as $action){
            $value = json_decode("{".$action."}",true);
            $limit = Carbon::now()->subMonth();
            $now = Carbon::parse($value['Fecha Realizacion']);
            if($now<$limit){
                continue;
            }

            $actionMl = ActionMl::updateOrCreate(
                [
                    'Prestacion_Nr' => $value['Id. Prestacion'],
                    'Tratamiento_Nr' => $value['# Tratamiento'],
                    'Fecha_Realizacion' => $value['Fecha Realizacion'],
                    'Profesional' => $value['Realizado por'],
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
        foreach(ActionMl::where('Precio_Prestacion','=','0')->where('Profesional','<>','Internos You')->get() as $action){
            $action->Precio_Prestacion = ActionMl::where('Prestacion_Nombre','like',$action->Prestacion_Nombre)->orderby('Precio_Prestacion','desc')->first()->Precio_Prestacion;
            $action->save();
        }
        $time2 = time();
        // $this->info("Actions: ".ActionMl::all()->count()." tiempo " .$time2-$time1." seg");
        $this->info("Actions: ".ActionMl::all()->count());
        $this->info('Actions Updated!');
    }

    public function appointmentMl(){
        $time1 = time();
        $this->info("Appointment: ".AppointmentMl::all()->count());
        $appointments = $this->create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/citas?filters%5Bsucursal%5D%5Bstatus%5D=activated&filters%5Bsucursal%5D%5Bvalue%5D=1&filters",true);
        foreach($appointments as $appointment){
            $value = json_decode("{".$appointment."}",true);
            $limit = Carbon::now()->subMonth()->subMonth();
            $now = Carbon::parse($value['Fecha'])->addWeek();
            if($now<$limit){
                continue;
            }
            $actionMl = AppointmentMl::updateOrCreate(
                [
                    'Tratamiento_Nr' => $value['Atencion'],
                    'Rut_Paciente' => $value['Rut Paciente'],
                    'Fecha' => $value['Fecha'],
                    'Hora_inicio' => $value['Hora inicio'],
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
        $time2 = time();
        // $this->info("Appointment: ".AppointmentMl::all()->count()." tiempo " .$time2-$time1." seg");
        $this->info("Appointment: ".AppointmentMl::all()->count());
        $this->info('Appointment Updated!');
    }

    public function treatmentsMl(){
        $time1 = time();
        $this->info("Treatments: ".TreatmentMl::all()->count());
        $treatments = self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/resumen_tratamientos_saldos");
        // $treatments = array_slice($treatments, -400);
        $max_treatment = TreatmentMl::max('Atencion');
        foreach($treatments as $treatment){
            $value = json_decode("{".$treatment."}",true);
            if($max_treatment-800>=$value['Atencion']){
                continue;
            }
            $treatmentMl = TreatmentMl::updateOrCreate(
                [
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
        $time2 = time();
        // $this->info("Treatments: ".TreatmentMl::all()->count()." tiempo " .$time2-$time1." seg");
        $this->info("Treatments: ".TreatmentMl::all()->count());
        $this->info('Treatments Updated!');
    }

    public function paymentsMl(){
        $time1 = time();
        $this->info("Payments: ".PaymentMl::all()->count());
        $first = strval(Carbon::now()->subMonth()->subMonth()->subMonth()->format('Y-m-d'));
        $payments = self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/pagos_pacientes?filters[fecha_inicio][status]=activated&filters[fecha_inicio][value]=".$first);
        $max_payment = PaymentMl::max('Atencion');
        foreach($payments as $payment){
            $value = json_decode("{".$payment."}",true);
            if($max_payment-100>=$value['Atencion']){
                continue;
            }
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
        $time2 = time();
        // $this->info("Payments: ".PaymentMl::all()->count()." tiempo " .$time2-$time1." seg");
        $this->info("Payments: ".PaymentMl::all()->count());
        $this->info('Payments Updated!');
    }

}
