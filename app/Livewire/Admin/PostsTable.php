<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostsTable extends Component
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
    public $confirmingForceDeletion = false;

    public function delete($id): void
    {
        $this->confirmingDeletion = $id;
    }

    public function forceDelete($id): void
    {
        $this->confirmingForceDeletion = $id;
    }

    public function deletePost(Post $post)
    {
        $post->delete();
        $this->confirmingDeletion = false;

        toastr()->success('Post has been deleted.', 'Delete Post');
    }

    public function ForceDeletePost(Request $request, $id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $image = $post->image;

        Storage::delete($image);

        $post->forceDelete();
        $this->confirmingForceDeletion = false;
        toastr()->success('Post deleted successfully.', 'Delete Post');
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
        return view('livewire.admin.posts-table', [
            'posts' => Post::search($this->search)
                ->with('author')
                ->orderBy($this->sortBy,$this->sortDir)
                ->withTrashed()
                ->paginate($this->perPage)
        ]);
    }
}
