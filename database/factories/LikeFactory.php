<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Like>
 */
class LikeFactory extends Factory
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
            'likeable_type' => $this->likeableType(...),
            'likeable_id' => Post::factory(),
        ];
    }

    protected function likeableType(array $values)
    {
        $type = $values['likeable_id'];
        $modelName = $type instanceof Factory
            ? $type->modelName()
            : $type::class;

        return (new $modelName)->getMorphClass();
    }
}
