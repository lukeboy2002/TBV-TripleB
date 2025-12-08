<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use Livewire\Component;

class LatestAlbum extends Component
{
    protected $listeners = ['album-created' => '$refresh'];

    public function render()
    {
        $album = Album::with('user')
            ->latest()
            ->first();

        return view('livewire.albums.latest-album', [
            'album' => $album,
        ]);
    }
}
