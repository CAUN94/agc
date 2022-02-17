<?php

namespace Database\Seeders;

use App\Models\Professional;
use App\Models\Student;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
