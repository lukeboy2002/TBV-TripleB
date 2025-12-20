<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * available images
     */
    private array $images = [
        'agendas/agenda-1.jpg',
        'agendas/agenda-2.jpg',
        'agendas/agenda-3.jpg',
        'agendas/agenda-4.jpg',
        'agendas/agenda-5.jpg',
        'agendas/agenda-6.jpg',
        'agendas/agenda-7.jpg',
        'agendas/agenda-8.jpg',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->word(),
            'slug' => $this->faker->unique()->slug(),
            'description' => $this->faker->sentence(),
            'body' => Collection::times(4, fn () => fake()->realText(1250))->join(PHP_EOL.PHP_EOL),
            'date' => $this->faker->dateTimeBetween('2 day', '+2 week'),
            'end_date' => $this->faker->dateTimeBetween('+1 Week', '+3 Week'),
            'image_path' => $this->faker->randomElement($this->images),
            'private' => true,
        ];
    }
}
