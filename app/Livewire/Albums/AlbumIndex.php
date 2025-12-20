<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class AlbumIndex extends Component
{
    use WithPagination;

    public Album $album;

    public bool $showModal = false;

    public ?Album $selectedAlbum = null;

    protected $listeners = [
        'album-created' => 'refreshAlbums',
        'album-deleted' => 'refreshAlbums',
    ];

    public function mount(Album $album)
    {
        $this->showModal = false;
        $this->album = $album;
    }

    #[Computed]
    public function albums()
    {
        return Album::with('user')
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
    }

    public function confirmDeletion($id)
    {
        $this->selectedAlbum = Album::findOrFail($id);
        $this->toggleModal();
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function deletePost()
    {
        if (! auth()->user()->can('delete', $this->selectedAlbum)) {
            abort(403, __('You do not have access to delete this Album.'));
        }

        $this->selectedAlbum->delete();
        $this->selectedAlbum = null;
        $this->showModal = false;

        // Reset pagination to avoid landing on an empty/non-existent page after deletion
        $this->resetPage();

        flash()->success(__('The album has been deleted'));
        $this->dispatch('album-deleted');
    }

    public function refreshAlbums(): void
    {
        // Ensure pagination stays in a valid state when albums are created/deleted
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.albums.album-index');
    }
}
