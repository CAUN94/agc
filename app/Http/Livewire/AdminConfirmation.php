<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminConfirmation extends Component
{
    public $newdate;

    public function mount(){
        $this->view = 'edit';
        $this->newdate = Carbon::tomorrow()->format('Y-m-d');
        // ddd($this->appointments);
    }

    public function New()
    {
        $date = $this->newdate;
        $this->token = config('app.medilink');
        $date = Carbon::parse($date)->format('Y-m-d');
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.dentalink.healthatom.com/api/v1/citas?q={"fecha":{"eq":"'.$date.'"}}';
        $response = $client->request('GET', $url, [
            'headers'  => [
                'Authorization' => 'Token ' . $this->token
            ]
        ]);
        $appointments = json_decode($response->getBody())->data;
        usort($this->appointments, fn($a, $b) => $a->hora_inicio <=> $b->hora_inicio);
        $this->appointments = array_filter($appointments, function ($var) {
            return in_array($var->estado_cita,['No confirmado','Agenda Online','Lista de espera']);
        });
    }

    public function render()
    {
        $this->token = config('app.medilink');
        $date = $this->newdate;
        $client = new \GuzzleHttp\Client();
        $url = 'https://api.medilink.healthatom.com/api/v1/citas?q={"fecha":{"eq":"'.$date.'"}}';
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
        return view('livewire.admin-confirmation');
    }
}
