<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PostController extends Controller
{
    public function index()
    {
        $categories = Cache::remember('categories', now()->addDays(3), function () {
            return Category::whereHas('posts', function ($query) {
                $query->published();
            })->take(10)->get();
        });

        return view('posts.index', [
            'categories' => $categories
        ]);
    }

    public function show(Post $post, Request $request): View
    {
//        $user = $request->user();
//        PostView::create([
//            'ip_address' => $request->ip(),
//            'user_agent' => $request->userAgent(),
//            'post_id' => $post->id,
//            'user_id' => $user?->id
//        ]);

        if(!Post::where('slug', $post->slug)->exists() || $post->published_at > Carbon::now() ) {
            throw new NotFoundHttpException();
        }

        $next = Post::query()
            ->whereDate('published_at', '<=', Carbon::now())
            ->whereDate('published_at', '<', $post->published_at)
            ->orderBy('published_at', 'desc')
            ->limit(1)
            ->first();

        $prev = Post::query()
            ->whereDate('published_at', '<=', Carbon::now())
            ->whereDate('published_at', '>', $post->published_at)
            ->orderBy('published_at', 'asc')
            ->limit(1)
            ->first();

        return view('posts.show', [
            'post' => $post,
            'prev' => $prev,
            'next' => $next,
        ]);
    }
}
