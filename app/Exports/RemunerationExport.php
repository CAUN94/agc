<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\ActionMl;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class RemunerationExport implements FromCollection, WithHeadings
{
    use Exportable; 

    public $id;
    public $expiredstartOfMonth;
    public $expiredendOfMonth;
    public $coff;
    
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($id, $expiredstartOfMonth, $expiredendOfMonth,$coff)
    {
        $this->id = $id;
        $this->expiredstartOfMonth = $expiredstartOfMonth;
        $this->expiredendOfMonth = $expiredendOfMonth;
        $this->coff = $coff;
    }

    public function headings(): array
    {
        // Define las columnas que deseas incluir en el encabezado
        return [
            'Nombre',
            'Prestación_Nombre',
            'Fecha_Realizacion',
            'Precio_Prestacion',
            'Coeficiente',
            'Remuneración'
        ];
    }

    public function collection()
    {
        $actions = ActionMl::select('Nombre',
        'Prestación_Nombre',
        'Fecha_Realizacion',
        'Precio_Prestacion',
        'Coff',
        'Remuneración')->where('Estado','Atendido')->where('Fecha_Realizacion','>',$this->expiredstartOfMonth->format('Y-m-d'))
            ->where('Fecha_Realizacion','<',$this->expiredendOfMonth->format('Y-m-d'))
            ->where('Profesional',$this->id)
            ->groupBy('Tratamiento_Nr')
            ->select('Nombre',
            'Prestacion_Nombre',
            'Fecha_Realizacion',
            DB::raw('SUM(Precio_Prestacion) as PP'),
            DB::raw($this->coff),
            DB::raw('SUM(Precio_Prestacion) as TP'))
            ->orderby('Fecha_Realizacion', 'DESC')->get();
        foreach($actions as $action)
        {
            $action->PP = Helper::moneda_chilena($action->PP);
        }
        foreach($actions as $action)
        {
            $action->TP = Helper::moneda_chilena(ceil(($action->TP * $this->coff)/100));
        }

        return $actions;
    }
}
