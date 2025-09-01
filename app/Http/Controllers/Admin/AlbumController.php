<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        if (! auth()->user()->can('update', $album)) {
            abort(403, 'You do not have access to this page.');
        }

        $photos = $album->getMedia('albums');

        return view('albums.edit', [], [
            'album' => $album,
            'photos' => $photos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        if (! auth()->user()->can('update', $album)) {
            abort(403, 'You do not have access to this page.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $imageChanged = true;
            if ($album->image) {
                Storage::delete($album->image);
            }
            $path = $request->file('image')->store('albums', 'public');
            $album->image = $path;
        }

        $slug = SlugService::createSlug(Album::class, 'slug', $request->name);

        $album->update([
            'name' => $request['name'],
            'slug' => $slug,
            'image' => isset($newFilename) ? "albums/$newFilename" : $album->image,
        ]);

        flash()->success('Album successfully updated.');

        return redirect()->route('albums.index');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('create:album')) {
            abort(403, 'You do not have access to this page.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('albums', 'public');
        }

        $slug = SlugService::createSlug(Album::class, 'slug', $request->name);

        $album = Album::create([
            'user_id' => auth()->user()->id,
            'name' => $request['name'],
            'slug' => $slug,
            'image' => $path,
        ]);

        flash()->success('Album successfully created.');

        return redirect()->route('album.edit', $album->slug);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! auth()->user()->can('create:album')) {
            abort(403, 'You do not have access to this page.');
        }

        return view('albums.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
    }

    public function upload(Request $request, Album $album)
    {
        // Validate multiple images
        $request->validate([
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:8192'],
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $album->addMedia($image)->toMediaCollection('albums');
            }
        }

        flash()->success('Images uploaded.');

        return redirect()->back();
    }
}
