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

        $query_string   = '?q={"fecha":{"gt":"2022-09-01"}}';
        $url = 'https://api.medilink.healthatom.com/api/v1/atenciones/';
        $url = $url."".$query_string;

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $allActions = [];
        $actions = json_decode($response->getBody());
        $allActions[] = $actions->data;

        foreach ($actions->data as $action) {

          if($action->finalizado=1){
            $estado = 'Atendido';
          }else{
            $estado = 'No Atendido';
          }

          if(empty($action->convenio)){
            $action->convenio = 'Sin Convenio';
          }

          $nombre = strtok($action->nombre_paciente,  ' ');
          $apellido = substr($action->nombre_paciente, strpos($action->nombre_paciente, " ") + 1);

            $new_row = actionMl::create([
              'id'=> $action->id,
              'Sucursal'=> $action->nombre_sucursal,
              'Nombre'=>$nombre,
              'Apellido'=>$apellido,
              'Categoria_Nr' => $action->id_tipo,
              'Categoria_Nombre'=> $action->nombre_tipo,
              'Tratamiento_Nr'=> $action->id,
              'Profesional'=> $action->nombre_profesional,
              'Estado'=> $estado,
              'Convenio'=> $action->nombre_convenio,
              'Prestacion_Nr'=> $action->id,
              'Prestacion_Nombre'=> $action->nombre_tipo,
              'Fecha_Realizacion'=> $action->fecha,
              'Precio_Prestacion'=> $action->total,
              'Abono'=> $action->abonado,
              'Total'=> $action->total_realizado,
              'created_at'=> Carbon::Now(),
              'updated_at'=> Carbon::Now()
            ]);
          $new_row->save();
        }

        while(isset($actions->links->next)){
            $response = $client->request('GET', $actions->links->next, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            $actions = json_decode($response->getBody());
            $allActions[] = $actions->data;

            foreach ($actions->data as $action) {

              if($action->finalizado=1){
                $estado = 'Atendido';
              }else{
                $estado = 'No Atendido';
              }

              if($action->convenio=""){
                $action->convenio = 'Sin Convenio';
              }

              $nombre = strtok($action->nombre_paciente,  ' ');
              $apellido = substr($action->nombre_paciente, strpos($action->nombre_paciente, " ") + 1);

                $new_row = actionMl::create([
                  'id'=> $action->id,
                  'Sucursal'=> $action->nombre_sucursal,
                  'Nombre'=>$nombre,
                  'Apellido'=>$apellido,
                  'Categoria_Nr' => $action->id_tipo,
                  'Categoria_Nombre'=> $action->nombre_tipo,
                  'Tratamiento_Nr'=> $action->id,
                  'Profesional'=> $action->nombre_profesional,
                  'Estado'=> $estado,
                  'Convenio'=> $action->nombre_convenio,
                  'Prestacion_Nr'=> $action->id,
                  'Prestacion_Nombre'=> $action->nombre_tipo,
                  'Fecha_Realizacion'=> $action->fecha,
                  'Precio_Prestacion'=> $action->total,
                  'Abono'=> $action->abonado,
                  'Total'=> $action->total_realizado,
                  'created_at'=> Carbon::Now(),
                  'updated_at'=> Carbon::Now()
                ]);
              $new_row->save();
            }
        }

         $this->info(count(array_merge(...$allActions)));
    }
}
