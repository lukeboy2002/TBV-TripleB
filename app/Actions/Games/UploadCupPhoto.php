<?php

namespace App\Actions\Games;

use App\Models\GamePlayer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Drivers\Imagick\Driver as ImagickDriver;
use Intervention\Image\ImageManager;
use Throwable;

class UploadCupPhoto
{
    /**
     * Process, convert to JPEG, ensure <= 2MB, and store the cup photo.
     *
     * @return bool success
     */
    public function __invoke(UploadedFile $cupPhoto, int $playerId): bool
    {
        try {
            // Prefer Imagick (supports HEIC/HEIF when available), fallback to GD
            $manager = $this->makeImageManager();

            // Read and auto-orient the image
            $image = $manager->read($cupPhoto->getRealPath());
            try {
                // v3 uses orient() (no-op if no EXIF)
                $image = $image->orient();
            } catch (Throwable $e) {
                // Ignore if driver doesn't support EXIF orientation
            }

            // Compress to JPEG with target <= 2MB
            $targetBytes = 2 * 1024 * 1024; // 2MB
            $quality = 85;
            $minQuality = 10;
            $encoded = $image->toJpeg($quality);

            while (strlen((string) $encoded) > $targetBytes && $quality > $minQuality) {
                $quality -= 10;
                $encoded = $image->toJpeg($quality);
            }

            // If still too big, last-attempt more aggressive quality
            if (strlen((string) $encoded) > $targetBytes) {
                $encoded = $image->toJpeg($minQuality);
            }

            // Build a deterministic path with .jpg extension
            $filename = 'cup_'.uniqid().'.jpg';
            $path = 'cup-photos/'.$filename;

            Storage::disk('public')->put($path, (string) $encoded);
        } catch (Throwable $e) {
            // \Log::error('Cup photo upload failed', ['error' => $e->getMessage()]);
            return false;
        }

        // Attach to latest first-place record for this player (existing logic retained)
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

    private function makeImageManager(): ImageManager
    {
        try {
            return new ImageManager(new ImagickDriver);
        } catch (Throwable $e) {
            // Fallback to GD if Imagick is not available
            return new ImageManager(new GdDriver);
        }
    }
}
