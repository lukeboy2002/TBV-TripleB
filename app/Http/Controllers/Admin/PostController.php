<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
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
        if (! auth()->user()->can('create', Post::class)) {
            abort(403, 'You do not have access to this page.');
        }

        $request->validate([
            'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'min:10'],
            'category_id' => ['required', 'exists:categories,id'],
            'featured' => 'nullable|boolean',
        ]);

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->featured = $request->boolean('featured');
        $post->slug = $slug;

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete($post->image);
            }
            $path = $request->file('image')->store('posts', 'public');
            $post->image = $path;
        }

        $post->save();

        return redirect()->route('post.index')->with('success', 'Post has been updated');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! auth()->user()->can('create', Post::class)) {
            abort(403, 'You do not have access to this page.');
        }

        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'min:10'],
            'category_id' => ['required', 'exists:categories,id'],
            'featured' => ['nullable', 'boolean'],
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
            'featured' => $request['featured'],
            'published_at' => $request['published_at'],
        ]);

        return redirect()->route('post.index')->with('success', 'Post has been updated');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! auth()->user()->can('create', Post::class)) {
            abort(403, 'You do not have access to this page.');
        }

        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (! auth()->user()->can('delete', $post)) {
            abort(403, 'You do not have access to this page.');
        }

        // Delete all likes associated with the post
        $post->likes()->delete();

        // Get all comments to handle nested structure
        $comments = $post->comments()->get();

        // Helper function to recursively delete comments and their children
        $deleteCommentAndChildren = function ($comment) use (&$deleteCommentAndChildren) {
            // Delete likes on this comment
            $comment->likes()->delete();

            // Get all child comments
            $childComments = $comment->comments()->get();

            // Recursively delete each child comment
            foreach ($childComments as $childComment) {
                $deleteCommentAndChildren($childComment);
            }

            // Delete the comment itself
            $comment->delete();
        };

        // Delete all comments and their nested children
        foreach ($comments as $comment) {
            $deleteCommentAndChildren($comment);
        }

        // Delete the post
        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post has been deleted with all associated comments and likes.');
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
