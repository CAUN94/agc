<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Professional;
use App\Models\Student;
use App\Models\TrainAppointment;
use App\Models\Trainer;
use App\Models\Training;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('trainings')->insert([
            'id' => 1,
            'name' => 'Grupal',
            'class' => 1,
            'time_in_minutes' => 60,
            'type' => 'group',
            'days' => 30,
            'period' => 'monthly',
            'format' => 'Presencial',
            'price' => 49990,
            'description' => 'Este plan consiste en clases de entrenamiento funcional en 6 horarios durante la semana. Las clases serán de manera presencial en las dependencias de You just better.',
        ]);

        DB::table('trainings')->insert([
            'id' => 2,
            'name' => 'Grupal',
            'class' => 3,
            'time_in_minutes' => 60,
            'type' => 'group',
            'days' => 90,
            'period' => 'monthly',
            'format' => 'Presencial',
            'price' => 134990,
            'description' => 'Este plan consiste en clases de entrenamiento funcional en 6 horarios durante la semana. Las clases serán de manera presencial en las dependencias de You just better.',
        ]);

        DB::table('trainings')->insert([
            'id' => 3,
            'name' => 'Grupal',
            'class' => 6,
            'time_in_minutes' => 60,
            'type' => 'group',
            'days' => 180,
            'period' => 'monthly',
            'format' => 'Presencial',
            'price' => 239990,
            'description' => 'Este plan consiste en clases de entrenamiento funcional en 6 horarios durante la semana. Las clases serán de manera presencial en las dependencias de You just better.',
        ]);

        DB::table('trainings')->insert([
            'id' => 4,
            'name' => 'Grupal',
            'class' => 12,
            'time_in_minutes' => 60,
            'type' => 'group',
            'days' => 360,
            'period' => 'monthly',
            'format' => 'Presencial',
            'price' => 419990,
            'description' => 'Este plan consiste en clases de entrenamiento funcional en 6 horarios durante la semana. Las clases serán de manera presencial en las dependencias de You just better.',
        ]);

        // DB::table('trainings')->insert([
        //     'name' => 'Grupal',
        //     'class' => 28,
        //     'time_in_minutes' => 60,
        //     'type' => 'group',
        //     'format' => 'Online',
        //     'price' => 40000,
        //     'description' => 'Este plan consiste en 7 horarios distribuídos a lo largo de la semana de 4 disciplinas distintas.
        //         En este plan tienes la libertad de entrar a todas las clases que quieras, manteniendo un precio mensual fijo.',
        // ]);

        DB::table('trainings')->insert([
            'id' => 5,
            'name' => 'Duplas',
            'class' => 4,
            'time_in_minutes' => 60,
            'type' => 'duo',
            'format' => 'Online',
            'price' => 119000,
            'description' => 'Este plan consiste en clases exclusivas para ti y tu partner,
                para motivarte a entrenar en base a un objetivo en conjunto a un precio conveniente.',
        ]);

        DB::table('trainings')->insert([
            'id' => 6,
            'name' => 'Duplas',
            'class' => 8,
            'time_in_minutes' => 60,
            'type' => 'duo',
            'format' => 'Online',
            'price' => 204000,
            'description' => 'Este plan consiste en clases exclusivas para ti y tu partner,
                para motivarte a entrenar en base a un objetivo en conjunto a un precio conveniente.',
        ]);

        DB::table('trainings')->insert([
            'id' => 7,
            'name' => 'Duplas',
            'class' => 4,
            'time_in_minutes' => 60,
            'type' => 'duo',
            'format' => 'Presencial',
            'price' => 149000,
            'description' => 'Este plan consiste en clases exclusivas para ti y tu partner,
                para motivarte a entrenar en base a un objetivo en conjunto a un precio conveniente.',
        ]);

        DB::table('trainings')->insert([
            'id' => 8,
            'name' => 'Duplas',
            'class' => 8,
            'time_in_minutes' => 60,
            'type' => 'duo',
            'format' => 'Presencial',
            'price' => 255000,
            'description' => 'Este plan consiste en clases exclusivas para ti y tu partner,
                para motivarte a entrenar en base a un objetivo en conjunto a un precio conveniente.',
        ]);

        DB::table('trainings')->insert([
            'id' => 9,
            'name' => 'Duplas',
            'class' => 12,
            'time_in_minutes' => 60,
            'type' => 'duo',
            'format' => 'Presencial',
            'price' => 340000,
            'description' => 'Este plan consiste en clases exclusivas para ti y tu partner,
                para motivarte a entrenar en base a un objetivo en conjunto a un precio conveniente.',
        ]);

        DB::table('trainings')->insert([
            'id' => 10,
            'name' => 'Personalizado',
            'class' => 4,
            'time_in_minutes' => 60,
            'type' => 'alone',
            'format' => 'Online',
            'price' => 77000,
            'description' => 'Este entrenamiento consiste en clases individuales,
                enfocado en tus objetivos personales y en tu capacidad física al 100%.',
        ]);

        DB::table('trainings')->insert([
            'id' => 11,
            'name' => 'Personalizado',
            'class' => 8,
            'time_in_minutes' => 60,
            'type' => 'alone',
            'format' => 'Online',
            'price' => 128000,
            'description' => 'Este entrenamiento consiste en clases individuales,
                enfocado en tus objetivos personales y en tu capacidad física al 100%.',
        ]);

        DB::table('trainings')->insert([
            'id' => 12,
            'name' => 'Personalizado',
            'class' => 4,
            'time_in_minutes' => 60,
            'type' => 'alone',
            'format' => 'Presencial',
            'price' => 96000,
            'description' => 'Este entrenamiento consiste en clases individuales,
                enfocado en tus objetivos personales y en tu capacidad física al 100%.',
        ]);

        DB::table('trainings')->insert([
            'id' => 13,
            'name' => 'Personalizado',
            'class' => 8,
            'time_in_minutes' => 60,
            'type' => 'alone',
            'format' => 'Presencial',
            'price' => 170000,
            'description' => 'Este entrenamiento consiste en clases individuales,
                enfocado en tus objetivos personales y en tu capacidad física al 100%.',
        ]);

        DB::table('trainings')->insert([
            'id' => 14,
            'name' => 'Personalizado',
            'class' => 12,
            'time_in_minutes' => 60,
            'type' => 'alone',
            'format' => 'Presencial',
            'price' => 213000,
            'description' => 'Este entrenamiento consiste en clases individuales,
                enfocado en tus objetivos personales y en tu capacidad física al 100%.',
        ]);

        DB::table('trainings')->insert([
            'id' => 15,
            'name' => 'PF Runners',
            'class' => 4,
            'time_in_minutes' => 60,
            'type' => 'group',
            'format' => 'Online',
            'price' => 19000,
            'description' => 'Si eres un corredor experimentado o estás recién iniciándote,
                estas clases de preparación física son ideales para ti.',
        ]);

        DB::table('trainings')->insert([
            'id' => 16,
            'name' => 'PF Runners',
            'class' => 8,
            'time_in_minutes' => 60,
            'type' => 'group',
            'format' => 'Online',
            'price' => 32000,
            'description' => 'Si eres un corredor experimentado o estás recién iniciándote,
                estas clases de preparación física son ideales para ti.',
        ]);

        DB::table('trainings')->insert([
            'id' => 17,
            'name' => 'Pauta de Entrenamiento',
            'class' => 1,
            'time_in_minutes' => 60,
            'type' => 'guideline',
            'days' => 30,
            'format' => 'Online',
            'price' => 35000,
            'extra' => 0,
            'description' => 'Este plan consiste en una pauta de entrenamiento personalizada.',
        ]);

        // for ($i = 0; $i < 20; $i++) {
        //     $u = User::factory()->create();
        //     if (rand(0, 1)) {
        //         Student::create([
        //             'user_id' => $u->id,
        //             'training_id' => Training::inRandomOrder()->first()->id,
        //             'settled' => rand(0, 1),
        //             'start_day' => '2021-12-09',
        //         ]);
        //     }
        //     if (rand(0, 1)) {
        //         Professional::create([
        //             'user_id' => $u->id,
        //             'description' => 'lorem ipsum dolor sit amet, consectetur',
        //         ]);
        //     }

        // }

        for ($week = 0; $week < 30; $week++) {
            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-03')->addweeks($week),
                'hour' => '07:30',
                'name' => 'Entrenamiento',
                'places' => 10,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 2,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 3,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 4,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 1,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-05')->addweeks($week),
                'hour' => '07:30',
                'name' => 'Entrenamiento',
                'places' => 10,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 2,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 3,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 4,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 1,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-07')->addweeks($week),
                'hour' => '07:30',
                'name' => 'Entrenamiento',
                'places' => 10,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 2,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 3,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 4,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 1,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-03')->addweeks($week),
                'hour' => '19:30',
                'name' => 'Entrenamiento',
                'places' => 10,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 2,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 3,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 4,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 1,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-05')->addweeks($week),
                'hour' => '19:30',
                'name' => 'Entrenamiento',
                'places' => 10,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 2,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 3,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 4,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 1,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-07')->addweeks($week),
                'hour' => '19:30',
                'name' => 'Entrenamiento',
                'places' => 10,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 2,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 3,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 4,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 1,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-03')->addweeks($week),
                'hour' => '18:30',
                'name' => 'Entrenamiento',
                'places' => 10,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 15,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 16,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-05')->addweeks($week),
                'hour' => '19:00',
                'name' => 'Entrenamiento',
                'places' => 10,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 15,
                'train_appointment_id' => $ta->id,
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 16,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-03')->addweeks($week),
                'hour' => '9:00',
                'name' => 'Marcia y Pia',
                'places' => 2,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 8,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-05')->addweeks($week),
                'hour' => '9:00',
                'name' => 'Marcia y Pia',
                'places' => 2,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 8,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-03')->addweeks($week),
                'hour' => '7:00',
                'name' => 'Sebastian Wilson',
                'places' => 1,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 14,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-05')->addweeks($week),
                'hour' => '7:00',
                'name' => 'Sebastian Wilson',
                'places' => 1,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 14,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-07')->addweeks($week),
                'hour' => '16:00',
                'name' => 'Sebastian Wilson',
                'places' => 1,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 14,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-06')->addweeks($week),
                'hour' => '16:00',
                'name' => 'Carlos Celis',
                'places' => 1,
                'trainer_id' => 4,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 12,
                'train_appointment_id' => $ta->id,
            ]);

             $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-04')->addweeks($week),
                'hour' => '16:00',
                'name' => 'Nicolas tobar',
                'places' => 1,
                'trainer_id' => 3,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 13,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-06')->addweeks($week),
                'hour' => '16:00',
                'name' => 'Nicolas tobar',
                'places' => 1,
                'trainer_id' => 3,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 13,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-05')->addweeks($week),
                'hour' => '11:00',
                'name' => 'Juan Pablo Sallato',
                'places' => 1,
                'trainer_id' => 3,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 12,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-04')->addweeks($week),
                'hour' => '20:00',
                'name' => 'Yohanna Valdivia',
                'places' => 1,
                'trainer_id' => 3,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 13,
                'train_appointment_id' => $ta->id,
            ]);

            $ta = TrainAppointment::create([
                'date' => \Carbon\Carbon::parse('2022-01-06')->addweeks($week),
                'hour' => '20:00',
                'name' => 'Yohanna Valdivia',
                'places' => 1,
                'trainer_id' => 3,
                'description' => 'No Disponible',
            ]);

            DB::table('train_appointments_pivot')->insert([
                'training_id' => 13,
                'train_appointment_id' => $ta->id,
            ]);


        }
    }
}
