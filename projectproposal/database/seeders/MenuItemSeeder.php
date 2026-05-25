<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        MenuItem::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        MenuItem::insert([
            ['name' => 'Chicken Adobo', 'description' => 'Classic Filipino adobo with rice', 'price' => 95, 'category_id' => 1, 'image' => 'https://picsum.photos/id/1015/400/250', 'available' => true],
            ['name' => 'Beef Tapa', 'description' => 'Marinated beef tapa with egg', 'price' => 110, 'category_id' => 1, 'image' => 'https://picsum.photos/id/201/400/250', 'available' => true],
            ['name' => 'Cheeseburger', 'description' => 'Juicy beef burger with fries', 'price' => 75, 'category_id' => 2, 'image' => 'https://picsum.photos/id/301/400/250', 'available' => true],
            ['name' => 'French Fries', 'description' => 'Crispy golden fries', 'price' => 55, 'category_id' => 2, 'image' => 'https://picsum.photos/id/401/400/250', 'available' => true],
            ['name' => 'Iced Coffee', 'description' => 'Cold brew coffee with milk', 'price' => 45, 'category_id' => 3, 'image' => 'https://picsum.photos/id/501/400/250', 'available' => true],
            ['name' => 'Halo-Halo', 'description' => 'Classic Filipino dessert', 'price' => 65, 'category_id' => 3, 'image' => 'https://picsum.photos/id/601/400/250', 'available' => true],
        ]);

        echo "✅ Menu items seeded successfully!\n";
    }
}