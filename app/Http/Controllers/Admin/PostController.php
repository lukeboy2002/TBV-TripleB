<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\post;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create:post');

        $categories = Category::all();

        return view('admin.posts.create', [
            'categories'=>$categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create:post');

//        dd($request);
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255', 'unique:posts'],
            'image' => ['required'],
            'body' => ['required', 'min:10'],
        ]);

        $newFilename = Str::after($request->input('image'), 'tmp/');
        Storage::disk('public')->move($request->input('image'), "posts/$newFilename");

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        $post = Post::create([
            'user_id' => current_user()->id,
            'title' => $request['title'],
            'slug' => $slug,
            'image' => "posts/$newFilename",
            'body' => $request['body'],
            'featured' => $request['featured'],
            'published_at' => $request['published_at'],
        ]);

        $post->categories()->attach($request->categories);

        toastr()->success('Post successfully created', 'Created Post');
        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        //
    }

    public function upload(Request $request)
    {
        try {
            $post = new Post();
            $post->id = 0;
            $post->exists = true;
            $image = $post->addMediaFromRequest('upload')->toMediaCollection('posts');

            return response()->json([
                'uploaded' => true,
                'url' => $image->getUrl('thumbnail')
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'uploaded' => false,
                    'error'    => [
                        'message' => $e->getMessage()
                    ]
                ]
            );
        }
    }
}
