<?php

namespace App\Livewire;

use App\Models\Like;
use App\Models\Post;
use Livewire\Component;

class Likes extends Component
{

    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $upvotes = Like::where('post_id', '=', $this->post->id)
            ->where('is_liked', true)
            ->count();

        $downvotes = Like::where('post_id', '=', $this->post->id)
            ->where('is_liked', false)
            ->count();

        // The status whether current user has upvoted the post or not.
        // This will be null, true, or false
        // null means user has not done upvote or downvote
        $hasUpvote = null;

        /** @var \App\Models\User $user */
        $user = request()->user();
        if ($user) {
            $model = Like::where('post_id', '=', $this->post->id)->where('user_id', '=', $user->id)->first();
            if ($model) {
                $hasUpvote = !!$model->is_liked;
            }
        }

        return view('livewire.likes', compact('upvotes', 'downvotes', 'hasUpvote'));
    }

    public function upvoteDownvote($upvote = true)
    {
        /** @var \App\Models\User $user */
        $user = request()->user();
        if (!$user) {
            return $this->redirect(route('login'));
        }
        if (!$user->hasVerifiedEmail()) {
            return $this->redirect(route('verification.notice'));
        }

        $model = Like::where('post_id', '=', $this->post->id)->where('user_id', '=', $user->id)->first();

        if (!$model) {
            \App\Models\Like::create([
                'is_liked' => $upvote,
                'post_id' => $this->post->id,
                'user_id' => $user->id
            ]);

            return;
        }

        if ($upvote && $model->is_liked || !$upvote && !$model->is_liked) {
            $model->delete();
        } else {
            $model->is_liked = $upvote;
            $model->save();
        }
    }
}
