<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserMl;
use App\Models\User;
use App\Models\Alliance;
use Illuminate\Support\Facades\DB;

class CreateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:createUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Users';

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
        $this->info("Users: ".User::all()->count());

        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/';

        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $allclients = [];
        $clients = json_decode($response->getBody());
        $allclients[] = $clients->data;

        while(isset($clients->links->next)){
            $response = $client->request('GET', $clients->links->next, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            $clients = json_decode($response->getBody());
            $allclients[] = $clients->data;

        }
        $allclients = array_merge(...$allclients);
        foreach($allclients as $user){
            if($user->rut == null or $user == '' or $user->rut == '00000000' or $user->rut == '111111111') {
                continue;
            }
            $user = User::firstOrCreate(
                [
                    'rut' => $user->rut ,
                ],
                [
                    'name' => $user->nombre,
                    'lastnames' => $user->apellidos,
                    'gender' => strtolower($user->sexo),
                    'email' => $user->email,
                    'phone' => $user->celular,
                    'birthday' => $user->fecha_nacimiento,
                    'password' => strtolower($user->rut),
                ]
            );
        }


        $this->info("Users: ".User::all()->count());
        $url = 'https://api.medilink.healthatom.com/api/v1/convenios/';

        $response = $client->request('GET', $url, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);

        $allAlliance = [];
        $alliance = json_decode($response->getBody());
        $allAlliance[] = $alliance->data;

        while(isset($alliance->links->next)){
            $response = $client->request('GET', $alliance->links->next, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]);
            $alliance = json_decode($response->getBody());
            $allAlliance[] = $alliance->data;
  
        }

        $allAlliance = array_merge(...$allAlliance);
        $this->info("Alianzas: ".Alliance::all()->count());

        foreach($allAlliance as $alliance){
            $alliance = Alliance::updateOrCreate(
                [
                    'name' => $alliance->nombre,
                ],
                [
                    'name' => $alliance->nombre,
                    'desc' => 10,
                ]
            );
        }

        $this->info("Alianzas: ".Alliance::all()->count());

        $i = 0;

        

        foreach($allclients as $user){
            if($user->rut == null or $user == '' or $user->rut == '00000000' or $user->rut == '111111111') {
                continue;
            }
            $user = User::where('rut',$user->rut)->first();
            if($user->hasAlliance()){
                continue;
            }
            $this->info('2');

            $id_paciente    = $user->id;
            $url = 'https://api.medilink.healthatom.com/api/v1/pacientes/'.$id_paciente.'/convenios';
    
            $response = $client->request('GET', $url, [
                'headers'  => [
                    'Authorization' => 'Token ' . $this->token
                ]
            ]); 

            // sleep 5 seconds if the iteration is divisible by 50

            // check if user has alliances

            if($i % 80 == 0){
                sleep(10);
            }

            $alliance = json_decode($response->getBody());

            $this->info(var_dump($alliance->data));


            if(count($alliance->data) == 0){
                DB::table('users_alliances_pivot')->insert([
                    'user_id' => $user->id,
                    'alliance_id' => 142
                ]);
                continue;
            }

            $alliance = Alliance::where('name',$alliance->data[0]->nombre)->first();

            DB::table('users_alliances_pivot')->insert([
                'user_id' => $user->id,
                'alliance_id' => $alliance->id
            ]);
            $i++;
        }

        
    }
    
}
