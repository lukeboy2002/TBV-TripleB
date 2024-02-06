<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): View
    {

    }

    public function show(Post $post): View
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
