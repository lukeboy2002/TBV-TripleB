<?php

namespace App\Livewire\Comments;

use App\Models\Comment;
use Livewire\Component;

class Item extends Component
{
    public bool $showModal = false;

    public Comment $comment;

    public bool $editing = false;

    public bool $replying = false;

    protected $listeners = [
        'cancelEditing' => 'cancelEditing',
        'commentUpdated' => 'commentUpdated',
        'commentCreated' => 'commentCreated',
        'commentDeleted' => 'commentDeleted',
    ];

    public function mount(Comment $comment)
    {
        $this->showModal = false;
        $this->comment = $comment->load('user', 'comments');
    }

    public function deleteComment()
    {
        $this->authorize('delete', $this->comment);

        $user = auth()->user();
        if (! $user) {
            return $this->redirect('/login');
        }

        if ($this->comment->user_id != $user->id) {
            return response('You are not allowed to perform this action', 403);
        }

        $id = $this->comment->id;
        $this->showModal = true;

        // Delete all likes associated with the post
        $this->comment->likes()->delete();

        $this->comment->delete();
        $this->dispatch('commentDeleted', $id);

        return redirect()->route('post.show', ['post' => $this->comment->post->slug])
            ->with('success', 'Comment has been deleted.');

    }

    public function startCommentEdit()
    {
        $this->authorize('update', $this->comment);

        $this->editing = true;
    }

    public function cancelEditing()
    {
        $this->editing = false;
        $this->replying = false;
    }

    public function commentUpdated()
    {
        $this->editing = false;
    }

    public function startReply()
    {
        $this->replying = true;
    }

    public function commentCreated()
    {
        $this->replying = false;
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function render()
    {
        return view('livewire.comments.item');
    }
}
