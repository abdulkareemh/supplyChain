<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryNames = ['Electronics', 'Books', 'Clothing', 'Home & Garden', 'Toys & Games']; // Example categories

        foreach ($categoryNames as $name) {
            DB::table('categories')->insert([
                'name' => $name
            ]);
        }
    }
}
