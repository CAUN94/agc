<?php

namespace App\Http\Livewire\Students;

use App\Models\User;
use App\Models\Student;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Plans extends LivewireDatatable{
    public $exportable = true;
    public $hideable = 'select';


    public function builder()
    {
        return Student::where('user_id',$this->params)->with('Training');

    }

    public function columns()
    {
        return [
            Column::name('start_day')
                ->label('Fecha Incio')
                ->filterable()
                ->editable(),
             BooleanColumn::name('settled')
                ->label('Pagado')
                ->filterable()
                ->editable(),
            Column::name('payment_type')
                ->label('Tipo de Pago')
                ->filterable()
                ->editable(),
            Column::name('payment_id')
                ->label('Id de pago')
                ->filterable()
                ->editable(),
            Column::name('Training.name')
                ->label('Entrenamiento')
                ->filterable(),
             Column::name('Training.format')
                ->label('Formato')
                ->filterable(),
            Column::name('Training.days')
                ->label('días')
                ->filterable(),
            Column::name('Training.type')
                ->label('Tipo')
                ->filterable()
                ->editable(),
            Column::name('Training.period')
                ->label('Periodo')
                ->filterable(),
            $this->deleteView(),

        ];
    }

    public function delete($value) {
        Student::find($value)->delete();
    }

    public function deleteView($name = 'id') {
        return Column::callback($name, function ($value) {
            $user = Student::find($value);
            $fullname = 'Desinscribir a estudiante del plan '. Student::find($value)->training->name;
            return view('datatables::delete', ['value' => $value, 'fullname' => $fullname]);
        });
    }
}
