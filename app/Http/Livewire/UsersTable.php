<?php

namespace App\Http\Livewire;

use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UsersTable extends LivewireDatatable {
	public $exportable = true;
	public $hideable = 'select';

	public function builder() {
		return User::query()->distinct('users.id');
	}

	public function columns() {
		return [

			Column::name('rut')->link('/adminusers/{{users.id}}', '{{rut}}')
				->label('Rut')
				->filterable(),
			Column::name('name')
				->label('Nombre')
				->filterable()
				->editable(),
			Column::name('lastnames')
				->label('Apellido')
				->filterable()
				->editable(),
			Column::name('email')
				->label('Email')
				->filterable()
				->editable(),
			// Column::raw('GROUP_CONCAT(trainings.name SEPARATOR " | ") AS `Planes`'),
			// BooleanColumn::name('Student.user_id')
			// ->label('Entrenamiento')
			// ->filterable(),
			BooleanColumn::name('Student.user_id')
				->label('Estudiante')
				->filterable(),
			BooleanColumn::name('Professional.user_id')
				->label('Profesional')
				->filterable(),
			// BooleanColumn::name('Professional.id')
			// ->label('Profesional')
			// ->filterable(),

			Column::callback(['gender'], function ($gender) {
				$genders = [
					'm' => 'Masculino',
					'f' => 'Femenino',
					'n' => 'No Especifica',
				];
				return $genders[$gender];
			})->label('Genero')
				->filterable([
					'm' => 'Masculino',
					'f' => 'Femenino',
					'n' => 'No Especifica',
				]),
			Column::name('phone')
				->label('Celular')
				->filterable()
				->editable(),
			Column::name('address')
				->label('Dirección')
				->filterable()
				->editable(),
			DateColumn::raw('birthday')
				->label('Fecha de Nacimiento')
				->format('d-M-Y'),
			$this->deleteView(),

		];
	}

	public function getGender($gender) {
		$genders = [
			'm' => 'Masculino',
			'f' => 'Femenino',
			'n' => 'No Especifica',
		];
		return $genders[$gender];
	}

	public function getTrainingProperty() {
		return Training::all()->map(function ($training) {
			return $training->planComplete();
		});
	}

	public function edited($value, $key, $column, $rowId) {
		$user = User::find($rowId);
		$user->$column = $value;
		$request = new Request($user->toArray());
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'lastnames' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'gender' => ['required', 'string', 'min:1', 'max:1', 'in:m,f,n'],
			// 'rut' => ['required', 'string', 'unique:users'],
			'rut' => ['required', 'string', 'cl_rut'],
			'phone' => ['required', 'string', 'max:255'],
			'birthday' => ['required', 'date', 'before:tomorrow', 'after:1900-01-91'],
		]);
		$user->save();
		// ddd($request);

	}

	public function delete($value) {
		ddd($this);
	}

	public function deleteView($name = 'id') {
		return Column::callback($name, function ($value) {
			$fullname = User::find($value)->fullName();
			return view('datatables::delete', ['value' => $value, 'fullname' => $fullname]);
		});
	}

}
