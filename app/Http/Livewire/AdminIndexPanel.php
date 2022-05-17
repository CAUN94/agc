<?php

namespace App\Http\Livewire;

use App\Helpers\Helper;
use App\Models\ActionMl;
use App\Models\AppointmentMl;
use App\Models\PaymentMl;
use App\Models\Student;
use App\Models\Training;
use App\Models\TreatmentMl;
use App\Models\User;
use App\Models\UserMl;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;
use Illuminate\Support\Facades\DB;
use Session as FlashSession;

class AdminIndexPanel extends Component
{
    public $usersApp;
    public $studentsApp;
    public $usersMl;
    public $actionsMl;
    public $all_actions;
    public $sub_actions;
    public $appointmenstMl;
    public $paymentsMl;
    public $treatmentsMl;
    public $now;
    public $startOfMonth;
    public $endOfMonth;
    public $plans;
    public $newStartOfMonth;
    public $newEndOfMonth;
    public $showDataLabels = false;

    public function mount(){
        $this->now = Carbon::Now();
        if (Carbon::now()->format('d') <= 21 ){
            $this->startOfMonth = Carbon::createFromDate($this->now->copy()->format('Y'),$this->now->copy()->format('m')-1,21)->startOfDay();
            $this->endOfMonth = Carbon::createFromDate($this->now->copy()->format('Y'),$this->now->copy()->format('m'),20)->endOfDay();
        } else {
            $this->startOfMonth = Carbon::createFromDate($this->now->copy()->format('Y'),$this->now->copy()->format('m'),21)->startOfDay();
            $this->endOfMonth = Carbon::createFromDate($this->now->copy()->format('Y'),$this->now->copy()->format('m')+1,20)->endOfDay();
        }
    }

    public function submit(){
        if($this->newStartOfMonth > $this->newEndOfMonth ){
            FlashSession::flash('primary', 'Fecha mal ingresada');
        } else {
            $this->startOfMonth = Carbon::createFromDate($this->newStartOfMonth);
            $this->endOfMonth = Carbon::createFromDate($this->newEndOfMonth);
        }
    }

    public function incrementMonth(){
        $this->startOfMonth = $this->startOfMonth->addMonth();
        $this->endOfMonth = $this->endOfMonth->addMonth();
    }

    public function subMonth(){
        $this->startOfMonth = $this->startOfMonth->subMonth();
        $this->endOfMonth = $this->endOfMonth->subMonth();
    }


    public function render()
    {
        $this->usersApp = User::whereBetween('created_at',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->studentsApp = Student::whereBetween('created_at',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->usersMl = UserMl::whereBetween('Fecha_Ingreso',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->actionsMl = ActionMl::whereBetween('Fecha_Realizacion',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->appointmenstMl = AppointmentMl::whereBetween('Fecha',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->paymentsMl = PaymentMl::whereBetween('Fecha',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->treatmentsMl = TreatmentMl::whereBetween('created_at',[$this->startOfMonth,$this->endOfMonth])->count();
        $this->plans = Training::all()->count();
        $actions = ActionMl::whereBetween('Fecha_Realizacion',[$this->startOfMonth,$this->endOfMonth]);
        $this->prestacion = Helper::moneda_chilena($actions->sum('Precio_Prestacion'));
        $this->abono = Helper::moneda_chilena($actions->sum('Abono'));
        $this->atenciones = $actions->distinct('Tratamiento_Nr')->where('Profesional','<>','Internos You')->count('Tratamiento_Nr');

        // $actions = DB::select( DB::raw("Select month(Fecha_Realizacion) as m,year(Fecha_Realizacion) as y,sum(Precio_Prestacion) as PP,sum(Abono) as a from action_mls group by 1,2 order by 2,1") );
        // $actions = collect($actions);

        $columnChartModel = $actions->whereIn('Estado',['Atendido','Atendiéndose'])->groupBy('Profesional')->orderby('Profesional')->get()
            ->reduce(function ($columnChartModel, $data) {
                $type = $data->Profesional;
                $actions = ActionMl::distinct('Tratamiento_Nr')->whereBetween('Fecha_Realizacion',[$this->startOfMonth,$this->endOfMonth]);
                $value = $actions->where('Profesional',$data->Profesional)->count();
                return $columnChartModel->addColumn($type, $value, 'red');
            }, LivewireCharts::columnChartModel()
                ->setTitle('Horas de Cada Profesional')
                // ->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(false)
                ->setDataLabelsEnabled(true)
                //->setOpacity(0.25)
                // ->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
                ->setColumnWidth(90)
                ->withGrid()
            );

        return view('livewire.admin-index-panel')->with([
                'columnChartModel' => $columnChartModel,
                // 'pieChartModel' => $pieChartModel,
                // 'lineChartModel' => $lineChartModel,
                // 'areaChartModel' => $areaChartModel,
                // 'multiLineChartModel' => $multiLineChartModel,
                // 'multiColumnChartModel' => $multiColumnChartModel,
                // 'radarChartModel' => $radarChartModel,
                // 'treeChartModel' => $treeChartModel,
            ]);
    }
}
