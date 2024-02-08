<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 100; $i++) {
            Price::create([
                'min' => $faker->randomDigitNotNull,
                'price' => $faker->numberBetween(100, 1000),
                'product_id' => $faker->numberBetween(1, 100) // Assuming you have 100 products
            ]);
        }
    }
}
