<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<Album>
 */
class AlbumFactory extends Factory
{
    private array $images = [
        'albums/album-1.jpg',
        'albums/album-2.jpg',
        'albums/album-3.jpg',
        'albums/album-4.jpg',
        'albums/album-5.jpg',
        'albums/album-6.jpg',
        'albums/album-7.jpg',
        'albums/album-8.jpg',
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
            'name' => Str::limit(
                str(fake()->sentence(5))->beforeLast('.')->title(),
                35 // maximaal 30 tekens
            ),
            'slug' => fake()->slug(),
            'image' => fake()->randomElement($this->images),
        ];
    }
}
