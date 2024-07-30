<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
          'category_id' => rand(1, 5),
          'title' => fake()->title(),
          'slug' => fake()->title(),
          'content' => fake()->title(),
          'status' => rand(0, 1),
        ];
    }
}
