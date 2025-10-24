<?php

namespace App\Livewire\Actions;

use App\Models\Post;
use Livewire\Component;

class PostActions extends Component
{
    public Post $post;

    public bool $showModal = false;

    public function mount(Post $post)
    {
        $this->showModal = false;
        $this->post = $post;
    }

    public function deletePost()
    {
        $this->authorize('delete', $this->post);

        // Delete all likes associated with the post
        $this->post->likes()->delete();

        // Get all comments to handle nested structure
        $comments = $this->post->comments()->get();

        // Helper function to recursively delete comments and their children
        $deleteCommentAndChildren = function ($comment) use (&$deleteCommentAndChildren) {
            $comment->likes()->delete();
            $childComments = $comment->comments()->get();

            foreach ($childComments as $childComment) {
                $deleteCommentAndChildren($childComment);
            }

            $comment->delete();
        };

        // Delete all comments and their nested children
        foreach ($comments as $comment) {
            $deleteCommentAndChildren($comment);
        }

        // Delete the post
        $this->showModal = true;
        $this->post->delete();

        session()->flash('success', 'The post and all its comments have been deleted');

        $this->redirect(route('post.index'));
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function render()
    {
        return view('livewire.actions.post-actions');
    }
}
