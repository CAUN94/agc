<?php

namespace App\Http\Livewire;

use App\Models\Professional;
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

class ProfessionalsTable extends LivewireDatatable
{
    public $exportable = true;
    public $hideable = 'select';

    public function builder()
    {
        return Professional::query()
            ->join('users', 'users.id', 'professionals.user_id');
    }

    public function columns()
    {
        return [

            Column::name('users.rut')
                ->link('/adminprofessionals/{{professionals.id}}/edit', '{{users.rut}}')
                ->label('Rut')
                ->filterable(),
            Column::name('users.name')
                ->label('Nombre')
                ->filterable()
                ->editable(),
            Column::name('users.lastnames')
                ->label('Apellido')
                ->filterable()
                ->editable(),
            Column::name('users.email')
                ->label('Email')
                ->filterable()
                ->editable(),
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

    public function edited($value, $key,  $column ,$rowId ){
        $user = Professional::find($rowId)->user;
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
