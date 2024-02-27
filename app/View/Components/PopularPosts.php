<?php

namespace App\View\Components;

use App\Models\Post;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class PopularPosts extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $popularPosts = Post::query()
            ->leftJoin('likes', 'posts.id', '=', 'likes.post_id')
            ->select('posts.*', DB::raw('COUNT(likes.id) as like_count'))
            ->where(function ($query) {
                $query->whereNull('likes.is_liked')
                    ->orWhere('likes.is_liked', '=', 1);
            })
            ->whereDate('published_at', '<', Carbon::now())
            ->orderByDesc('like_count')
            ->groupBy([
                'posts.id',
            ])
            ->limit(3)
            ->get();

        return view('components.popular-posts', [
            'popularPosts' => $popularPosts
        ]);
    }
}
