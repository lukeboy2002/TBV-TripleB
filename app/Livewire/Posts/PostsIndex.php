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
    use WithPagination;

    #[Url()]
    public $search = '';

    #[Url()]
    public $category = '';

    #[Url()]
    public $author = '';

    #[Url()]
    public $tag = '';

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
            ->when($this->author, function ($query, $author) {
                $query->whereHas('author', function ($query) use ($author) {
                    $query->where('username', $author);
                });
            })
            ->when($this->tag, function ($query, $tag) {
                $query->withAnyTags([$tag]);
            })
            ->orderBy('published_at', 'desc')
            ->paginate(8);
    }

    public function render()
    {
        return view('livewire.posts.posts-index');
    }
}
