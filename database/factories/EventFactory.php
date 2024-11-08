<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word,
            'slug' => fake()->unique()->slug,
            'description' => fake()->sentence,
            'body' => Collection::times(4, fn () => fake()->realText(1250))->join(PHP_EOL.PHP_EOL),
            'date' => fake()->date,
            'location' => fake()->city,
            'city' => fake()->streetName,
            'image' => fake()->imageUrl(),
        ];
    }
}
