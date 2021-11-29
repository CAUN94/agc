<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\TrainAppointment;
use App\Models\Training;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        User::create([
                'name' => 'Cristobal',
                'lastnames' => 'Ugarte',
                'email' => 'cristobal@ugarte.cl',
                'rut' => '18783405-7',
                'gender' => 'm',
                'phone' => '76693894',
                'birthday' => '1994-11-17',
                'password' => '!password'
            ]
        );

        User::create([
                'name' => 'Jon',
                'lastnames' => 'Doe',
                'email' => 'cristobal@ugarte.cl',
                'rut' => '18783405-6',
                'gender' => 'm',
                'phone' => '76693894',
                'birthday' => '1991-09-27',
                'password' => '!password'
            ]
        );
        User::create([
                'name' => 'Cata',
                'lastnames' => 'Coach',
                'email' => $this->faker->email,
                'rut' => '18783405-1',
                'gender' => 'm',
                'phone' => '76693894',
                'birthday' => '1994-08-17',
                'password' => '!password'
            ]
        );
        User::create([
                'name' => 'Profe',
                'lastnames' => 'Guzman',
                'email' => $this->faker->email,
                'rut' => '18783405-2',
                'gender' => 'm',
                'phone' => '76693894',
                'birthday' => '1994-10-17',
                'password' => '!password'
            ]
        );
        Training::create([
                'name' => 'Personalizado',
                'class' => '2',
                'time_in_minutes' => '55',
                'type' => 'group',
                'format' => 'Online',
                'price' => '40000',
                'description' => $this->faker->sentence(8)
            ]
        );
        Training::create([
                'name' => 'Personalizado',
                'class' => '11',
                'time_in_minutes' => '55',
                'type' => 'alone',
                'format' => 'Online',
                'price' => '72000',
                'description' => $this->faker->sentence(8)
            ]
        );
        Training::create([
                'name' => 'PF',
                'class' => '12',
                'time_in_minutes' => '55',
                'type' => 'alone',
                'format' => 'Online',
                'price' => '120000',
                'description' => $this->faker->sentence(8)
            ]
        );
        Training::create([
                'name' => 'Personalizado',
                'class' => '11',
                'time_in_minutes' => '55',
                'type' => 'duo',
                'format' => 'Online',
                'price' => '120000',
                'description' => $this->faker->sentence(8)
            ]
        );
        Training::create([
                'name' => 'Bienvenidos al Entrenamiento',
                'class' => '12',
                'time_in_minutes' => '55',
                'type' => 'group',
                'format' => 'Presencial',
                'price' => '12000',
                'description' => $this->faker->sentence(8)
            ]
        );

        Student::create([
                'user_id' => 1,
                'training_id' => 1,
                'settled' => 1,
                'start_day' => '2021-11-10'
        ]);

        for ($i=0; $i < 220; $i++) {
                TrainAppointment::create([
                        'date' =>  $this->faker->dateTimeBetween('-90 days', '+90 days'),
                        'hour' => $this->faker->time($format = 'H:i', $max = '18:00'),
                        'name' => $this->faker->sentence(1),
                        'places' => $this->faker->numberBetween($min = 5, $max = 10),
                        'training_id' => Training::all()->random(1)->first()->id,
                        'trainer_id' => User::find($this->faker->numberBetween($min = 3, $max = 4))->id,
                        'description' => $this->faker->sentence(8)

                ]);
        }

    }
}
