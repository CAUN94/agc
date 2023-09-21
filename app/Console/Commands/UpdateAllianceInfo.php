<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateAllianceInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:update-alliance-info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update alliance info from the API';

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
        $client = new \GuzzleHttp\Client();
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

      $alliances = array_merge(...$allAlliance);

      foreach($alliances as $alliance){
        $this->info('Updating alliance: ' . $alliance->nombre);
        $id_empresa = $alliance->id_empresa;
        $url = 'https://api.medilink.healthatom.com/api/v1/empresas/'.$id_empresa;
        
        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);

        $allianceInfo = json_decode($response->getBody());

        // update or create alliance use name as unique

        $alliance = \App\Models\Alliance::updateOrCreate(
            ['name' => $alliance->nombre],
            [
                'name' => $alliance->nombre,
                'desc' => 10,
                'alliance_name' => $allianceInfo->data->nombre,
                'contact_name' => $allianceInfo->data->contacto,
                'contact_phone_1' => $allianceInfo->data->telefono_1,
                'contact_phone_2' => $allianceInfo->data->telefono_2,
                'city' => $allianceInfo->data->ciudad,
                'state' => $allianceInfo->data->comuna,
                'email' => $allianceInfo->data->mail,
                'medilink_desc' => $alliance->descuento,
            ]
        ); 

        $this->info('Alliance updated: ' . $alliance->name);



      }
    }
}
