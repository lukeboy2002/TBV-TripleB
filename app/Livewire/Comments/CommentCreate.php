<?php

namespace App\Livewire\Comments;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CommentCreate extends Component
{
    #[Validate('required|min:3|max:200', onUpdate: true)]
    public string $comment;

    public Post $post;

    public ?Comment $commentModel = null;

    public ?Comment $parentComment = null;

    public function mount(Post $post, $commentModel = null, $parentComment = null)
    {
        $this->post = $post;
        $this->commentModel = $commentModel;
        $this->comment = $commentModel ? $commentModel->comment : '';

        $this->parentComment = $parentComment;
    }

    public function createComment()
    {
        $this->validate();

        $user = auth()->user();
        if (! $user) {
            return $this->redirect('/login');
        }

        if ($this->commentModel) {
            if ($this->commentModel->user_id != $user->id) {
                return response('You are not allowed to perform this action', 403);
            }

            $this->commentModel->comment = $this->comment;
            $this->commentModel->save();

            $this->comment = '';
            $this->dispatch('commentUpdated');
        } else {

            $comment = Comment::create([
                'comment' => $this->comment,
                'post_id' => $this->post->id,
                'user_id' => $user->id,
                'parent_id' => $this->parentComment?->id,
            ]);

            $this->dispatch('commentCreated', $comment->id);
            $this->comment = '';
        }
    }

    public function render()
    {
        return view('livewire.comments.comment-create');
    }
}
