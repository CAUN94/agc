<?php

namespace App\Console\Commands;

use App\Models\CommandSchedule;
use App\Models\UserMl;
use Carbon\Carbon;
use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Symfony\Component\HttpClient\HttpClient;

class UpdateUsersMedilink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:UpdateUsersMedilink';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Users Medilink';

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
        $command->command = 'UpdateUsersMedilink';
        $command->save();
        $this->userMl();
        $this->info('----');
    }

    public function userMl(){
        $this->info("Users: ".UserMl::all()->count());
        $split = self::create_client("https://youjustbetter.softwaremedilink.com/reportesdinamicos/reporte/pacientes_nuevos");
        foreach($split as $string){
            $jsonobj = "{".$string."}";
            $value = json_decode($jsonobj,true);
            $limit = Carbon::parse(UserMl::max('Fecha_Ingreso'));
            if(is_null($value['Fecha Afiliación'])){
                continue;
            }
            $now = Carbon::parse($value['Fecha Afiliación']);
            if($now<$limit){
                continue;
            }
            $userMl = UserMl::updateOrCreate(
                [
                    'RUT' => $value['RUT/DNI'],
                    'Email' => $value['E-Mail'],
                ],
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
        }
        $this->info("Users: ".UserMl::all()->count());
        $this->info("Users Updated");
    }

    public function create_client($url, $filter = False){
        $client = new Client();
        $crawler = $client->request('GET', 'https://youjustbetter.softwaremedilink.com/reportesdinamicos');
        $form = $crawler->selectButton('Ingresar')->form();
        
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
}
