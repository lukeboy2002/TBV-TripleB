<?php

namespace App\Http\Controllers;

use App\Actions\Counter\ViewCounter;
use App\Models\Post;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }

    public function show(Post $post, Request $request, Cache $cache)
    {
        $this->countRead($post, $request, $cache);

        $moreFromAuthor = Post::query()
            ->published()
            ->where('user_id', $post->user_id)
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->limit(4)
            ->get();

        $moreInCategory = Post::query()
            ->published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->orderByDesc('published_at')
            ->limit(4)
            ->get();

        return view('posts.show', [
            'post' => $post,
            'moreFromAuthor' => $moreFromAuthor,
            'moreInCategory' => $moreInCategory,
        ]);
    }

    protected function countRead(Post $post, Request $request, Cache $cache): void
    {
        $visitorKey = ViewCounter::visitorKey($request);
        $cacheKey = "post:{$post->id}:read:{$visitorKey}";

        // Only set if not present. TTL 8 hours.
        if ($cache->add($cacheKey, true, now()->addHours(1))) {
            // This is the first read for this visitor in 8h → increment views atomically
            $post->increment('views_count');
        }
    }
}
