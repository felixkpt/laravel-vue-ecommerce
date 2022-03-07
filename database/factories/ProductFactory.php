<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductFactory extends Factory
{

    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        DB::table('products')->truncate();
        $name = ucfirst($this->faker->words($nb=4, $asText=true));
        $slug = Str::slug($name);

        $images = [];
        $uri = 'images/products/';
        for ($i=1;$i <= 22; $i++){
            $images[] = $uri.'digital_'.$i.'.jpg';
        }
        for ($i=1;$i <= 10; $i++){
        $images[] = $uri.'fashion_'.$i.'.jpg';
        }
        for ($i=1;$i <= 9; $i++){
            $images[] = $uri.'furniture_'.$i.'.jpg';
        }
        for ($i=1;$i <= 10; $i++){
            $images[] = $uri.'kidtoy_'.$i.'.jpg';
        }

        $reg = $this->faker->numberBetween(10, 500);
        $sal = $reg - $this->faker->numberBetween(5, 20);
        $sal = $sal >= 100 ? $sal : null;
        $cat = Category::where('id', '>', 0)->inRandomOrder()->first()->id;
        return [
            'name' => $name,
            'slug' => $slug,
            'short_description' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'regular_price' => $reg,
            'sale_price' => $sal,
            'SKU' => 'DIGI'.$this->faker->unique()->numberBetween(100, 500),
            'stock_status' => 'instock',
            'quantity' => $this->faker->numberBetween(100, 200),
            'image' => $this->faker->randomElement($images),
            'category_id' => $cat,
        ];
    }

}
