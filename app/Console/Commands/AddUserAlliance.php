<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserMl;
use App\Models\User;
use App\Models\Alliance;
use Illuminate\Support\Facades\DB;

class AddUserAlliance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:AddUserAlliance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or Add Alliance to Users';

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
        $usersMl = UserML::all();

        foreach($usersMl as $userMl){
            if($userMl->Nacimiento == null){
                $userMl->Nacimiento = '1000-10-10';
            }
            $user = User::firstOrCreate(
                [
                    'rut' => $userMl->RUT,
                ],
                [
                    'name' => $userMl->Nombre,
                    'lastnames' => $userMl->Apellidos,
                    'gender' => strtolower($userMl->Sexo),
                    'email' => $userMl->Email,
                    'phone' => $userMl->Celular,
                    'birthday' => $userMl->Nacimiento,
                    'password' => strtolower($userMl->RUT),
                ]
            );
            $pivot = DB::table('users_alliances_pivot')->where('user_id', $user->id)->first();
            if(!is_null($pivot)){
                continue;
            }
            if(!is_null($userMl->Convenio)){
                $alliance = Alliance::where('name',$userMl->Convenio)->first();
                if(is_null($alliance)){
                    continue;
                }
                DB::table('users_alliances_pivot')->insert([
                    'user_id' => $user->id,
                    'alliance_id' => $alliance->id
                ]);
            }


        }
    }
}
