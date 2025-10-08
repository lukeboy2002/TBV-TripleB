<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EditorUploadController extends Controller
{
    /**
     * Handle image upload from TipTap editor and return a public URL.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:5120'], // 5MB
        ]);

        $file = $validated['image'];

        // Build a safe filename with extension preserved
        $ext = $file->getClientOriginalExtension();
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeBase = Str::slug($name);
        $filename = $safeBase.'-'.Str::random(8).'.'.$ext;

        $path = $file->storeAs('editor', $filename, 'public');

        // Ensure the storage symlink exists (developer must run: php artisan storage:link)
        $url = asset('storage/'.$path);

        return response()->json([
            'url' => $url,
            'path' => $path,
        ]);
    }
}
