<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlbumController extends Controller
{
    public function index(): View
    {
        $albums = Album::all();

        return view('albums.index', [
            'albums' => $albums,
        ]);
    }

    public function show(Album $album): View
    {
        $photos = $album->getMedia();
        return view('albums.show', compact('album', 'photos'));
    }

    public function showImage(Album $album, $id)
    {
        $media = $album->getMedia();
        $image = $media->where('id', $id)->first();

        return view('albums.image', compact('album', 'image'));
    }

}
