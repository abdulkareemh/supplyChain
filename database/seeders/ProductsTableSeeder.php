<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 100; $i++) {
            Product::create([
                'name' => $faker->word,
                'description' => $faker->paragraph,
                'quantity' => $faker->randomDigitNotNull,
                'category_id' => $faker->numberBetween(1, 5), // Assuming you have 5 categories
                'supplier_id' => $faker->numberBetween(1, 5), // Assuming you have 5 suppliers
                'price' => $faker->numberBetween(100, 1000)
            ]);
        }
    }
}
