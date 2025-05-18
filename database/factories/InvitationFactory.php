<?php

namespace Database\Factories;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Invitation>
 */
class InvitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->safeEmail(),
            'invited_by' => User::factory(),
            'invited_date' => fake()->dateTimeBetween('-2 Week', '-1 day'),
            'invitation_token' => fake()->numerify(),
            'registered_at' => fake()->dateTimeBetween('-1 Week', '-1 day'),
        ];
    }
}
