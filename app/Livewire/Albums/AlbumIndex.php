<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class AlbumIndex extends Component
{
    use WithPagination;

    public int $layoutSeed = 0;

    public function mount(): void
    {
        // Seed used to vary the playful layout on each full page load
        $this->layoutSeed = random_int(PHP_INT_MIN, PHP_INT_MAX);
    }

    // When the paginator page changes, refresh the seed so the layout changes too
    public function updatedPage($page): void
    {
        $this->layoutSeed = random_int(PHP_INT_MIN, PHP_INT_MAX);
    }

    #[Computed]
    public function albums()
    {
        return Album::with('user')
            ->paginate(6);
    }

    public function render()
    {
        return view('livewire.albums.album-index');
    }
}
