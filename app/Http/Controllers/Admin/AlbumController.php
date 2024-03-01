<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.albums.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create:album');

        return view('admin.albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create:album');

        $this->validate($request, [
            'title' => [
                'required',
                'string',
                'max:255',
                'unique:albums',
            ],
            'image' => ['required'],
        ]);

        $newFilename = Str::after($request->input('image'), 'tmp/');

        Storage::disk('public')->move($request->input('image'), "albums/$newFilename");

        $slug = SlugService::createSlug(Album::class, 'slug', request()->title);

        Album::create([
            'title' => $request['title'],
            'slug' => $slug,
            'user_id' => current_user()->id,
            'image' => "albums/$newFilename",
        ]);

        toastr()->success('Album successfully created.', 'New Album');
        return redirect()->route('admin.albums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $photos = $album->getMedia();
        return view('admin.albums.show', compact('album', 'photos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        $this->authorize('update', $album);

        return view('admin.albums.edit', compact('album'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        $this->authorize('update', $album);

        $this->validate($request, [
            'title' => ['required', 'string', 'max:255', Rule::unique('albums')->ignore($album)],
            'image' => ['required'],
        ]);

        if (str()->afterLast($request->input('image'), '/') !== str()->afterLast($album->image, '/')) {
            Storage::disk('public')->delete($album->image);
            $newFilename = Str::after($request->input('image'), 'tmp/');
            Storage::disk('public')->move($request->input('image'), "albums/$newFilename");
        }

        $slug = SlugService::createSlug(Album::class, 'slug', $request->title);

        $album->update([
            'title' => $request['title'],
            'slug' => $slug,
            'image' => isset($newFilename) ? "albums/$newFilename" : $album->image,

        ]);

        toastr()->success('Album successfully updated.', 'Edit Album');

        return redirect()->route('admin.albums.index');
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
        if ($request->has('image')) {
            $album->addMedia($request->image)
                ->toMediaCollection();
        }
        return redirect()->back();
    }

    public function destroyImage(Album $album, $id)
    {
        $media = $album->getMedia();
        $image = $media->where('id', $id)->first();
        $image->delete();

        return redirect()->back();
    }
}
