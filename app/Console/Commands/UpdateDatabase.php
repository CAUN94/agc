<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\AppointmentMl;

class UpdateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:UpdateDatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->token = config('app.medilink');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->store();
    }

    public function store(){
        $client = new \GuzzleHttp\Client();
        $date = strval(Carbon::now()->subDays(10)->format('Y-m-d'));
        $url = 'https://api.dentalink.healthatom.com/api/v1/citas';
        $query_string   = '?q={"fecha":{"gt":"'.$date.'"}}';
        $url = $url."".$query_string;
        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $allAppointments = [];
        $appointments = json_decode($response->getBody());
        $allAppointments[] = $appointments->data;
        
        while(isset($appointments->links->next)){
            $response = $client->request('GET', $appointments->links->next, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            $appointments = json_decode($response->getBody());
            $allAppointments[] = $appointments->data;
            
        }
        $allAppointments = array_merge(...$allAppointments);

        $fecha  = array_column($allAppointments, 'fecha');
        $fecha_r  = array_column($allAppointments, 'fecha_actualizacion');

        array_multisort($fecha, SORT_ASC,$fecha_r, SORT_ASC, $allAppointments);


        $count = 0;
        foreach($allAppointments as $appointment){
            $url = $appointment->links[1]->href;
            $response = $client->request('GET', $url, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            if($count%20 == 0){
                sleep(15);
            }
            
            $patient = json_decode($response->getBody())->data;

            $apMl = AppointmentMl::UpdateOrCreate(
                [
                    'Tratamiento_Nr' => $appointment->id_tratamiento,
                    'Rut_Paciente' => $patient->rut ,
                    // 'Estado' => $appointment->estado_cita,
                ],
                [
                    'Estado' => $appointment->estado_cita,
                    'Fecha' => $appointment->fecha ,
                    'Fecha_Generación' => $appointment->fecha_actualizacion ,
                    'Hora_inicio' => $appointment->hora_inicio ,
                    'Hora_termino' => $appointment->hora_fin ,
                    'Tratamiento_Nr' => $appointment->id_tratamiento ,
                    'Profesional' => $appointment->nombre_dentista ,
                    'Rut_Paciente' => $patient->rut ,
                    'Nombre_paciente' => $patient->nombre ,
                    'Apellidos_paciente' => $patient->apellidos ,
                    'Mail' => $patient->email ,
                    'Celular' => $patient->celular ,
                    'Convenio' => 0,
                    'Sucursal' => $appointment->nombre_sucursal ,
                ]
            );

            // if($apMl->wasChanged()){
            //     $this->info('Modificado:'.$apMl->Nombre_paciente.' '.$apMl->Apellidos_paciente);
            // }

            if(isset($apMl->getChanges()['Fecha_Generación'])){
                $this->info('Modificado:'.$apMl->Nombre_paciente.' '.$apMl->Apellidos_paciente);
            }


            
            $count++;
        }
    }
}
