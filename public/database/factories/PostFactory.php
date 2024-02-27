<?php

namespace public\database\factories;

use App\Models\User;
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
    public function definition(): array
    {
        $title = fake()->realText(50);
        return [
            'user_id' => User::all()->random()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => fake()->imageUrl,
            'body' => fake()->realText(5000),
            'featured' => $this->faker->boolean(20),
            'published_at' => $this->faker->dateTimeBetween('-1 Week', '+1 week'),
        ];
    }
}
