<?php

namespace App\Livewire\Admin;

use App\Models\Album;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class AlbumsTable extends Component
{

    use WithPagination;

    public $delete_id;

    #[Url(history:true)]
    public $search ='';

    #[Url(history:true)]
    public $sortBy = 'created_at';

    #[Url(history:true)]
    public $sortDir = 'DESC';

    #[Url()]
    public $perPage = 10;

    public function updatedSearch(){
        $this->resetPage();
    }

    public $confirmingDeletion = false;

    public function delete($id): void
    {
        $this->confirmingDeletion = $id;
    }

    public function deleteAlbum(Album $album)
    {
        $album->delete();
        $image_path = $album->image;

        Storage::delete($image_path);

        $this->confirmingDeletion = false;

        toastr()->success('Album has been deleted.', 'Delete Album');
    }

    public function setSortBy($sortByField){

        if($this->sortBy === $sortByField){
            $this->sortDir = ($this->sortDir == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        return view('livewire.admin.albums-table', [
            'albums' => Album::search($this->search)
                ->orderBy($this->sortBy,$this->sortDir)
                ->with('user')
                ->paginate($this->perPage)
        ]);
    }
}
