<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::inRandomOrder()
            ->withCount([
                'media as images_count' => function ($q) {
                    $q->where('collection_name', 'albums');
                },
            ])
            ->get();

        return view('albums.index', [
            'albums' => $albums,
        ]);
    }

    public function show(Album $album)
    {
        $photos = $album->getMedia('albums');

        return view('albums.show', [
            'album' => $album,
            'photos' => $photos,
        ]);
    }
}
