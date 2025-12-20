<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventAttendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EventAttendance>
 */
class EventAttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::factory(),
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['attending', 'not_attending', 'maybe']),
        ];
    }
}
