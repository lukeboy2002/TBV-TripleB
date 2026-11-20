<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Game
 */
class GameResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date?->toIso8601String(),
            'status' => $this->status,
            'completed_at' => $this->completed_at?->toIso8601String(),
            // Uitslag: winnaar bovenaan.
            'players' => GamePlayerResource::collection(
                $this->whenLoaded('gamePlayers', fn () => $this->gamePlayers->sortByDesc('position')->values())
            ),
        ];
    }
}
