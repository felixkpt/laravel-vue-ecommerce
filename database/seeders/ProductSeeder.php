<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        // Define stock statuses
        $stockStatuses = ['in_stock', 'out_of_stock'];

        // Define categories
        $categories = Category::all()->toArray();

        foreach ($categories as $category) {
            for ($i = 0; $i < 10; $i++) {
                $name = ucfirst($faker->words(10, true));
                $categoryName = $category['name'];

                // Generate image based on category slug or name
                $image = 'https://picsum.photos/seed/' . Str::slug($categoryName) . '/' . rand(300, 300) . '/' . rand(300, 300);

                Product::updateOrCreate(
                    [
                        'name' => $name,
                    ],
                    [
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'short_description' => $faker->sentence,
                    'description' => implode("\n\n", $faker->paragraphs(rand(15, 50))),
                    'regular_price' => $faker->randomFloat(2, 10, 5000),
                    'sale_price' => $faker->optional(0.7)->randomFloat(2, 5, 4000),
                    'SKU' => strtoupper($faker->bothify('??###')),
                    'stock_status' => $faker->randomElement($stockStatuses),
                    'sale_quantity' => $faker->numberBetween(1, 200),
                    'image' => $image,
                    'category_id' => $category['id'],
                ]);
            }
        }
    }
}
