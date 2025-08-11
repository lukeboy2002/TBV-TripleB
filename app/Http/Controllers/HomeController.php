<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $featuredPosts = Post::published()
            ->featured()
            ->with('author', 'comments', 'category')
            ->inRandomOrder()
            ->orderBy('published_at', 'desc')
            ->take(2)
            ->get();

        // Exclude featured posts from latest posts
        $featuredIds = $featuredPosts->pluck('id');

        $latestPosts = Post::published()
            ->whereNotIn('id', $featuredIds)
            ->with('author', 'comments', 'category')
            ->orderBy('published_at', 'desc')
            ->take(2)
            ->get();

        return view('home', [
            'featuredPosts' => $featuredPosts,
            'latestPosts' => $latestPosts,
        ]);
    }
}
