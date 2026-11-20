<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\GamePlayer
 */
class GamePlayerResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'player' => new PlayerResource($this->whenLoaded('user')),
            // position: 1 = als eerste afgevallen (beker), hoogste = winnaar. null = zit nog in het spel.
            'position' => $this->position,
            'points' => $this->points,
            'is_winner' => (bool) $this->is_winner,
            'has_cup' => $this->position === 1,
            'cup_photo_url' => $this->cup_photo_path ? asset('storage/'.$this->cup_photo_path) : null,
        ];
    }
}
