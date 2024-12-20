<?php

namespace App\Http\Livewire;

use App\Models\Nutrition;
use App\Models\NutritionDocuments;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;


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
    public $deporte;
    public $deporteEndo;
    public $deporteMeso;
    public $deporteEcto;
    public $deporteSumatoria;
    public $section = 0;

    public $fecha;
    public $edad;
    public $sexo = 'none';
    public $rut;
    public $peso;
    public $habito;
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
    public $cadera;
    public $muslo_maximo;
    public $muslo_medio;
    public $pierna_cm;
    public $triceps;
    public $subescapular;
    public $biceps;
    public $cresta_iliaca;
    public $supraespinal;
    public $abdominal;
    public $muslo_medial;
    public $pierna_mm;
    public $commentary;

    public $showAntropometria = false;
    public $nutritionID;
    public $viewsNutrition;
    public $nutrition;
    public $sesionPrevia;

    public function selectUser($id)
    {
        $this->searchTerm = null;
        $this->user = User::find($id);
        $this->edad = Carbon::parse($this->user->birthday)->age;
        $this->sexo = $this->user->gender;
        $this->rut = $this->user->rut;
        $sesionPrevia = Nutrition::where("rut", $this->user->rut)->latest()->first();
        if($sesionPrevia){
        $this->deporte = $sesionPrevia->deporte;
        $this->deporteSumatoria = $sesionPrevia->oseo_referencial;
        $this->peso = $sesionPrevia->peso;
        $this->talla_parado = $sesionPrevia->talla_parado;
        $this->talla_sentado = $sesionPrevia->talla_sentado;
        $this->biacromial = $sesionPrevia->biacromial;
        $this->t_transverso = $sesionPrevia->torax_t;
        $this->t_antero_posterior = $sesionPrevia->torax_ap ;
        $this->bi_iliocrestideo = $sesionPrevia->iliocrestideo;
        $this->humeral = $sesionPrevia->humeral;
        $this->femoral = $sesionPrevia->femoral;
        $this->cabeza = $sesionPrevia->cabeza;
        $this->brazo_relajado = $sesionPrevia->brazo_r;
        $this->brazo_flexionado = $sesionPrevia->brazo_flex;
        $this->antebrazo_maximo = $sesionPrevia->antebrazo_max;
        $this->t_mesoesternal = $sesionPrevia->torax_meso;
        $this->cintura = $sesionPrevia->cintura;
        $this->cadera = $sesionPrevia->cadera;
        $this->muslo_maximo = $sesionPrevia->muslo_max;
        $this->muslo_medio = $sesionPrevia->muslo_medio;
        $this->pierna_cm = $sesionPrevia->pierna_cm;
        $this->triceps = $sesionPrevia->tricep;
        $this->subescapular = $sesionPrevia->subescapular;
        $this->biceps = $sesionPrevia->biceps;
        $this->cresta_iliaca = $sesionPrevia->cresta_iliaca;
        $this->supraespinal = $sesionPrevia->supraespinal;
        $this->abdominal = $sesionPrevia->abdominal;
        $this->muslo_medial = $sesionPrevia->muslo_medial;
        $this->pierna_mm = $sesionPrevia->pierna_mm;
        }else{
          $this->deporte = null;
          $this->deporteSumatoria = null;
          $this->peso = null;
          $this->talla_parado = null;
          $this->talla_sentado = null;
          $this->biacromial = null;
          $this->t_transverso = null;
          $this->t_antero_posterior = null;
          $this->bi_iliocrestideo = null;
          $this->humeral = null;
          $this->femoral = null;
          $this->cabeza = null;
          $this->brazo_relajado = null;
          $this->brazo_flexionado = null;
          $this->antebrazo_maximo = null;
          $this->t_mesoesternal = null;
          $this->cintura = null;
          $this->cadera = null;
          $this->muslo_maximo = null;
          $this->muslo_medio = null;
          $this->pierna_cm = null;
          $this->triceps = null;
          $this->subescapular = null;
          $this->biceps = null;
          $this->cresta_iliaca = null;
          $this->supraespinal = null;
          $this->abdominal = null;
          $this->muslo_medial = null;
          $this->pierna_mm = null;
          $this->commentary = null;
        }
    }

    public function updatedNutritionId()
    {
        $this->viewsNutrition = Nutrition::find($this->nutritionID);
        $this->commentary = null;
        if(!is_null($this->viewsNutrition)){
          if($this->viewsNutrition->comment){
            $this->commentary = $this->viewsNutrition->comment;
          }
        }
    }

    public function nutrionCreate(){

      $validate = $this->validate([

            'fecha' => ['required'],
            'peso' => ['required'],
            'sexo' => ['required'],
            'habito' => ['required'],
            'deporte' => ['required'],
            'deporteSumatoria' => ['required'],
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
            'brazo_flexionado' => ['required'],
            'antebrazo_maximo' => ['required'],
            't_mesoesternal' => ['required'],
            'cintura' => ['required'],
            'cadera' => ['required'],
            'muslo_maximo' => ['required'],
            'muslo_medio' => ['required'],
            'pierna_cm' => ['required'],
            'triceps' => ['required'],
            'subescapular' => ['required'],
            'biceps' => ['required'],
            'cresta_iliaca' => ['required'],
            'supraespinal' => ['required'],
            'abdominal' => ['required'],
            'muslo_medial' => ['required'],
            'pierna_mm' => ['required']
        ]);

        //Masa Piel
        if($this->edad < 12){
          $const_AS = 70.691;
        }elseif ($this->sexo == 'm') {
          $const_AS = 68.308;
          $grosor_piel = 2.07;
        }else{
          $grosor_piel = 1.96;
          $const_AS = 73.074;
        }

        $Indice_masa_corporal = round($this->peso/pow(($this->talla_parado/100), 2), 2);

        $Area_superficial = ($const_AS*(pow($this->peso, 0.425))*(pow($this->talla_parado, 0.725)))/10000;
        $Masa_Piel = ($Area_superficial*$grosor_piel*1.05);


        //Masa Adiposa
        $sumatoria_6_plieges = $this->triceps + $this->subescapular + $this->supraespinal + $this->abdominal + $this->muslo_medial +  $this->pierna_mm;
        $Score_Z_adiposa = ($sumatoria_6_plieges*(170.18/$this->talla_parado)-116.41)/34.79;
        $M_adiposa_kg = (($Score_Z_adiposa*5.85)+25.6)/pow((170.18/$this->talla_parado), 3);


        //Masa Muscular
        $per_Brazo_corregido = $this->brazo_relajado-($this->triceps*3.141/10);
        $per_Antebrazo = $this->antebrazo_maximo;
        $per_Muslo_corregido = $this->muslo_maximo - ($this->muslo_medial*3.141/10);
        $per_Pantorrilla_corregido = $this->pierna_cm - ($this->pierna_mm*3.141/10);
        $per_Tórax_corregido = $this->t_mesoesternal - ($this->subescapular*3.141/10);

        $Suma_perímetros_corregidos = $per_Brazo_corregido + $per_Antebrazo + $per_Muslo_corregido + $per_Pantorrilla_corregido + $per_Tórax_corregido;
        $Score_Z_muscular = (($Suma_perímetros_corregidos*(170.18/$this->talla_parado)-207.21)/13.74);
        $M_muscular_kg = (($Score_Z_muscular*5.4)+24.5)/pow((170.18/$this->talla_parado), 3);


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

        $M_osea_kg = $Masa_osea_Cabeza + $Masa_Osea_Cuerpo;

        //Peso Estructurado y Porcentual
        $Peso_estructurado = $Masa_Piel + $M_adiposa_kg + $M_muscular_kg + $Masa_Residual + $M_osea_kg;
        $diferencia_PE_PB = ($Peso_estructurado) - ($this->peso);
        $diferencia_porc = $diferencia_PE_PB/$this->peso;

        $M_adiposa_porc = ($M_adiposa_kg/$Peso_estructurado);
        $M_muscular_porc = ($M_muscular_kg/$Peso_estructurado);
        $M_osea_porc = ($M_osea_kg/$Peso_estructurado);

        $Masa_osea_reajustada = ($M_osea_kg - ($M_osea_porc*$diferencia_PE_PB));
        $Masa_muscular_reajustada = ($M_muscular_kg - ($M_muscular_porc*$diferencia_PE_PB));
        $Masa_adiposa_reajustada = ($M_adiposa_kg - ($M_adiposa_porc*$diferencia_PE_PB));
        $Masa_piel_reajustada = ($Masa_Piel - (($Masa_Piel/$Peso_estructurado)*$diferencia_PE_PB));
        $masa_residual_reajustada = ($Masa_Residual - (($Masa_Residual/$Peso_estructurado)*$diferencia_PE_PB));

        $Peso_estructurado_reajustado = $Masa_adiposa_reajustada + $Masa_osea_reajustada + $Masa_muscular_reajustada + $Masa_piel_reajustada + $masa_residual_reajustada;
        $M_adiposa_porc = ($Masa_adiposa_reajustada/$Peso_estructurado_reajustado)*100;
        $M_muscular_porc = ($Masa_muscular_reajustada/$Peso_estructurado_reajustado)*100;
        $M_osea_porc = ($Masa_osea_reajustada/$Peso_estructurado_reajustado)*100;


        //Somatotipos
        $sum_SF = ($this->triceps + $this->subescapular + $this->supraespinal) * (170.18/$this->talla_parado);
        $somatotipo_Endo = (-0.7182 + (0.1451*$sum_SF) - (0.00068*pow($sum_SF, 2)) + (0.0000014*pow($sum_SF, 3)) );

        $somatotipo_Meso = (0.858*$this->humeral)+(0.601*$this->femoral)+(0.188*($this->brazo_flexionado-$this->triceps/10))+(0.161*($this->pierna_cm-$this->pierna_mm/10))-($this->talla_parado*0.131)+4.5;

        $HWR = $this->talla_parado/pow($this->peso, 0.3333);
        if($HWR>=40.75){
          $somatotipo_Ecto = 0.732*$HWR-28.58;
        }else{
          $somatotipo_Ecto = 0.463*$HWR-17.63;
        }

        $nutrition = new Nutrition;

        $nutrition->fecha = $this->fecha;
        $nutrition->plan = $this->user->name ." ". $this->user->lastnames;
        $nutrition->peso = $this->peso;
        $nutrition->talla_parado = $this->talla_parado;
        $nutrition->talla_sentado = $this->talla_sentado;
        $nutrition->biacromial = $this->biacromial;
        $nutrition->torax_t= $this->t_transverso;
        $nutrition->torax_ap= $this->t_antero_posterior;
        $nutrition->iliocrestideo= $this->bi_iliocrestideo;
        $nutrition->humeral= $this->humeral;
        $nutrition->femoral= $this->femoral;
        $nutrition->cabeza= $this->cabeza;
        $nutrition->brazo_r= $this->brazo_relajado;
        $nutrition->brazo_flex= $this->brazo_flexionado;
        $nutrition->antebrazo_max= $this->antebrazo_maximo;
        $nutrition->cintura= $this->cintura;
        $nutrition->cadera= $this->cadera;
        $nutrition->muslo_max= $this->muslo_maximo;
        $nutrition->muslo_medio=$this->muslo_medio;
        $nutrition->pierna_cm= $this->pierna_cm;
        $nutrition->pierna_mm= $this->pierna_mm;
        $nutrition->torax_meso= $this->t_mesoesternal;
        $nutrition->torax_meso= $this->t_mesoesternal;
        $nutrition->abdominal = $this->abdominal;
        $nutrition->tricep = $this->triceps;
        $nutrition->muslo_medial = $this->muslo_medial;
        $nutrition->supraespinal = $this->supraespinal;
        $nutrition->subescapular = $this->subescapular;
        $nutrition->biceps = $this->biceps;
        $nutrition->cresta_iliaca = $this->cresta_iliaca;
        $nutrition->masa_adiposa = $Masa_adiposa_reajustada;
        $nutrition->masa_adiposa_porc = $M_adiposa_porc;
        $nutrition->masa_muscular = $Masa_muscular_reajustada;
        $nutrition->masa_muscular_porc = $M_muscular_porc;
        $nutrition->masa_osea = $Masa_osea_reajustada;
        $nutrition->masa_osea_porc = $M_osea_porc;
        $nutrition->masa_piel = $Masa_piel_reajustada;
        $nutrition->masa_residual = $masa_residual_reajustada;
        $nutrition->indice_adiposo = $Masa_adiposa_reajustada/$Masa_muscular_reajustada;
        $nutrition->indice_musculo = $Masa_muscular_reajustada/$Masa_osea_reajustada;
        $nutrition->indice_corporal = $Indice_masa_corporal;
        $nutrition->peso_estructurado = $Peso_estructurado_reajustado;
        $nutrition->diferencia_peso = $diferencia_PE_PB;
        $nutrition->endo = $somatotipo_Endo;
        $nutrition->meso = $somatotipo_Meso;
        $nutrition->ecto = $somatotipo_Ecto;
        $nutrition->oseo_referencial = $this->deporteSumatoria;
        $nutrition->rut = $this->user->rut;
        $nutrition->edad = $this->edad;
        $nutrition->gender = $this->sexo;
        $nutrition->habito = $this->habito;
        $nutrition->deporte = $this->deporte;

        $this->showAntropometria = true;
        $this->viewsNutrition = $nutrition;
        session()->flash('nutricionMensaje','Se cargó la informacion exitosamente');
        $nutrition->save();
    }

    public function addCommentary(){
      $validate = $this->validate([
          'commentary' => ['required'],
      ]);

      $this->viewsNutrition->comment = $this->commentary;
      $this->viewsNutrition->save();
      session()->flash('comentarioMensaje','Se incluyo el mensaje exitosamente');
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

    public function pdf($id){
        $nutrition = Nutrition::find($id);
        if($nutrition){
          $pdf = pdf::loadView('livewire.pdf', compact('nutrition'));

          $pdf->render();
          $nutrucion_pdf = new NutritionDocuments;
          $pdfFecha = Carbon::parse($nutrition->fecha)->format('d-m-Y');
          $nutrucion_pdf->pdf = $pdf->output();
          $nutrucion_pdf->save();

          return $pdf->download($nutrition->plan ."_".$pdfFecha . '.pdf');
        }
    }

    public function sesionPrevia($user){
      $ultimaSesion = Nutrition::where("rut", $user->rut)->latest()->first();
      if(is_null($ultimaSesion)){
        $sesionDatos = [
          "peso" => '-',
          "altura" => '-',
          "fecha" =>'Sin Registro',
          "edad" => Carbon::parse($user->birthday)->diff(\Carbon\Carbon::now())->format('%y años')
      ];

      }else{
        $sesionDatos = [
          "peso" => $ultimaSesion->peso,
          "altura" => round($ultimaSesion->talla_parado/100, 2),
          "fecha" => Carbon::parse($ultimaSesion->fecha)->format('d-m-Y'),
          "edad" => Carbon::parse($user->birthday)->diff(\Carbon\Carbon::now())->format('%y años')
      ];
      }
      return $sesionDatos;
    }

    public function selectionMenu($menu){
      return $this->section = $menu;
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
