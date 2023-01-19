<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\ActionMl;

class UpdateDatabaseActions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:UpdateDatabaseActions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Database Actions';

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

    public function allActions()
    {
      $client = new \GuzzleHttp\Client();
      $date = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
      $query_string   = '?q={"fecha":{"gt":"'.$date.'"}}';
      $url = 'https://api.medilink.healthatom.com/api/v1/atenciones';
      $url = $url."".$query_string;

      $response = $client->request('GET', $url, [
          'headers'  => [
              'Authorization' => 'Token ' . $this->token
          ]
      ]);

      $allAtentions = [];
      $atentions = json_decode($response->getBody());
      $allAtentions[] = $atentions->data;

      while(isset($atentions->links->next)){
          $response = $client->request('GET', $atentions->links->next, [
              'headers'  => [
                  'Authorization' => 'Token ' . $this->token
              ]
          ]);
          $atentions = json_decode($response->getBody());
          $allAtentions[] = $atentions->data;

      }
      $allAtentions = array_merge(...$allAtentions);
      $this->info(count($allAtentions));
      $count = 0;
      foreach($allAtentions as $atention){
        $this->info($count);
        $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/'.$atention->id.'/detalles';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $actions = json_decode($response->getBody())->data;

        $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/'.$atention->id.'/citas';
        

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
            'Estado'=> $estado,
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
        }
        $count += 1;
        if($count%20 == 0){
          sleep(12);
        }
      }

    }
}
