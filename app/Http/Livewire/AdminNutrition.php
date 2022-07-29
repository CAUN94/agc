<?php

namespace App\Http\Livewire;

use App\Models\Nutrition;
use App\Models\User;
use Livewire\Component;

class AdminNutrition extends Component
{
    public $searchTerm;
    public $users;
    public $user;
    public $user_id;
    public $fecha;
    public $peso;
    public $talla_parado;
    public $talla_sentado;
    public $masa_adiposa;
    public $indice_musculo;
    public $masa_muscular;
    public $indice_adiposo;
    public $masa_osea;
    public $indice_corporal;
    public $tricep;
    public $bicep;
    public $muslo_medial;
    public $supraespinal;
    public $subescapular;
    public $cresta_iliaca;
    public $pierna;
    public $abdominal;

    public function selectUser($id)
    {
        $this->searchTerm = null;
        $this->user = User::find($id);
    }

    public function nutrionCreate(){

        $validate = $this->validate([
            'fecha' => ['required'],
            'peso' => ['required'],
            'talla_parado' => ['required'],
            'talla_sentado' => ['required'],
            'masa_adiposa' => ['required'],
            'indice_musculo' => ['required'],
            'masa_muscular' => ['required'],
            'indice_adiposo' => ['required'],
            'masa_osea' => ['required'],
            'indice_corporal' => ['required'],
            'tricep' => ['required'],
            'bicep' => ['required'],
            'muslo_medial' => ['required'],
            'supraespinal' => ['required'],
            'subescapular' => ['required'],
            'cresta_iliaca' => ['required'],
            'pierna' => ['required'],
            'abdominal' => ['required']
        ]);


        $nutrition = new Nutrition;

        $nutrition->fecha = $this->fecha;
        $nutrition->plan = 'example.pdf';
        $nutrition->peso = $this->peso;
        $nutrition->talla_parado = $this->talla_parado;
        $nutrition->talla_sentado = $this->talla_sentado;
        $nutrition->masa_adiposa = $this->masa_adiposa;
        $nutrition->indice_musculo = $this->indice_musculo;
        $nutrition->masa_muscular = $this->masa_muscular;
        $nutrition->indice_adiposo = $this->indice_adiposo;
        $nutrition->masa_osea = $this->masa_osea;
        $nutrition->indice_corporal = $this->indice_corporal;
        $nutrition->tricep = $this->tricep;
        $nutrition->bicep = $this->bicep;
        $nutrition->muslo_medial = $this->muslo_medial;
        $nutrition->supraespinal = $this->supraespinal;
        $nutrition->subescapular = $this->subescapular;
        $nutrition->cresta_iliaca = $this->cresta_iliaca;
        $nutrition->pierna = $this->pierna;
        $nutrition->abdominal = $this->abdominal;
        $nutrition->rut = $this->user->rut;

        $this->fecha = null;
        $this->peso = null;
        $this->talla_parado = null;
        $this->talla_sentado = null;
        $this->masa_adiposa = null;
        $this->indice_musculo = null;
        $this->masa_muscular = null;
        $this->indice_adiposo = null;
        $this->masa_osea = null;
        $this->indice_corporal = null;
        $this->tricep = null;
        $this->bicep = null;
        $this->muslo_medial = null;
        $this->supraespinal = null;
        $this->subescapular = null;
        $this->cresta_iliaca = null;
        $this->pierna = null;
        $this->abdominal = null;
        $this->user->rut = null;

        $nutrition->save();
    }

    public function render()
    {
        $query = User::query();
        if (empty($this->searchTerm)) {
            $this->users = User::where('rut', $this->searchTerm)->get();
        } else {
            $columns = ['rut', 'name', 'lastnames', 'phone'];
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $this->searchTerm . '%');
            }
            $this->users = $query->get();
        }
        return view('livewire.admin-nutrition');
    }
}
