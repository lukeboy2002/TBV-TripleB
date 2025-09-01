<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Locked;
use Livewire\Component;

class DeleteImage extends Component
{
    use AuthorizesRequests;

    #[Locked]
    public Album $album;

    public int $imageId;

    public bool $showModal = false;

    public function mount(Album $album, int $imageId): void
    {
        $this->album = $album;
        $this->imageId = $imageId;
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function deleteImage(): void
    {
        $this->authorize('update', $this->album);

        $media = $this->album->getMedia('albums');
        $imageModel = $media->where('id', (int) $this->imageId)->first();
        if ($imageModel) {
            $imageModel->delete();
            session()->flash('success', 'De foto is verwijderd');

            $this->dispatch('album-image-deleted', imageId: $this->imageId);
        } else {
            session()->flash('error', 'De foto is niet gevonden.');
        }

        $this->redirect(route('album.edit', $this->album->slug));

    }

    public function render()
    {
        return view('livewire.albums.delete-image');
    }
}
