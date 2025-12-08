<?php

namespace App\Actions\Games;

use App\Models\GamePlayer;
use App\Support\ImageCompressor;
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
            // Compress to <= 500KB
            $absolute = storage_path('app/public/'.$path);
            ImageCompressor::compressToMaxBytes($absolute, 512_000);
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
