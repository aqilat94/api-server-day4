<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = \Faker\Factory::create('ms_MY');
        DB::table('phones')->insert([
            [
                'id' => 1,
                'uuid' => $this->faker->uuid,
                'brand' => 'Apple',
                'model' => 'Iphone X',
                'price' => 4000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'uuid' => $this->faker->uuid,
                'brand' => 'Samsung',
                'model' => 'Galaxy S10',
                'price' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'uuid' => $this->faker->uuid,
                'brand' => 'Oppo',
                'model' => 'F10',
                'price' => 2000,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ]);
    }
}
