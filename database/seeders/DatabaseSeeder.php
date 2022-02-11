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
			'name' => 'Matias',
			'lastnames' => 'Rebolledo',
			'email' => 'matias.rebolledo.n@gmail.com',
			'rut' => '19112484-7',
			'gender' => 'm',
			'phone' => '930312079',
			'birthday' => '1995-12-09',
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

		Trainer::create([
			'user_id' => 2,
		]);

		Trainer::create([
			'user_id' => 3,
		]);

		Trainer::create([
			'user_id' => 4,
		]);

		Admin::create([
			'user_id' => 1,
		]);

		DB::table('dymantic_instagram_basic_profiles')->insert([
            'id' => 1,
            'username' => 'yjb',
        ]);

        DB::table('dymantic_instagram_feed_tokens')->insert([
            'id' => 1,
            'profile_id' => 1,
            'access_code' => 'IGQVJYX2ZAOaWFidHN0aVJQd1dnYUFTTng3TGVlTWtjSmpwaWdQa1kyY09xYU84ejRqak4teHBjempOU3djN3FMeFVhanJHc1NZAY0Rra3RUajVuU2RBNVNRUkNVUWNQM2FNSjRwU3BB',
            'username' => 'you.justbetter',
            'user_id' => '5089264587798125',
            'user_fullname' => 'not available',
            'user_profile_picture' => 'not available'
        ]);
	}
}
