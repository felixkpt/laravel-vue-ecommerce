<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        DB::table('posts')->truncate();
        $title = $this->faker->sentence(7);
        $slug = Str::slug($title);
        return [
            'title' => $title,
            'slug' => $slug,
            'user_id' => 1,
            'content' => $this->faker->paragraph(10)
        ];
    }
    protected $model = Post::class;
}
