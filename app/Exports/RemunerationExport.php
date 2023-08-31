<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\ActionMl;

class RemunerationExport implements FromCollection
{
    use Exportable; 

    public $id;
    public $expiredstartOfMonth;
    public $expiredendOfMonth;
    
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($id, $expiredstartOfMonth, $expiredendOfMonth)
    {
        $this->id = $id;
        $this->expiredstartOfMonth = $expiredstartOfMonth;
        $this->expiredendOfMonth = $expiredendOfMonth;
    }

    public function collection()
    {
        
        return ActionMl::where('Estado','Atendido')
            ->where('Fecha_Realizacion','>',$this->expiredstartOfMonth->format('Y-m-d'))
            ->where('Fecha_Realizacion','<',$this->expiredendOfMonth->format('Y-m-d'))
            ->where('Profesional',$this->id)
            ->groupBy('Tratamiento_Nr')
            ->orderby('Fecha_Realizacion', 'DESC')->get();
    }
}
