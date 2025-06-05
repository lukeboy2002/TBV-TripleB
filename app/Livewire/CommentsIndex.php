<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class CommentsIndex extends Component
{
    use WithPagination;

    public Post $post;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $comments = Comment::where('post_id', $this->post->id)
            ->with(['post', 'user', 'comments'])
            ->whereNull('parent_id')
            ->orderByDesc('created_at')
            ->paginate(9);

        $commentsCount = Comment::where('post_id', '=', $this->post->id)
            ->whereNull('parent_id')
            ->count();

        return view('livewire.comments-index', [
            'comments' => $comments,
            'commentsCount' => $commentsCount,
        ]);
    }

    //    private function selectComments()
    //    {
    //        $commentsCount = Comment::where('post_id', '=', $this->post->id)
    //            ->whereNull('parent_id')
    //            ->count();
    //
    //        return Comment::where('post_id', '=', $this->post->id)
    //            ->with(['post', 'user', 'comments'])
    //            ->whereNull('parent_id')
    //            ->withCount('comments')
    //            ->orderByDesc('created_at')
    //            ->paginate(9);
    //    }
}
