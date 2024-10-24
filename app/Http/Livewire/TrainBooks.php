<?php

namespace App\Http\Livewire;

use App\Models\TrainAppointment;
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
            ->join('train_appointments', 'train_books.train_appointment_id', 'train_appointments.id');
    }

    public function columns()
    {
        return [
            Column::name('users.name')
                ->label('Nombre')
                ->filterable(),
            Column::name('users.lastnames')
                ->label('Apellido')
                ->filterable(),
            $this->actionView(),
            BooleanColumn::name('train_books.status')
                ->label('Estado')
                ->filterable(),
            Column::name('train_appointments.name')
                ->label('Clase')
                ->filterable(),
            DateColumn::name('train_appointments.date')
                ->label('Día')
                ->filterable(),
            Column::name('train_appointments.hour')
                ->label('Hora')
                ->filterable(),
            Column::callback(['train_appointments.id'], function ($id) {
                return TrainAppointment::find($id)->trainings()->planComplete();
            })->filterable(),
            Column::name('users.phone')
                ->label('Telefono')
                ->filterable(),
            Column::name('users.email')
                ->label('Mail')
                ->filterable(),
            
        ];
    }

    public function status($value){
		$trainBook = TrainBook::find($value);
		$trainBook->status = !$trainBook->status;
		$trainBook->save();
		$this->open = false;
		$open = false;
	}

    public function actionView($name = 'id') {
		return Column::callback($name, function ($value) {
            $fullname = TrainBook::find($value)->user->fullName();
			return view('datatables::confirmstudent', ['value' => $value, 'fullname' => $fullname]);
		});
	}
}
