<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            Order::create([
                'client_id' => $faker->numberBetween(1, 10), // Assuming you have 10 clients
                'total' => $faker->numberBetween(1000, 5000),
                'Expected_delivery_date' => $faker->date(),
                'status' => $faker->randomElement(['pending', 'accept', 'cancel'])
            ]);
        }
    }
}
