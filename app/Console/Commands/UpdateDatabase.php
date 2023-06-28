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
    protected $signature = 'ln:UpdateDatabase {date?}';

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
        // carbon create
        if($this->argument('date') == null){
            $date = strval(Carbon::now()->subDays(30)->format('Y-m-d'));
        } else {
            $date = strval(Carbon::create($this->argument('date'))->format('Y-m-d'));
        }

        $this->info($date);
        
        $query_string   = '?q={"fecha":{"gt":"'.$date.'"}}';
        // $query_string   = '?q={"fecha":{"gt":"2023-02-10"}}';
        $url = 'https://api.medilink.healthatom.com/api/v1/citas';
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
            $this->info(count($allAppointments));
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
            if($count%100 == 0 and $count != 0){
                $this->info("Count:".$count);
                sleep(30);
            }
            $patient = json_decode($response->getBody())->data;

            $apMl = AppointmentMl::UpdateOrCreate(
                [
                    'Tratamiento_Nr' => $appointment->id_atencion,
                ],
                [
                    'Estado' => $appointment->estado_cita,
                    'Fecha' => $appointment->fecha ,
                    'Fecha_Generación' => $appointment->fecha_actualizacion ,
                    'Hora_inicio' => $appointment->hora_inicio ,
                    'Hora_termino' => $appointment->hora_fin ,
                    'Tratamiento_Nr' => $appointment->id_atencion ,
                    'Profesional' => $appointment->nombre_profesional ,
                    'Rut_Paciente' => $patient->rut ,
                    'Nombre_paciente' => $patient->nombre ,
                    'Apellidos_paciente' => $patient->apellidos ,
                    'Mail' => $patient->email ,
                    'Celular' => $patient->celular ,
                    'Convenio' => 0,
                    'comentario' => $appointment->comentarios,
                    'Sucursal' => $appointment->nombre_sucursal ,
                ]
            );

            $this->info($apMl->Estado);
                     
            $count++;
        }
    }
}
