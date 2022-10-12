<?php

namespace App\Http\Livewire;

use App\Models\Student;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

class StudentTable extends LivewireDatatable {
	public $now;
	public $exportable = true;
	public $hideable = 'select';

	public function builder() {
		return Student::query()
			->leftjoin('users', 'students.user_id', 'users.id')
			->leftjoin('trainings', 'trainings.id', 'students.training_id')
			->leftjoin('users_alliances_pivot','students.user_id','users_alliances_pivot.user_id')
			->leftjoin('alliances','users_alliances_pivot.alliance_id','alliances.id')
			->orderby('start_day', 'desc');
	}

	public function columns() {
		return [

			Column::name('users.rut')
				->link('/adminstudents/{{users.rut}}', '{{users.rut}}')
				->label('Rut')
				->filterable(),
			Column::name('users.name')
				->label('Nombre')
				->defaultSort('desc')
				->filterable()
				->editable(),
			Column::name('users.lastnames')
				->label('Apellido')
				->filterable()
				->editable(),
			Column::name('alliances.name')
				->label('Alianza')
				->filterable(),
			Column::raw('CONCAT(trainings.name," ",trainings.format) AS Plan')
				->label('Plan de Entrenamiento')
				->filterable(),
			NumberColumn::name('trainings.class')
                ->label('Clases por semana')
                ->filterable(),
			DateColumn::name('start_day')
				->label('Fecha de Inicio del Plan')
				->filterable()
				->sortBy('start_day','desc'),
			DateColumn::raw("DATE_ADD(start_day, INTERVAL days day)")
				->label('Fecha de Termino del Plan')
				->filterable()
				->sortBy('start_day','desc'),
			NumberColumn::callback(['trainings.price'], function ($price) {
                return Helper::moneda_chilena($price);
            })->label('Valor')->filterable(),
            NumberColumn::name('alliances.desc')
                ->label('Descuento')
                ->filterable(),
            NumberColumn::callback(['trainings.price', 'alliances.desc'], function ($price, $desc) {
            	if($desc == ''){
            		return Helper::moneda_chilena($price);
            	}
                $price = $price*((100-($desc))/100);
                return Helper::moneda_chilena($price);
            })->label('Valor')->filterable(),
			BooleanColumn::name('students.settled')
				->label('Pagado')
				->filterable(),
				// ->editable(),
			Column::callback(['users.gender'], function ($gender) {
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
			Column::name('users.phone')
				->label('Celular')
				->filterable()
				->editable(),
			$this->deleteView(),
		];
	}

	public function getTrainingProperty() {
		return Training::all()->map(function ($training) {
			return $training->planComplete();
		});
	}


	public function edited($value, $key, $column, $rowId) {
		$user = Student::find($rowId)->User;
		$user->$column = $value;
		$request = new Request($user->toArray());
		$request->validate([
			'name' => ['required', 'string', 'max:255'],
			'lastnames' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'gender' => ['required', 'string', 'min:1', 'max:1', 'in:m,f,n'],
			'rut' => ['required', 'string', 'unique:users,id,' . $user->id],
			// 'rut' => ['required', 'string', 'cl_rut'],
			'phone' => ['required', 'string', 'max:255'],
			'birthday' => ['required', 'date', 'before:tomorrow', 'after:1900-01-91'],
		]);
		$user->save();
		// ddd($request);
	}

	public function deleteView($name = 'id') {
		return Column::callback($name, function ($value) {
			$fullname = Student::find($value)->user->fullName()." ".Student::find($value)->trainingPlan();
			return view('datatables::delete', ['value' => $value, 'fullname' => $fullname]);
		});
	}
}
