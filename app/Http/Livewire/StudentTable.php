<?php

namespace App\Http\Livewire;

use App\Models\Student;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\LabelColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;


class StudentTable extends LivewireDatatable
{
    public $exportable = true;
    public $hideable = 'select';

    public function builder()
    {
        return Student::query()
            ->join('users', 'students.user_id', 'users.id')
            ->join('trainings', 'trainings.id', 'students.training_id')
            ->orderby('start_day','desc');
    }

    public function columns()
    {
        return [

            Column::name('users.rut')
                ->link('/adminstudents/{{students.id}}/edit', '{{users.rut}}')
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
            Column::raw('CONCAT(trainings.name," ",trainings.format," clases ",trainings.class) AS Plan')
                ->label('Plan de Entrenamiento')
                ->filterable(),
            DateColumn::name('start_day')
                ->label('Fecha de Inicio del Plan')
                ->filterable()
                ->editable(),
            BooleanColumn::name('students.settled')
            ->label('Pagado')
            ->filterable(),
            Column::callback(['users.gender'], function ($gender) {
                $genders = [
                    'm' => 'Masculino',
                    'f' => 'Femenino',
                    'n' => 'No Especifica'
                ];
                return $genders[$gender];
            })->label('Genero')
                ->filterable([
                    'm' => 'Masculino',
                    'f' => 'Femenino',
                    'n' => 'No Especifica'
                ]),
            Column::name('users.phone')
                ->label('Celular')
                ->filterable()
                ->editable(),
        ];
    }

    public function getTrainingProperty()
    {
        return Training::all()->map(function($training) {
            return $training->planComplete();
        });
    }

    public function edited($value, $key,  $column ,$rowId ){
        $user = User::find($rowId);
        $user->$column = $value;
        $request = new Request($user->toArray());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastnames' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'gender' => ['required', 'string', 'min:1' , 'max:1', 'in:m,f,n'],
            'rut' => ['required', 'string', 'unique:users,id,'.$user->id],
            // 'rut' => ['required', 'string', 'cl_rut'],
            'phone' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date']
        ]);
        $user->save();
        // ddd($request);

    }
}
