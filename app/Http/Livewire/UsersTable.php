<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\LabelColumn;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UsersTable extends LivewireDatatable
{
    public $exportable = true;
    public $hideable = 'select';
    public function builder()
    {
        return User::query()
        ->leftjoin('students', 'users.id', 'students.user_id')
        ->leftjoin('trainings', 'trainings.id', 'students.training_id');
    }

    public function columns()
    {
        return [
            Column::name('rut')
                ->label('Rut')
                ->searchable()
                ->editable(),
            Column::name('name')
                ->label('Nombre')
                ->searchable()
                ->editable(),
            Column::name('lastnames')
                ->label('Apellido')
                ->searchable()
                ->editable(),
            Column::name('email')
                ->label('Email')
                ->searchable()
                ->editable(),
            BooleanColumn::name('students.id')
            ->label('Entrenamiento'),
           Column::raw('CONCAT(trainings.name," ",trainings.format," ",trainings.class) AS Plan')
                ->label('Plan de Entrenamiento')
                ->searchable(),
            Column::callback('gender','getGender')
                ->label('Genero')
                ->searchable(),
            Column::name('phone')
                ->label('Celular')
                ->editable(),
            Column::name('address')
                ->label('Dirección')
                ->editable()
                ->searchable(),
            DateColumn::raw('birthday')
                ->label('Fecha de Nacimiento')
                ->format('d-M-Y')
                ->searchable()

        ];
    }

    public function getGender($gender)
    {
        $genders = [
            'm' => 'Masculino',
            'f' => 'Femenino',
            'n' => 'No Especifica'
        ];
        return $genders[$gender];
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
            // 'rut' => ['required', 'string', 'unique:users'],
            'rut' => ['required', 'string', 'cl_rut'],
            'phone' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date']
        ]);
        $user->save();
        // ddd($request);

    }
}
