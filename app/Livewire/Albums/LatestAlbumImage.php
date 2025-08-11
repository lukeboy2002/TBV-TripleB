<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LatestAlbumImage extends Component
{
    public function render()
    {
        $latestMedia = Media::query()
            ->whereHasMorph('model', [Album::class])
            ->where('collection_name', 'albums')
            ->with('model')
            ->orderByDesc('created_at')
            ->first();

        // Ensure the related model is an Album (safety in case of polymorphic reuse)
        $album = null;
        if ($latestMedia && $latestMedia->model instanceof Album) {
            $album = $latestMedia->model;
        }

        return view('livewire.albums.latest-album-image', [
            'latestMedia' => $latestMedia,
            'album' => $album,
        ]);
    }
}
