<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::all();

        return view('albums.index', [
            'albums' => $albums,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $photos = $album->getMedia('albums');

        return view('albums.show', compact('album', 'photos'));
    }

    public function showImage(Album $album, $imageId)
    {
        $media = $album->getMedia('albums');
        $image = $media->where('id', $imageId)->first();
        //        dd($image);

        if (! $image) {
            abort(404, 'Image not found');
        }

        return view('albums.image-show', compact('album', 'image'));
    }
}
