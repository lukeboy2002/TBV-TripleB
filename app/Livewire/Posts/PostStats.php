<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class PostStats extends Component
{
    public Post $post;

    public int $views = 0;

    public int $comments = 0;

    public int $likes = 0;

    protected $listeners = [
        'commentCreated' => 'refreshCounts',
        'commentUpdated' => 'refreshCounts',
        'postUnliked' => 'refreshCounts',
        'postLiked' => 'refreshCounts',
    ];

    public function mount(Post $post): void
    {
        $this->post = $post;
        $this->refreshCounts();
    }

    public function refreshCounts(): void
    {
        // Keep the local model fresh and set the counters
        $fresh = $this->post->fresh();
        $this->views = (int) $fresh->views_count;
        $this->likes = (int) $fresh->likes_count;
        // Using a count query to avoid loading whole relation
        $this->comments = (int) $fresh->comments()->count();
    }

    public function render()
    {
        return view('livewire.posts.post-stats');
    }
}
