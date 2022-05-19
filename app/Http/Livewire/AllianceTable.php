<?php

namespace App\Http\Livewire;

use App\Models\Alliance;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class AllianceTable extends LivewireDatatable
{
    public $exportable = true;
    public $hideable = 'select';

    public function builder()
    {
        return Alliance::query();
    }

    public function columns()
    {
        return [
            Column::name('name')
            ->label('Nombre')
            ->filterable(),
            NumberColumn::name('desc')
            ->label('Dscto')
            ->filterable()
            ->editable(),
        ];
    }
}
