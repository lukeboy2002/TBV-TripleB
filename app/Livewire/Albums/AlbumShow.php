<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use Livewire\Component;
use Livewire\WithPagination;

class AlbumShow extends Component
{
    use WithPagination;

    public Album $album;

    // Use a distinct page name to avoid conflicts with other paginators on the page
    public $showModal = false;

    // Optional: Tailwind is default in Breeze/Jetstream setups; keep if needed
    public $modalImageUrl = null;

    public $modalImageAlt = null;

    protected string $pageName = 'photosPage';

    protected $paginationTheme = 'tailwind';

    public function mount(Album $album): void
    {
        $this->album = $album;
    }

    public function toggleModal(): void
    {
        $this->showModal = ! $this->showModal;
    }

    public function openImageById(int $mediaId): void
    {
        // Fetch the media directly from the relation so it works across pages
        $media = $this->album
            ->media()
            ->where('collection_name', 'albums')
            ->where('id', $mediaId)
            ->first();
        if ($media) {
            $this->modalImageUrl = $media->getUrl();
            $this->modalImageAlt = $media->name ?: $this->album->title;
            $this->showModal = true;
        }
    }

    public function render()
    {
        $photos = $this->album
            ->media()
            ->where('collection_name', 'albums')
            ->orderBy('order_column')
            ->paginate(6, ['*'], $this->pageName);

        return view('livewire.albums.album-show', [
            'photos' => $photos,
        ]);
    }
}
