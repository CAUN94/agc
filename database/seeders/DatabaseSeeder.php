<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Professional;
use App\Models\Student;
use App\Models\TrainAppointment;
use App\Models\Trainer;
use App\Models\Training;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		$this->faker = Faker::create();
		User::create([
			'name' => 'Cristobal',
			'lastnames' => 'Ugarte',
			'email' => 'cristobal@ugarte.cl',
			'rut' => '18783405-7',
			'gender' => 'm',
			'phone' => '76693894',
			'birthday' => '1994-11-17',
			'password' => '!password',
		]
		);

		User::create([
			'name' => 'Jon',
			'lastnames' => 'Doe',
			'email' => 'css@ugarte.cl',
			'rut' => '18783405-6',
			'gender' => 'm',
			'phone' => '76693894',
			'birthday' => '1991-09-27',
			'password' => '!password',
		]
		);
		User::create([
			'name' => 'Catalina',
			'lastnames' => 'Hernandez',
			'email' => $this->faker->email,
			'rut' => '18783405-1',
			'gender' => 'f',
			'phone' => '76693894',
			'birthday' => '1994-08-17',
			'password' => '!password',
		]
		);
		User::create([
			'name' => 'Francisco',
			'lastnames' => 'Guzman',
			'email' => $this->faker->email,
			'rut' => '18783405-2',
			'gender' => 'm',
			'phone' => '76693894',
			'birthday' => '1994-10-17',
			'password' => '!password',
		]
		);

		User::create([
			'name' => 'Diego',
			'lastnames' => 'Teran',
			'email' => 'dhteran@miuandes.cl',
			'rut' => '20285263-7',
			'gender' => 'm',
			'phone' => '75166485',
			'birthday' => '1999-10-04',
			'password' => 'password',
		]
		);

		Professional::create([
			'user_id' => 1,
			'description' => 'lorem ipsum dolor sit amet, consectetur',
		]
		);

		Professional::create([
			'user_id' => 2,
			'description' => 'lorem ipsum dolor sit amet, consectetur',
		]
		);

		Professional::create([
			'user_id' => 3,
			'description' => 'lorem ipsum dolor sit amet, consectetur',
		]
		);

		Trainer::create([
			'user_id' => 3,
		]);

		Trainer::create([
			'user_id' => 4,
		]);

		Admin::create([
			'user_id' => 1,
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Grupal',
			'class' => 1,
			'time_in_minutes' => 60,
			'type' => 'group',
			'days' => 30,
			'period' => 'monthly',
			'format' => 'Presencial',
			'price' => 49990,
			'description' => 'Este plan consiste en clases con un mínimo de 4 personas, donde todas deben tener el mismo objetivo.
Las clases serán de manera presencial en las dependencias de You just better.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Grupal',
			'class' => 3,
			'time_in_minutes' => 60,
			'type' => 'group',
			'days' => 30,
			'period' => 'monthly',
			'format' => 'Presencial',
			'price' => 134990,
			'description' => 'Este plan consiste en clases con un mínimo de 4 personas, donde todas deben tener el mismo objetivo. Las clases serán de manera presencial en las dependencias de You just better.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Grupal',
			'class' => 6,
			'time_in_minutes' => 60,
			'type' => 'group',
			'days' => 30,
			'period' => 'monthly',
			'format' => 'Presencial',
			'price' => 239990,
			'description' => 'Este plan consiste en clases con un mínimo de 4 personas,
                donde todas deben tener el mismo objetivo. Las clases serán de manera presencial en las dependencias de You jur.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Grupal',
			'class' => 12,
			'time_in_minutes' => 60,
			'type' => 'group',
			'days' => 30,
			'period' => 'monthly',
			'format' => 'Presencial',
			'price' => 419990,
			'description' => 'Este plan consiste en clases con un mínimo de 4 personas,
                donde todas deben tener el mismo objetivo. Las clases serán de manera presencial en las dependencias de You jur.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Grupal',
			'class' => 28,
			'time_in_minutes' => 60,
			'type' => 'group',
			'format' => 'Online',
			'price' => 40000,
			'description' => 'Este plan consiste en 7 horarios distribuídos a lo largo de la semana de 4 disciplinas distintas.
                En este plan tienes la libertad de entrar a todas las clases que quieras, manteniendo un precio mensual fijo.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Duplas',
			'class' => 4,
			'time_in_minutes' => 60,
			'type' => 'duo',
			'format' => 'Online',
			'price' => 112000,
			'description' => 'Este plan consiste en clases exclusivas para ti y tu partner,
                para motivarte a entrenar en base a un objetivo en conjunto a un precio conveniente.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Duplas',
			'class' => 8,
			'time_in_minutes' => 60,
			'type' => 'duo',
			'format' => 'Online',
			'price' => 192000,
			'description' => 'Este plan consiste en clases exclusivas para ti y tu partner,
                para motivarte a entrenar en base a un objetivo en conjunto a un precio conveniente.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Duplas',
			'class' => 4,
			'time_in_minutes' => 60,
			'type' => 'duo',
			'format' => 'Presencial',
			'price' => 140000,
			'description' => 'Este plan consiste en clases exclusivas para ti y tu partner,
                para motivarte a entrenar en base a un objetivo en conjunto a un precio conveniente.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Duplas',
			'class' => 8,
			'time_in_minutes' => 60,
			'type' => 'duo',
			'format' => 'Presencial',
			'price' => 240000,
			'description' => 'Este plan consiste en clases exclusivas para ti y tu partner,
                para motivarte a entrenar en base a un objetivo en conjunto a un precio conveniente.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Duplas',
			'class' => 12,
			'time_in_minutes' => 60,
			'type' => 'duo',
			'format' => 'Presencial',
			'price' => 320000,
			'description' => 'Este plan consiste en clases exclusivas para ti y tu partner,
                para motivarte a entrenar en base a un objetivo en conjunto a un precio conveniente.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Personalizado',
			'class' => 4,
			'time_in_minutes' => 60,
			'type' => 'alone',
			'format' => 'Online',
			'price' => 72000,
			'description' => 'Este entrenamiento consiste en clases individuales,
                enfocado en tus objetivos personales y en tu capacidad física al 100%.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Personalizado',
			'class' => 8,
			'time_in_minutes' => 60,
			'type' => 'alone',
			'format' => 'Online',
			'price' => 120000,
			'description' => 'Este entrenamiento consiste en clases individuales,
                enfocado en tus objetivos personales y en tu capacidad física al 100%.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Personalizado',
			'class' => 4,
			'time_in_minutes' => 60,
			'type' => 'alone',
			'format' => 'Presencial',
			'price' => 90000,
			'description' => 'Este entrenamiento consiste en clases individuales,
                enfocado en tus objetivos personales y en tu capacidad física al 100%.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Personalizado',
			'class' => 8,
			'time_in_minutes' => 60,
			'type' => 'alone',
			'format' => 'Presencial',
			'price' => 160000,
			'description' => 'Este entrenamiento consiste en clases individuales,
                enfocado en tus objetivos personales y en tu capacidad física al 100%.',
		]);

		DB::table('trainings')->insert([
			'name' => 'Entrenamiento Personalizado',
			'class' => 12,
			'time_in_minutes' => 60,
			'type' => 'alone',
			'format' => 'Presencial',
			'price' => 210000,
			'description' => 'Este entrenamiento consiste en clases individuales,
                enfocado en tus objetivos personales y en tu capacidad física al 100%.',
		]);

		DB::table('trainings')->insert([
			'name' => 'PF Runners',
			'class' => 4,
			'time_in_minutes' => 60,
			'type' => 'group',
			'format' => 'Online',
			'price' => 18000,
			'description' => 'Si eres un corredor experimentado o estás recién iniciándote,
                estas clases de preparación física son ideales para ti.',
		]);

		DB::table('trainings')->insert([
			'name' => 'PF Runners',
			'class' => 8,
			'time_in_minutes' => 60,
			'type' => 'group',
			'format' => 'Online',
			'price' => 30000,
			'description' => 'Si eres un corredor experimentado o estás recién iniciándote,
                estas clases de preparación física son ideales para ti.',
		]);

		Student::create([
			'user_id' => 1,
			'training_id' => 4,
			'settled' => 1,
			'start_day' => '2021-12-09',
		]);

		for ($i = 0; $i < 20; $i++) {
			$u = User::factory()->create();
			if (rand(0, 1)) {
				Student::create([
					'user_id' => $u->id,
					'training_id' => Training::inRandomOrder()->first()->id,
					'settled' => rand(0, 1),
					'start_day' => '2021-12-09',
				]);
			}
			if (rand(0, 1)) {
				Professional::create([
					'user_id' => $u->id,
					'description' => 'lorem ipsum dolor sit amet, consectetur',
				]);
			}

		}

		for ($week = 0; $week < 30; $week++) {

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2022-01-01')->addweeks($week),
				'hour' => '07:30',
				'name' => 'HIIT/CORE',
				'places' => 100,
				'trainer_id' => 3,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 4,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2022-01-01')->addweeks($week),
				'hour' => '19:30',
				'name' => 'Funcional',
				'places' => 100,
				'trainer_id' => 4,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 4,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-14')->addweeks($week),
				'hour' => '19:00',
				'name' => 'Strong Nation',
				'places' => 100,
				'trainer_id' => 3,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 4,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-16')->addweeks($week),
				'hour' => '07:30',
				'name' => 'HIIT/CORE',
				'places' => 100,
				'trainer_id' => 3,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 4,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-16')->addweeks($week),
				'hour' => '19:00',
				'name' => 'Strong Nation',
				'places' => 100,
				'trainer_id' => 3,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 4,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-18')->addweeks($week),
				'hour' => '10:30',
				'name' => 'Fitdance',
				'places' => 100,
				'trainer_id' => 3,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 4,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-15')->addweeks($week),
				'hour' => '19:00',
				'name' => 'Funcional',
				'places' => 100,
				'trainer_id' => 3,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 4,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2022-01-01')->addweeks($week),
				'hour' => '18:30',
				'name' => 'Entrenamiento',
				'places' => 100,
				'trainer_id' => 3,
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
				'date' => \Carbon\Carbon::parse('2021-12-15')->addweeks($week),
				'hour' => '19:00',
				'name' => 'Entrenamiento',
				'places' => 100,
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
				'date' => \Carbon\Carbon::parse('2021-12-15')->addweeks($week),
				'hour' => '18:00',
				'name' => 'Entrenamiento',
				'places' => 100,
				'trainer_id' => 3,
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
				'date' => \Carbon\Carbon::parse('2022-01-01')->addweeks($week),
				'hour' => '07:00',
				'name' => 'Entrenamiento',
				'places' => 1,
				'trainer_id' => 4,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 14,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 13,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 12,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-14')->addweeks($week),
				'hour' => '07:00',
				'name' => 'Entrenamiento',
				'places' => 1,
				'trainer_id' => 4,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 14,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 13,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 12,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-14')->addweeks($week),
				'hour' => '18:00',
				'name' => 'Entrenamiento',
				'places' => 1,
				'trainer_id' => 3,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 14,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 13,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 12,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-14')->addweeks($week),
				'hour' => '20:00',
				'name' => 'Entrenamiento',
				'places' => 1,
				'trainer_id' => 3,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 14,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 13,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 12,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-15')->addweeks($week),
				'hour' => '07:00',
				'name' => 'Entrenamiento',
				'places' => 1,
				'trainer_id' => 4,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 14,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 13,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 12,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-16')->addweeks($week),
				'hour' => '18:00',
				'name' => 'Entrenamiento',
				'places' => 1,
				'trainer_id' => 3,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 14,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 13,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 12,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-16')->addweeks($week),
				'hour' => '19:30',
				'name' => 'Entrenamiento',
				'places' => 1,
				'trainer_id' => 4,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 14,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 13,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 12,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-16')->addweeks($week),
				'hour' => '20:00',
				'name' => 'Entrenamiento',
				'places' => 1,
				'trainer_id' => 3,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 14,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 13,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 12,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-17')->addweeks($week),
				'hour' => '07:00',
				'name' => 'Entrenamiento',
				'places' => 1,
				'trainer_id' => 4,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 14,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 13,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 12,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-17')->addweeks($week),
				'hour' => '16:00',
				'name' => 'Entrenamiento',
				'places' => 1,
				'trainer_id' => 4,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 14,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 13,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 12,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-14')->addweeks($week),
				'hour' => '08:30',
				'name' => 'Entrenamiento',
				'places' => 100,
				'trainer_id' => 4,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 1,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 2,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 3,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-16')->addweeks($week),
				'hour' => '07:00',
				'name' => 'Entrenamiento',
				'places' => 100,
				'trainer_id' => 4,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 1,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 2,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 3,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-16')->addweeks($week),
				'hour' => '08:30',
				'name' => 'Entrenamiento',
				'places' => 100,
				'trainer_id' => 4,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 1,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 2,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 3,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-16')->addweeks($week),
				'hour' => '08:30',
				'name' => 'Entrenamiento',
				'places' => 100,
				'trainer_id' => 4,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 5,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 6,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 7,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 8,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 9,
				'train_appointment_id' => $ta->id,
			]);

			$ta = TrainAppointment::create([
				'date' => \Carbon\Carbon::parse('2021-12-16')->addweeks($week),
				'hour' => '08:30',
				'name' => 'Entrenamiento',
				'places' => 100,
				'trainer_id' => 4,
				'description' => 'No Disponible',
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 10,
				'train_appointment_id' => $ta->id,
			]);

			DB::table('train_appointments_pivot')->insert([
				'training_id' => 11,
				'train_appointment_id' => $ta->id,
			]);

		}

	}
}
