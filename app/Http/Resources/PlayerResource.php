<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Een speler zoals andere spelers hem zien: geen e-mail, telefoon of andere privégegevens.
 *
 * @mixin \App\Models\User
 */
class PlayerResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'avatar_url' => $this->avatarUrl(),
            // Alleen aanwezig als de query de statistieken heeft meegeladen (zie PlayerController).
            'stats' => $this->when(isset($this->total_games_played), fn () => [
                'played' => (int) $this->total_games_played,
                'points' => (int) $this->total_points,
                'average' => round((float) $this->average_points, 2),
                'won' => (int) $this->total_games_won,
                'cups' => (int) $this->total_cups_won,
            ]),
        ];
    }

    private function avatarUrl(): string
    {
        $path = $this->relationLoaded('profile') ? $this->profile?->image_path : null;

        return $path ? asset('storage/'.$path) : $this->profile_photo_url;
    }
}
