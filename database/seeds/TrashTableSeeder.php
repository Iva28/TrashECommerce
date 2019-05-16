<?php

use Illuminate\Database\Seeder;
use App\Trash;

class TrashTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 5; $i++) {
            Trash::create([
                'user_id' => 1,
                'city' => 'Baku',
                'lat' => $faker->latitude,
                'lng' => $faker->longitude,
                'coins' => 100
            ]);
        }
    }
}
