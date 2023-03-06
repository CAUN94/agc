<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\ActionMl;

use App\Models\AppointmentMl;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $this->token = config('app.medilink');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $ids = [2,49,46,10,19,48,26,37,20,44,54,52,53,50,34,47,45,54,35];
        foreach($ids as $id){
            $this->allActions($id);
            sleep(5);
        }
        
    }

    public function allActions($id){
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/'.$id;
        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $rut = json_decode($response->getBody())->data->rut;
        if(!isset(User::where('rut',$rut)->first()->professional->coeff)){
            return;
        }
        $coff = User::where('rut',$rut)->first()->professional->coeff;

        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/profesionales/'.$id.'/citas?q={"fecha":{"gt":"2023-01-20"},"estado_cita":{"eq":"Atendido"}}&sort=fecha:desc';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $body = json_decode($response->getBody());
        $appointments = [];
        $pays = [];
        $total_final = 0;
        // $i = 0;
        while(True){
            foreach($body->data as $j => $data){
                // $i++;
                // if($i >= 60){
                //     break;
                // }
                sleep(2);
                if($data->fecha < '2023-01-21' or $data->fecha > '2023-03-20'){
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
                $pay = json_decode($response->getBody());
                // $total += $pay->data->total;
                $total = 0;
                foreach($pay->data as $i => $data_pay){
                    if($data_pay->total === 0 or !isset($data_pay->total)){
                        $client = new \GuzzleHttp\Client();

                        $url = 'https://api.medilink.healthatom.com/api/v1/prestaciones/'.$data_pay->id_prestacion;
                        $response = $client->request('GET', $url, [
                            'headers'  => [
                                'Authorization' => 'Token ' . $this->token
                            ]
                        ]);
                        $prestacion = json_decode($response->getBody())->data;
                        // ddd($data_pay);
                        $total += $data_pay->subtotal;
                        $pay->data[$i]->total = $data_pay->subtotal;


                    } else {
                        $total += $data_pay->total;
                    }

                }
                if(count($pay->data) == 0){
                    $total += 23990;
                    $pay = ['pagado' => 0, 'total' => 23990];
                    $pay = (object)$pay;
                    $pay = [$pay];
                } else {
                    $pay = $pay->data;
                }

                $total_final += $total;
                $pays[] = [$data, $pay,$total];
                // $pays[] = [$data, $pay->data];

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
        // return $total;

        foreach($pays as $pay){
            $this->info($pay[0]->nombre_paciente);
            foreach($pay[1] as $action){
                $this->info(isset($action->id_prestacion));
                if(!isset($action->id_prestacion)){
                    $action->id_prestacion = $pay[0]->nombre_atencion;
                    $action->nombre_prestacion = $pay[0]->nombre_atencion;
                    $action->subtotal = $action->total;
                }
                $this->info(isset($action->nombre_prestacion));
                $new_row = actionMl::updateOrCreate([
                    'Tratamiento_Nr'=> $pay[0]->id_atencion,
                    'Prestacion_Nr'=> $action->id_prestacion,
                ],[
                    'Sucursal'=> $pay[0]->nombre_sucursal,
                    'Nombre'=>$pay[0]->nombre_paciente,
                    'Apellido'=>'',
                    'Categoria_Nr' => $pay[0]->nombre_atencion,
                    'Categoria_Nombre'=> $pay[0]->nombre_atencion,
                    'Tratamiento_Nr'=> $pay[0]->id_atencion,
                    'Profesional'=> $pay[0]->nombre_profesional,
                    'Estado'=> $pay[0]->estado_cita,
                    'Convenio'=> '',
                    'Prestacion_Nr'=> $action->id_prestacion,
                    'Prestacion_Nombre'=> $action->nombre_prestacion,
                    'Fecha_Realizacion'=> $pay[0]->fecha,
                    'Precio_Prestacion'=> $action-> total,
                    'Abono'=> $action->pagado,
                    'Total'=> $action->total,
                    'created_at'=> Carbon::Now(),
                    'updated_at'=> Carbon::Now()
                ]);
            }
        }
        
        $this->info(count($pays));
    }
   
}
