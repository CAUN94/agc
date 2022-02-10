<?php

namespace App\Http\Livewire;

use App\Models\Training;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\LabelColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TrainingsTable extends LivewireDatatable
{
    public $exportable = true;
    public $hideable = 'select';

    public function builder()
    {
        return Training::query();
    }

    public function columns()
    {
        return [
            Column::name('name')
                ->label('Nombre')
                ->editable(),
            Column::name('Class')
                ->label('Cantidad')
                ->editable(),
            Column::name('time_in_minutes')
                ->label('Tiempo')
                ->editable(),
            Column::name('format')
                ->label('Formato')
                ->editable(),
            Column::name('type')
                ->label('Tipo')
                ->editable(),
            Column::name('price')
                ->label('Precio')
                ->editable(),
            Column::name('extra')
                ->label('Extra')
                ->editable(),
            Column::name('period')
                ->label('Precio')
                ->editable()
        ];
    }
}
