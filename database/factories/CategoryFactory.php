<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'slug' => fake()->unique()->slug,
            'description' => fake()->sentence,
            'color' => fake()->randomElement(['blue', 'gray', 'red', 'green', 'yellow', 'indigo', 'purple', 'pink']),
        ];
    }
}
