<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends Factory<Post>
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
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => str(fake()->sentence)->beforeLast('.')->title(),
            'slug' => str(fake()->unique()->slug)->slug(),
            'body' => Collection::times(4, fn () => fake()->realText(1250))->join(PHP_EOL.PHP_EOL),
            'image' => fake()->imageUrl(),
            'featured' => fake()->boolean,
            'published_at' => fake()->dateTimeBetween('-1 Week', '+1 week'),
        ];
    }
}
