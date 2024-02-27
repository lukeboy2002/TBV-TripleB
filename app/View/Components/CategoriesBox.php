<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class CategoriesBox extends Component
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
        $categories = Category::query()
            ->join('category_post', 'categories.id', '=', 'category_post.category_id')
            ->join('posts', 'category_post.post_id', '=', 'posts.id')
            ->whereDate('posts.published_at', '<=', now()) // Filter only posts with a publication date in the past
            ->select('categories.title', 'categories.slug', 'categories.color', DB::raw('count(*) as total'))
            ->groupBy([
                'categories.title', 'categories.slug'
            ])
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('components.categories-box', [
            'categories' => $categories,
        ]);
    }
}
