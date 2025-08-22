<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
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
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (! auth()->user()->can('update', $post)) {
            abort(403, 'You do not have access to this page.');
        }

        $categories = Category::all();

        return view('posts.edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (! auth()->user()->can('update', $post)) {
            abort(403, 'You do not have access to this page.');
        }

        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'min:10'],
            'category_id' => ['required', 'exists:categories,id'],
            'featured' => ['sometimes', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $imageChanged = true;
            if ($post->image) {
                Storage::delete($post->image);
            }
            $path = $request->file('image')->store('posts', 'public');
            $post->image = $path;
        }

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        $post->update([
            'title' => $request['title'],
            'slug' => $slug,
            'category_id' => $request['category_id'],
            'image' => isset($newFilename) ? "posts/$newFilename" : $post->image,
            'body' => $request['body'],
            'featured' => $request->boolean('featured'), // dit geeft false als niet aanwezig
            'updated_at' => NOW(),
        ]);

        flash()->success('Post successfully updated.');

        return redirect()->route('post.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('create:post')) {
            abort(403, 'You do not have access to this page.');
        }

        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'min:10'],
            'category_id' => ['required', 'exists:categories,id'],
            'featured' => ['sometimes', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
        }

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        Post::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request['category_id'],
            'title' => $request['title'],
            'slug' => $slug,
            'image' => $path,
            'body' => $request['body'],
            'featured' => $request->boolean('featured'),
            'published_at' => $request['published_at'],
        ]);

        flash()->success('Post successfully created.');

        return redirect()->route('post.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! auth()->user()->can('create:post')) {
            abort(403, 'You do not have access to this page.');
        }

        $categories = Category::all();

        return view('posts.create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function upload(Request $request)
    {

        try {
            $post = new Post;
            $post->id = 0;
            $post->exists = true;
            $image = $post->addMediaFromRequest('upload')->toMediaCollection('posts');

            return response()->json([
                'uploaded' => true,
                'url' => $image->getUrl(),
            ]);
        } catch (Exception $e) {
            return response()->json(
                [
                    'uploaded' => false,
                    'error' => [
                        'message' => $e->getMessage(),
                    ],
                ]
            );
        }
    }
}
