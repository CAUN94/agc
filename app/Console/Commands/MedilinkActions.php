<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Professional;
use App\Models\ActionMl;
use GuzzleHttp\Client;

class MedilinkActions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:medilink-actions {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bring actions from Medilink to Database';

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
     * 
     */
    public function handle()
    {
        if($this->argument('date') == null){
            $date = strval(Carbon::now()->format('Y-m-d'));
        } else {
            $date = strval(Carbon::create($this->argument('date'))->format('Y-m-d'));
        }

        $date2 = strval(Carbon::create($date)->subDays(20)->format('Y-m-d'));
        $date3 = strval(Carbon::create($date)->addDays(20)->format('Y-m-d'));

        $this->info("Fecha Inicio ".$date);
        $this->info("Fecha Inicio -15 ".$date2);
        $this->info("Fecha Inicio +15 ".$date3);

        $dates = [
            $date,
            $date2,
            $date3
        ];

        $professionals = Professional::orderBy('description')->get();
        foreach($professionals as $professional){
            $this->info($professional->description);
            $this->info('-------------------');
            $this->getActions($professional,$dates);
            $this->info('-------------------');
        }
    }

    public function getActions($professional,$dates){
        $client = new Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/profesionales?q={"rut":{"eq":"'.$professional->user->rut.'"}}';

        $response = $client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Token '.$this->token,
            ]
            ]);

        $professional_medelink = json_decode($response->getBody());
        $id = $professional_medelink->data[0]->id;

        $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/'.$id;
        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);
        $coff = $professional->coeff;
        
        $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/'.$id.'/citas?q={"fecha":{"gt":"'.$dates[1].'"},"fecha":{"lt":"'.$dates[2].'"},"estado_cita":{"eq":"Atendido"}}&sort=fecha:desc';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $body = json_decode($response->getBody());
        
        while(True){
            
            foreach($body->data as $j => $data){
                if($data->fecha < $dates[1] or $data->fecha > $dates[2]){
                    continue;
                }

                $id_atencion = $data->id_atencion;
                
                $client = new \GuzzleHttp\Client();

                $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/'.$id_atencion.'/detalles';

                $response = $client->request('GET', $url, [
                    'headers'  => [
                        'Authorization' => 'Token ' . $this->token
                    ]
                ]);

                $prestaciones = json_decode($response->getBody());
                // $this->info($data->nombre_paciente." ".$data->fecha." ".$data->hora_inicio);
                foreach($prestaciones->data as $i => $action){                    
                    $new_row = actionMl::updateOrCreate([
                        'Tratamiento_Nr'=> $data->id_atencion,
                        'Prestacion_Nr'=> $action->id_prestacion
                    ],[
                        'Sucursal'=> $data->nombre_sucursal, 
                        'Nombre'=> $data->nombre_paciente, 
                        'Apellido'=> '', 
                        'Categoria_Nr' => $action->id_prestacion, 
                        'Categoria_Nombre'=> $action->nombre_prestacion, 
                        'Tratamiento_Nr'=> $data->id_atencion, 
                        'Profesional'=> $data->nombre_profesional, 
                        'Estado'=> $data->estado_cita, 
                        'Convenio'=> '', 
                        'Prestacion_Nr'=> $action->id_prestacion, 
                        'Prestacion_Nombre'=> $action->nombre_prestacion, 
                        'Fecha_Realizacion'=> $data->fecha, 
                        'Precio_Prestacion'=> $action->total, 
                        'Abono'=> $action->pagado, 
                        'Total'=> $action->total, 
                        'created_at'=> Carbon::Now(),
                        'updated_at'=> Carbon::Now()
                    ]);

                    $this->info('Creado '.$new_row->Nombre.' '.$new_row->Tratamiento_Nr.' '.$new_row->Prestacion_Nombre.' '.$new_row->Fecha_Realizacion.' '.$new_row->Precio_Prestacion.' '.$new_row->Abono.' '.$new_row->Total);
                }
            }
            if(!isset($body->links->next)){
                break;
            }
            $url = $body->links->next;
            $response = $client->request('GET', $url, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            $body = json_decode($response->getBody());
            
        }
    }
}
