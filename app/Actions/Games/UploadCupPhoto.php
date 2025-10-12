<?php

namespace App\Actions\Games;

use App\Models\GamePlayer;
use Illuminate\Http\UploadedFile;
use Throwable;

class UploadCupPhoto
{
    /**
     * @return bool success
     */
    public function __invoke(UploadedFile $cupPhoto, int $playerId): bool
    {
        try {
            $path = $cupPhoto->store('cup-photos', 'public');
        } catch (Throwable $e) {
            // \Log::error('Cup photo upload failed', ['error' => $e->getMessage()]);
            return false;
        }

        $gamePlayer = GamePlayer::where('user_id', $playerId)
            ->where('position', 1)
            ->latest()
            ->first();

        if ($gamePlayer) {
            $gamePlayer->update([
                'cup_photo_path' => $path,
            ]);
        }

        return true;
    }
}
