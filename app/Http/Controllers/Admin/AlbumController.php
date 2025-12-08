<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;

class AlbumController extends Controller
{
    public function create()
    {
        return view('admin.album.create');
    }

    public function edit(Album $album)
    {
        return view('admin.album.edit', compact('album'));
    }
}
