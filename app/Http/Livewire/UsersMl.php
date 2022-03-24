<?php

namespace App\Http\Livewire;

use App\Models\UserMl;
use Illuminate\Http\Request;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UsersMl extends LivewireDatatable
{
    public $exportable = true;
    public $hideable = 'select';
    public $model = UserMl::class;
    public $complex = true;

    public function columns()
    {
        return [
            Column::name('Nombre')
                ->label('Nombre')
                ->filterable(),
            Column::name('Apellidos')
                ->label('Apellidos')
                ->filterable(),
            DateColumn::raw('Fecha_Ingreso')
                ->label('Fecha_Ingreso')
                ->filterable(),
            DateColumn::raw('Ultima_Cita')
                ->label('Ultima_Cita')
                ->filterable(),
            Column::name('RUT')
                ->label('RUT')
                ->filterable(),
            DateColumn::raw('Nacimiento')
                ->label('Nacimiento')
                ->filterable(),
            Column::name('Celular')
                ->label('Celular')
                ->filterable(),
            Column::name('Ciudad')
                ->label('Ciudad')
                ->filterable(),
            Column::name('Comuna')
                ->label('Comuna')
                ->filterable(),
            Column::name('Direccion')
                ->label('Direccion')
                ->filterable(),
            Column::name('Email')
                ->label('Email')
                ->filterable(),
            Column::name('Observaciones')
                ->label('Observaciones')
                ->filterable(),
            Column::name('Sexo')
                ->label('Sexo')
                ->filterable(),
            Column::name('Convenio')
                ->label('Convenio')
                ->filterable()
        ];
    }
}
