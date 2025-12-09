<?php

namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use App\Support\ImageCompressor;
use ArrayAccess;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostCreate extends Component
{
    use WithFileUploads;

    #[Rule('required|string|max:100')]
    public $title;

    #[Rule('required|max:100')]
    public string $slug;

    #[Rule('required|min:10')]
    public $body;

    #[Rule('nullable|image|max:10240|mimes:jpg,jpeg,png,webp,heic,heif')]
    public $featured_image;

    public $is_featured = false;

    #[Rule('nullable|date')]
    public $published_at;

    #[Rule('required|exists:categories,id')]
    public $category_id;

    public $tags = [];

    public $allCategories;

    public function mount()
    {
        $this->allCategories = Category::all();
        // Default published date to today (no time)
        $this->published_at = now()->format('Y-m-d');
    }

    public function updatedTitle(): void
    {
        $this->slug = SlugService::createSlug(Post::class, 'slug', $this->title);
    }

    public function save()
    {

        $path = $this->featured_image
            ? $this->featured_image->store('posts', 'public')
            : null;

        if ($path) {
            // Compress to <= 1.1 megabytes (MB)
            $absolute = storage_path('app/public/'.$path);
            ImageCompressor::compressToMaxBytes($absolute, 1024_000);
        }

        $post = Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'featured_image' => $path,
            'is_featured' => $this->is_featured,
            'published_at' => $this->published_at,
            'category_id' => $this->category_id,
            'user_id' => auth()->id(),
        ]);

        // Normalize tags input to an array for Spatie Tags
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

        if (! empty($tags)) {
            $post->attachTags($tags);
        }

        flash()->success('Blog post successfully created');

        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.posts.post-create');
    }
}
