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

        return view('albums.edit', compact('album'));
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
            'description' => ['required', 'string', 'max:255'],
        ]);

        $slug = SlugService::createSlug(Album::class, 'slug', $request->name);

        // Store original values for comparison
        $originalName = $album->name;
        $originalDescription = $album->description;
        $originalSlug = $album->slug;

        // Set the new values
        $album->name = $request->name;
        $album->description = $request->description;
        $album->slug = $slug;

        // Check if any field has changed
        $nameChanged = $originalName != $request->name;
        $descriptionChanged = $originalDescription != $request->description;
        $slugChanged = $originalSlug != $slug;

        // Handle image upload
        $imageChanged = false;
        if ($request->hasFile('image')) {
            $imageChanged = true;
            if ($album->image) {
                Storage::delete($album->image);
            }
            $path = $request->file('image')->store('albums', 'public');
            $album->image = $path;
        }

        // Force the model to be saved if any field has changed
        if ($nameChanged || $descriptionChanged || $slugChanged || $imageChanged) {
            // If Laravel doesn't detect changes, force an update
            if (! $album->isDirty()) {
                $album->updated_at = now();
            }
        }

        $album->save();

        return redirect()->route('albums.index')->with('success', 'Album has been updated');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('create', Album::class)) {
            abort(403, 'You do not have access to this page.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('albums', 'public');
        }

        $slug = SlugService::createSlug(Album::class, 'slug', $request->name);

        Album::create([
            'user_id' => auth()->user()->id,
            'name' => $request['name'],
            'slug' => $slug,
            'description' => $request['description'],
            'image' => $path,
        ]);

        return redirect()->route('albums.index')->with('success', 'Album is created successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! auth()->user()->can('create', Album::class)) {
            abort(403, 'You do not have access to this page.');
        }

        return view('albums.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //        if (! auth()->user()->can('delete', $album)) {
        //            abort(403, 'You do not have access to this page.');
        //        }
        //
        //        if ($album->image && Storage::exists($album->image)) {
        //            Storage::delete($album->image);
        //        }
        //
        //        $album->delete();
        //
        //        return redirect()->back();
    }

    public function upload(Request $request, Album $album)
    {
        if (! auth()->user()->can('addImage', $album)) {
            abort(403, 'You do not have access to this page.');
        }

        $request->validate([
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->has('image')) {
            $album->addMediaFromRequest('image')->toMediaCollection('albums');
        }

        return redirect()->back();
    }
}
