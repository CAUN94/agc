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
    public $Talla_cm;
    public $S6_pliegues;
    public $Masa_Adiposa;
    public $Z_Adiposa_show;
    public $Kg_adiposa_show;
    public $adiposa_bajar_show;
    public $showMasaAdiposa = false;
    public $M_osea;
    public $Indice_MO;
    public $M_muscular;
    public $M_muscular_show;
    public $M_muscular_aumentar_show;
    public $showMasaMuscular = false;

    public $M_adiposa_kg;
    public $M_adiposa_porc;
    public $M_muscular_kg;
    public $M_muscular_porc;
    public $M_osea_kg;
    public $M_osea_porc;
    public $indice_M_O;
    public $indice_A_M;
    public $indice_masa_corporal;
    public $somatotipo_Endo;
    public $somatotipo_Meso;
    public $somatotipo_Ecto;
    public $sumatoria_6_plieges;

    public $fecha;
    public $edad;
    public $peso;
    public $talla_parado;
    public $talla_sentado;
    public $biacromial;
    public $t_transverso;
    public $t_antero_posterior;
    public $bi_iliocrestideo;
    public $humeral;
    public $femoral;
    public $cabeza;
    public $brazo_relajado;
    public $brazo_flexionado;
    public $antebrazo_maximo;
    public $t_mesoesternal;
    public $cintura;
    public $muslo;
    public $pierna_cm;
    public $triceps;
    public $subescapular;
    public $supraespinal;
    public $abdominal;
    public $muslo_medial;
    public $pierna_mm;

    public $showAntropometria = false;

    public function selectUser($id)
    {
        $this->searchTerm = null;
        $this->user = User::find($id);
    }

    public function nutrionCreate(){

      $validate = $this->validate([

            'fecha' => ['required'],
            'edad' => ['required'],
            'peso' => ['required'],
            'talla_parado' => ['required'],
            'talla_sentado' => ['required'],
            'biacromial' => ['required'],
            't_transverso' => ['required'],
            't_antero_posterior' => ['required'],
            'bi_iliocrestideo' => ['required'],
            'humeral' => ['required'],
            'femoral' => ['required'],
            'cabeza' => ['required'],
            'brazo_relajado' => ['required'],
            'antebrazo_maximo' => ['required'],
            't_mesoesternal' => ['required'],
            'cintura' => ['required'],
            'muslo' => ['required'],
            'pierna_cm' => ['required'],
            'triceps' => ['required'],
            'subescapular' => ['required'],
            'supraespinal' => ['required'],
            'abdominal' => ['required'],
            'muslo_medial' => ['required'],
            'pierna_mm' => ['required']
        ]);

        //Masa Piel
        if($this->edad < 12){
          $const_AS = 70.691;
        }elseif ($this->user->gender = 'M') {
          $const_AS = 68.308;
          $grosor_piel = 2.07;
        }else{
          $grosor_piel = 1.96;
          $const_AS = 73.074;
        }

        $this->indice_masa_corporal = round($this->peso/pow(($this->talla_parado/100), 2), 2);

        $Area_superficial = (pow(($const_AS*$this->peso), 0.425)*pow(($this->talla_parado), 0.725))/10000;
        $Masa_Piel = ($Area_superficial*$grosor_piel*1.05);

        //Masa Adiposa
        $this->sumatoria_6_plieges = $this->triceps + $this->subescapular + $this->supraespinal + $this->abdominal + $this->muslo_medial +  $this->pierna_mm;
        $Score_Z_adiposa = ($this->sumatoria_6_plieges*(170.18/$this->talla_parado)-116.41)/34.79;
        $this->M_adiposa_kg = (($Score_Z_adiposa*5.85)+25.6)/pow((170.18/$this->talla_parado), 3);


        //Masa Muscular
        $per_Brazo_corregido = $this->brazo_relajado-($this->triceps*3.141/10);
        $per_Antebrazo = $this->antebrazo_maximo;
        $per_Muslo_corregido = $this->muslo - ($this->muslo_medial*3.141/10);
        $per_Pantorrilla_corregido = $this->pierna_cm - ($this->pierna_mm*3.141/10);
        $per_Tórax_corregido = $this->t_mesoesternal - ($this->subescapular*3.141/10);

        $Suma_perímetros_corregidos = $per_Brazo_corregido + $per_Antebrazo + $per_Muslo_corregido + $per_Pantorrilla_corregido + $per_Tórax_corregido;
        $Score_Z_muscular = (($Suma_perímetros_corregidos*(170.18/$this->talla_parado)-207.21)/13.74);
        $this->M_muscular_kg = (($Score_Z_muscular*5.4)+24.5)/pow((170.18/$this->talla_parado), 3);

        //Masa_Residual
        $per_Cintura_corregido = $this->cintura - ($this->abdominal*0.3141);
        $Suma_de_torax = $this->t_transverso + $this->t_antero_posterior + $per_Cintura_corregido;
        $Score_Z_residual = (($Suma_de_torax*(89.92/$this->talla_sentado)-109.35)/7.08);
        $Masa_Residual = (($Score_Z_residual*1.24)+6.1)/pow((89.92/$this->talla_sentado), 3);

        //Masa Osea
        $Score_Z_cabeza = ($this->cabeza - 56)/1.44;
        $Masa_osea_Cabeza = ($Score_Z_cabeza*0.18) + 1.2;

        $Suma_de_Diámetros = $this->biacromial + $this->bi_iliocrestideo + ($this->humeral*2) + ($this->femoral*2);
        $Score_Z_osea_cuerpo = (($Suma_de_Diámetros*(170.18/$this->talla_parado))-98.88)/5.33;
        $Masa_Osea_Cuerpo = (($Score_Z_osea_cuerpo*1.34)+6.7)/pow((170.18/$this->talla_parado), 3);

        $this->M_osea_kg = $Masa_osea_Cabeza + $Masa_Osea_Cuerpo;

        //Peso Estructurado y Porcentual
        $Peso_estructurado = $Masa_Piel + $this->M_adiposa_kg + $this->M_muscular_kg + $Masa_Residual + $this->M_osea_kg;
        $Diferencia_PE_PB = $Peso_estructurado - $this->peso;
        $diferencia_porc = $Diferencia_PE_PB/$this->peso;

        $this->M_adiposa_porc = ($this->M_adiposa_kg/$Peso_estructurado)*100;
        $this->M_muscular_porc = ($this->M_muscular_kg/$Peso_estructurado)*100;
        $this->M_osea_porc = ($this->M_osea_kg/$Peso_estructurado)*100;

        //Somatotipos
        $sum_SF = ($this->triceps + $this->subescapular + $this->supraespinal) * (170.18/$this->talla_parado);
        $this->somatotipo_Endo = (-0.7182 + (0.1451*$sum_SF) - (0.00068*pow($sum_SF, 2)) + (0.0000014*pow($sum_SF, 3)) );

        $this->somatotipo_Meso = (0.858*$this->humeral)+(0.601*$this->femoral)+(0.188*($this->brazo_flexionado-$this->triceps/10))+(0.161*($this->pierna_cm-$this->pierna_mm/10))-($this->talla_parado*0.131)+4.5;

        $HWR = $this->talla_parado/pow($this->peso, 0.3333);
        if($HWR>=40.75){
          $this->somatotipo_Ecto = 0.732*$HWR-28.58;
        }else{
          $this->somatotipo_Ecto = 0.463*$HWR-17.63;
        }


        //$this->indice_M_O =I51/I53;
        //$nutrition = new Nutrition;

        //$nutrition->fecha = $this->fecha;
        //$nutrition->plan = 'example.pdf';
        //$nutrition->peso = $this->peso;
        //$nutrition->talla_parado = $this->talla_parado;
        //$nutrition->talla_sentado = $this->talla_sentado;
        //$nutrition->masa_adiposa = $this->masa_adiposa;
        //$nutrition->indice_musculo = $this->indice_musculo;
        //$nutrition->masa_muscular = $this->masa_muscular;
        //$nutrition->indice_adiposo = $this->indice_adiposo;
        //$nutrition->masa_osea = $this->masa_osea;
        //$nutrition->indice_corporal = $this->indice_corporal;
        //$nutrition->tricep = $this->tricep;
        //$nutrition->bicep = $this->bicep;
        //$nutrition->muslo_medial = $this->muslo_medial;
        //$nutrition->supraespinal = $this->supraespinal;
        //$nutrition->subescapular = $this->subescapular;
        //$nutrition->cresta_iliaca = $this->cresta_iliaca;
        //$nutrition->pierna = $this->pierna;
        //$nutrition->abdominal = $this->abdominal;
        //$nutrition->rut = $this->user->rut;

        $this->showAntropometria = true;



        //$nutrition->save();
    }

    public function masaIdealCalculate(){
      $validate = $this->validate([

          'Talla_cm' => ['required'],
          'S6_pliegues' => ['required'],
          'Masa_Adiposa' => ['required'],

      ]);

      $this->Z_Adiposa_show = ($this->S6_pliegues*(170.18/$this->Talla_cm)-116.41)/34.79;
      $this->Kg_adiposa_show = (($this->Z_Adiposa_show*5.85)+25.6)/pow((170.18/$this->Talla_cm), 3);
      $this->adiposa_bajar_show = ($this->Kg_adiposa_show) - ($this->Masa_Adiposa) ;

      $this->showMasaAdiposa = true;

      $this->Talla_cm = null;
      $this->S6_pliegues = null;
      $this->Masa_Adiposa = null;
    }

    public function masaIdealMuscular(){
      $validate = $this->validate([

          'M_osea' => ['required'],
          'Indice_MO' => ['required'],
          'M_muscular' => ['required'],

      ]);

      $this->M_muscular_show = ($this->M_osea*$this->Indice_MO);
      $this->M_muscular_aumentar_show = ($this->M_muscular_show - $this->M_muscular);

      $this->showMasaMuscular = true;

      $this->M_osea = null;
      $this->Indice_MO = null;
      $this->M_muscular = null;
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
