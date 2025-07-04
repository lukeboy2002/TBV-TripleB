<?php

namespace App\Livewire;

use App\Models\Album;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteAlbum extends Component
{
    public Album $album;

    public bool $showModal = false;

    public function mount(Album $album)
    {
        $this->showModal = false;
        $this->album = $album;
    }

    public function deleteAlbum()
    {
        $this->authorize('delete', $this->album);

        //        $media = $this->album->getMedia('albums')->where('id', $this->imageId)->first();

        if ($this->album->image && Storage::exists($this->album->image)) {
            Storage::delete($this->album->image);
        }

        $this->album->delete();

        // Use Livewire's redirect method to ensure proper page reload
        $this->redirect(url()->previous(), navigate: false);

        // Add a flash message
        session()->flash('success', 'Album deleted successfully.');

    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function render()
    {
        return view('livewire.delete-album');
    }
}
