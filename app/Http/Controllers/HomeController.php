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
        $featuredPosts = Post::published()->featured()->with('categories', 'author')->latest('published_at')->take(1)->get();

        $latestPosts = Post::published()->with('categories', 'author')->latest('published_at')->take(2)->get();

        return view('home', [
            'featuredPosts' => $featuredPosts,
            'latestPosts' => $latestPosts
        ]);
    }
}
