<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminConfirmation extends Component
{
    public function mount(){
        $this->token = "WzpwZkzjncn1nyfvYx3VovEzTvpB2YSie4YPfvf1.8sggWtpBM3vzmAuE6aYAAmRYiAwxbXNIaM16oJ30";
        $this->date = Carbon::tomorrow()->format('Y-m-d');
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.dentalink.healthatom.com/api/v1/citas?q={"fecha":{"eq":"'.$this->date.'"}}';
        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);
        $this->appointments = json_decode($response->getBody())->data;
        usort($this->appointments, fn($a, $b) => $a->hora_inicio <=> $b->hora_inicio);
        $this->appointments = array_filter($this->appointments, function ($var) {
            return in_array($var->estado_cita,['No confirmado','Agenda Online','Lista de espera']);
        });

        // ddd($this->appointments);
    }

    public function render()
    {
        return view('livewire.admin-confirmation');
    }
}
