<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\ActionMl;
use App\Helpers\Helper;

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
            'Tratamiento_Nr',
            'Nombre',
            'Apellido',
            'Estado',
            'Prestanción Nr',
            'Prestación Nombre',
            'Fecha_Realizacion',
            'Remuneración'
        ];
    }

    public function collection()
    {
        $actions = ActionMl::select('Tratamiento_Nr','Nombre','Apellido','Estado','Prestacion_nr','Prestacion_Nombre','Fecha_Realizacion','Precio_Prestacion')->where('Estado','Atendido')->where('Fecha_Realizacion','>',$this->expiredstartOfMonth->format('Y-m-d'))
            ->where('Fecha_Realizacion','<',$this->expiredendOfMonth->format('Y-m-d'))
            ->where('Profesional',$this->id)
            ->groupBy('Tratamiento_Nr')
            ->orderby('Fecha_Realizacion', 'DESC')->get();
        
        foreach($actions as $action)
        {
            
            $action->Precio_Prestacion = Helper::moneda_chilena(ceil(($action->Precio_Prestacion * $this->coff)/100));
        }

        return $actions;
    }
}
