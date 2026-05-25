<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Clear without causing foreign key error
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Category::create(['name' => 'Meals']);
        Category::create(['name' => 'Snacks']);
        Category::create(['name' => 'Drinks']);

        echo "✅ Categories seeded successfully!\n";
    }
}