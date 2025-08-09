<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::inRandomOrder()->get();

        return view('albums.index', [
            'albums' => $albums,
        ]);
    }

    public function show(Album $album)
    {
        $photos = $album->getMedia();

        return view('albums.show', [
            'album' => $album,
            'photos' => $photos,
        ]);
    }
}
