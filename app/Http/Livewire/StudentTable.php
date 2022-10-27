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
use Illuminate\Support\Facades\Schema;

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
				// ->link('/adminstudents/{{users.rut}}', '{{users.rut}}')
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
			DateColumn::name('start_day as sd')
				->label('Fecha de Inicio del Plan')
				->filterable()
				->sortBy('start_day','desc'),
			Column::name('start_day')
				->label('Inicio Editable')
				->editable(),
			DateColumn::name('end_day as ed')
				->label('Fecha de Termino del Plan')
				->filterable(),
			Column::name('end_day')
				->label('Termino Editable')
				->editable(),
            NumberColumn::name('alliances.desc')
                ->label('Descuento')
                ->filterable()
                ->editable(),
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
			Column::name('students.text')
				->label('Comentario')
				->filterable()
				->editable(),
			$this->actionView(),
		];
	}

	public function getTrainingProperty() {
		return Training::all()->map(function ($training) {
			return $training->planComplete();
		});
	}


	public function edited($value, $key, $column, $rowId) {
		if(Schema::hasColumn('users', $column)){
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
		}
		if(Schema::hasColumn('students', $column)){
			$student = Student::find($rowId);
			$student->$column = $value;
			$student->save();
		}
		// $user = Student::find($rowId)->User;
		// if(is_null($user)){

		// }
		// $user->$column = $value;
		// $request = new Request($user->toArray());
		// $request->validate([
		// 	'name' => ['required', 'string', 'max:255'],
		// 	'lastnames' => ['required', 'string', 'max:255'],
		// 	'email' => ['required', 'string', 'email', 'max:255'],
		// 	'gender' => ['required', 'string', 'min:1', 'max:1', 'in:m,f,n'],
		// 	'rut' => ['required', 'string', 'unique:users,id,' . $user->id],
		// 	// 'rut' => ['required', 'string', 'cl_rut'],
		// 	'phone' => ['required', 'string', 'max:255'],
		// 	'birthday' => ['required', 'date', 'before:tomorrow', 'after:1900-01-91'],
		// ]);
		// $user->save();
		// ddd($request);
	}

	public function actionView($name = 'id') {
		return Column::callback($name, function ($value) {
			$fullname = Student::find($value)->user->fullName()." ".Student::find($value)->trainingPlan();
			return view('datatables::actions', ['value' => $value, 'fullname' => $fullname]);
		});
	}
}
