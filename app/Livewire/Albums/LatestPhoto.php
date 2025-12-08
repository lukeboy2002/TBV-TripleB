<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LatestPhoto extends Component
{
    protected $listeners = ['album-created' => '$refresh'];

    public function render()
    {
        $photo = Media::query()
            ->where('model_type', Album::class)
            ->where('collection_name', 'albums')
            ->latest()
            ->first();

        return view('livewire.albums.latest-photo', [
            'photo' => $photo,
        ]);
    }
}
