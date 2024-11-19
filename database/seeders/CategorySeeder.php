<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $picsum = 'https://picsum.photos/seed';
        $categories = [
            ['name' => 'Electronics', 'image' => $picsum . '/electronics/200/300'],
            ['name' => 'Clothing', 'image' => $picsum . '/clothing/200/300'],
            ['name' => 'Books', 'image' => $picsum . '/books/200/300'],
            ['name' => 'Home Appliances', 'image' => $picsum . '/home-appliances/200/300'],
            ['name' => 'Sports Equipment', 'image' => $picsum . '/sports-equipment/200/300'],
            ['name' => 'Beauty Products', 'image' => $picsum . '/beauty-products/200/300'],
            ['name' => 'Toys and Games', 'image' => $picsum . '/toys-games/200/300'],
            ['name' => 'Furniture', 'image' => $picsum . '/furniture/200/300'],
            ['name' => 'Automotive', 'image' => $picsum . '/automotive/200/300'],
            ['name' => 'Jewelry', 'image' => $picsum . '/jewelry/200/300'],
            ['name' => 'Musical Instruments', 'image' => $picsum . '/musical-instruments/200/300'],
            ['name' => 'Groceries', 'image' => $picsum . '/groceries/200/300'],
            ['name' => 'Office Supplies', 'image' => $picsum . '/office-supplies/200/300'],
            ['name' => 'Garden and Outdoor', 'image' => $picsum . '/garden-outdoor/200/300'],
            ['name' => 'Pet Supplies', 'image' => $picsum . '/pet-supplies/200/300'],
            ['name' => 'Health and Wellness', 'image' => $picsum . '/health-wellness/200/300'],
            ['name' => 'Tools and Hardware', 'image' => $picsum . '/tools-hardware/200/300'],
            ['name' => 'Baby Products', 'image' => $picsum . '/baby-products/200/300'],
            ['name' => 'Arts and Crafts', 'image' => $picsum . '/arts-crafts/200/300'],
            ['name' => 'Travel Accessories', 'image' => $picsum . '/travel-accessories/200/300'],
            ['name' => 'Party Supplies', 'image' => $picsum . '/party-supplies/200/300'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'image' => $category['image'],
            ]);
        }
    }
}
