<?php

namespace App\Livewire;

use App\Models\Album;
use Livewire\Component;

class DeleteImage extends Component
{
    public Album $album;

    public int $imageId;

    public bool $showModal = false;

    public function mount(Album $album, int $imageId)
    {
        $this->showModal = false;
        $this->album = $album;
        $this->imageId = $imageId;
    }

    public function deleteImage()
    {
        $this->authorize('delete', $this->album);

        $media = $this->album->getMedia('albums')->where('id', $this->imageId)->first();

        if ($media) {
            $media->delete();
        }

        // Use Livewire's redirect method to ensure proper page reload
        $this->redirect(url()->previous(), navigate: false);

        // Add a flash message
        session()->flash('success', 'Image deleted successfully.');

    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function render()
    {
        return view('livewire.delete-image');
    }
}
