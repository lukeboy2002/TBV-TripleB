<?php

namespace App\Http\Controllers;

use App\Models\Post;

class AlbumController extends Controller
{
    public function index()
    {
        return view('albums.index');
    }

    public function show(Post $post)
    {
        return view('albums.show', compact('post'));
    }
}
