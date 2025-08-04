<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostsIndex extends Component
{
    use withPagination;

    #[Url()]
    public $search = '';

    #[Url()]
    public $category = '';

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }

    #[Computed]
    public function activeCategory()
    {
        if ($this->category === null || $this->category === '') {
            return null;
        }

        return Category::where('slug', $this->category)->first();
    }

    #[Computed]
    public function posts()
    {
        return Post::published()
            ->with('author', 'comments', 'category')
            ->search($this->search)
            ->when($this->category, function ($query, $category) {
                $query->whereHas('category', function ($query) use ($category) {
                    $query->where('slug', $category);
                });
            })
            ->orderBy('published_at', 'desc')
            ->paginate(8);
    }

    public function render()
    {
        return view('livewire.posts.posts-index');
    }
}
