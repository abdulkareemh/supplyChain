<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 6; $i++) {
            Supplier::create([
                'name' => $faker->company,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Replace with a suitable default password
                'commercial_register_number' => $faker->randomNumber(8),
                'phone' => $faker->phoneNumber,
                'commercial_register_image' => $faker->imageUrl(), // Placeholder image URL
                'company_image' => $faker->imageUrl(), // Placeholder image URL
                'category' => $faker->randomElement(['Electronics', 'Books', 'Clothing', 'Home & Garden', 'Toys & Games']) // Example categories
            ]);
        }
    }
}
