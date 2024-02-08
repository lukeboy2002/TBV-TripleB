<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostView;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with('author', 'categories')->paginate(6);

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post, Request $request): View
    {
//        $user = $request->user();
//        PostView::create([
//            'ip_address' => $request->ip(),
//            'user_agent' => $request->userAgent(),
//            'post_id' => $post->id,
//            'user_id' => $user?->id
//        ]);

        return view('posts.show', [
            'post' => $post
        ]);
    }
}
