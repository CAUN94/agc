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
    public function builder()
    {
        return Training::query();
    }

    public function columns()
    {
        return [
            Column::name('name')
                ->label('Nombre')
                ->searchable()
                ->editable(),
            Column::name('Class')
                ->label('Cantidad')
                ->searchable()
                ->editable(),
            Column::name('time_in_minutes')
                ->label('Tiempo')
                ->searchable()
                ->editable(),
            Column::name('format')
                ->label('Formato')
                ->searchable()
                ->editable()
        ];
    }
}
