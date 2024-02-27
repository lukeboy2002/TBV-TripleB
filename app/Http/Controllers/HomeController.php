<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $featuredPosts = Post::published()
            ->featured()
            ->with('categories', 'author', 'comments')
            ->latest('published_at')
            ->take(1)
            ->get();

//        $latestPosts = Post::published()->with('categories', 'author')->latest('published_at')->take(2)->get();

//        $categories = Category::whereHas('posts', function ($query) {
//                $query->published();
//            })->take(10)->get();

        return view('home', [
            'featuredPosts' => $featuredPosts,
//            'latestPosts' => $latestPosts,
//            'categories' => $categories,
        ]);
    }
}
