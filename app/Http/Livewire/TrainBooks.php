<?php

namespace App\Http\Livewire;

use App\Models\TrainBook;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\LabelColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;


class TrainBooks extends LivewireDatatable
{
    public $exportable = true;
    public $hideable = 'select';

    public function builder() {
        return TrainBook::query()
            ->join('users', 'train_books.user_id', 'users.id')
            ->join('train_appointments', 'train_books.train_appointment_id', 'train_appointments.id')
            ->where('date', '>', Carbon::yesterday());
    }

    public function columns()
    {
        return [
            Column::name('users.name')
                ->label('Nombre'),
            Column::name('users.lastnames')
                ->label('Apellido'),
            Column::name('train_appointments.name')
                ->label('Clase'),
            Column::name('train_appointments.date')
                ->label('Día'),
            Column::name('train_appointments.hour')
                ->label('Hora'),
            Column::name('users.phone')
                ->label('Telefono'),
            Column::name('users.email')
                ->label('Mail'),
        ];
    }
}
