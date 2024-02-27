<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LatestPosts extends Component
{
    public $latestPosts;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->latestPosts = Post::published()
            ->with('categories', 'author')
            ->latest('published_at')
            ->take(1)
            ->get();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.latest-posts');
    }
}
