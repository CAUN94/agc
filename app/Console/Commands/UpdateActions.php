<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\ActionMl;
use App\Models\AppointmentMl;

class UpdateActions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:UpdateActions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->token = "WzpwZkzjncn1nyfvYx3VovEzTvpB2YSie4YPfvf1.8sggWtpBM3vzmAuE6aYAAmRYiAwxbXNIaM16oJ30";
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->allActions();
    }

    public function allActions(){
        $client = new \GuzzleHttp\Client();

        $allAtentions = AppointmentMl::where('Fecha','>','2022-12-20')
        ->where('Profesional','like','%Cons%')
        ->where('Estado','Atendido')->get();
        $this->info($allAtentions->count());
        $count = 1;
        foreach($allAtentions as $ar){
            $this->info($ar->Tratamiento_Nr);
            $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/'.$ar->Tratamiento_Nr;

            $response = $client->request('GET', $url, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);

            $atention = json_decode($response->getBody())->data;

            if($ar->Tratamiento_Nr == 22811){
                $this->info(var_dump($atention));
            }

            $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/'.$ar->Tratamiento_Nr.'/detalles';

            $response = $client->request('GET', $url, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
    
            $actions = json_decode($response->getBody())->data;
    
            $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/'.$ar->Tratamiento_Nr.'/citas';
            
    
            $response = $client->request('GET', $url, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
    
            $cita = json_decode($response->getBody())->data[0];
    
            $estado = $cita->estado_cita;
            
            foreach($actions as $action){
                $nombre = strtok($atention->nombre_paciente,  ' ');
                $apellido = substr($atention->nombre_paciente, strpos($atention->nombre_paciente, " ") + 1);
      
                $new_row = actionMl::updateOrCreate([
                  'Tratamiento_Nr'=> $atention->id,
                  'Prestacion_Nr'=> $action->id_prestacion,
                ],[
                  'Sucursal'=> $atention->nombre_sucursal,
                  'Nombre'=>$nombre,
                  'Apellido'=>$apellido,
                  'Categoria_Nr' => $atention->id_tipo,
                  'Categoria_Nombre'=> $atention->nombre_tipo,
                  'Tratamiento_Nr'=> $atention->id,
                  'Profesional'=> $atention->nombre_profesional,
                  'Estado'=> $estado,
                  'Convenio'=> $atention->nombre_convenio,
                  'Prestacion_Nr'=> $action->id_prestacion,
                  'Prestacion_Nombre'=> $action->nombre_prestacion,
                  'Fecha_Realizacion'=> $atention->fecha,
                  'Precio_Prestacion'=> $atention->total,
                  'Abono'=> $atention->abonado,
                  'Total'=> $atention->total_realizado,
                  'created_at'=> Carbon::Now(),
                  'updated_at'=> Carbon::Now()
                ]);
                $this->info($count.") ".$new_row->Profesional." ".$new_row->Fecha_Realizacion);
            }

            $count++;
        }
    }
}
