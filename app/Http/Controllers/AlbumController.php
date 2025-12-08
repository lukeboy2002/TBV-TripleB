<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        return view('albums.index');
    }

    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }
}
