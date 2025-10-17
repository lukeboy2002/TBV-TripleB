<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostEdit extends Component
{
    use WithFileUploads;

    public Post $post;

    public $title;

    public $slug;

    public $content;

    public $featured_image;

    public $new_featured_image;

    public $is_featured;

    public $published_at;

    public $category_id;

    public $tags = [];

    public $allCategories;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->content = $post->content;
        $this->is_featured = $post->is_featured;
        $this->published_at = $post->published_at?->format('Y-m-d');
        $this->category_id = $post->category_id;
        $this->featured_image = $post->featured_image;
        $this->tags = $post->tags->pluck('name')->toArray();

        $this->allCategories = Category::all();
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|unique:posts,slug,'.$this->post->id,
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'new_featured_image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        // Upload nieuwe afbeelding indien aanwezig
        if ($this->new_featured_image) {
            $path = $this->new_featured_image->store('posts', 'public');
            $this->featured_image = $path;
        }

        $this->post->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'featured_image' => $this->featured_image,
            'is_featured' => $this->is_featured,
            'published_at' => $this->published_at,
            'category_id' => $this->category_id,
        ]);

        // Tags synchroniseren
        $tags = $this->tags;
        if (is_string($tags)) {
            // Split by commas/semicolons/pipes, trim each, and remove empties
            $tags = array_filter(array_map(static fn ($t) => trim($t), preg_split('/[,;|]+/', $tags)));
        }
        if ($tags instanceof ArrayAccess) {
            $tags = (array) $tags;
        }
        if (! is_array($tags) && ! empty($tags)) {
            $tags = [$tags];
        }
        $tags = array_values(array_filter($tags, static fn ($t) => is_string($t) && $t !== ''));

        $this->post->syncTags($tags);

        session()->flash('success', 'Blogbericht succesvol bijgewerkt!');

        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.posts.post-edit');
    }
}
