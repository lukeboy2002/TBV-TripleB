<?php

namespace App\Livewire;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Likes extends Component
{
    public $type;

    public $id;

    public $likeable;

    public $isLiked = false;

    public $isCreator = false;

    public function mount($type, $id): void
    {
        $this->type = $type;
        $this->id = $id;
        $this->likeable = $this->findLikeable($type, $id);
        $this->isLiked = $this->likeable
            ->likes()
            ->where('user_id', Auth::id())
            ->exists();

        // Determine if the current user is the creator of the likeable item
        if (Auth::check()) {
            // For posts, check if the user is the author
            if (method_exists($this->likeable, 'author') && $this->likeable->author) {
                $this->isCreator = $this->likeable->author->id === Auth::id();
            }

            // For comments, check if the user is the commenter
            if (method_exists($this->likeable, 'user') && $this->likeable->user) {
                $this->isCreator = $this->likeable->user->id === Auth::id();
            }
        }
    }

    protected function findLikeable(string $type, int $id): Model
    {
        /** @var class-string<Model>|null $modelName */
        $modelName = Relation::getMorphedModel($type);

        if ($modelName === null) {
            throw new ModelNotFoundException;
        }

        return $modelName::findOrFail($id);
    }

    public function toggleLike(): void
    {
        if ($this->isLiked) {
            $this->unlike();
        } else {
            $this->like();
        }
    }

    protected function unlike(): void
    {
        // Authorization check
        $this->authorize('delete', [Like::class, $this->likeable]);

        // Remove like
        $this->likeable->likes()->where('user_id', Auth::id())->delete();
        $this->likeable->decrement('likes_count');
        $this->isLiked = false;

        // Notify the post stats
        if (method_exists($this->likeable, 'getMorphClass') && $this->type === 'post') {
            $this->dispatch('postUnliked');
        }
    }

    protected function like(): void
    {
        // Authorization check
        $this->authorize('create', [Like::class, $this->likeable]);

        // Add like
        $this->likeable->likes()->create([
            'user_id' => Auth::id(),
        ]);
        $this->likeable->increment('likes_count');
        $this->isLiked = true;

        // Notify the post stats
        if (method_exists($this->likeable, 'getMorphClass') && $this->type === 'post') {
            $this->dispatch('postLiked');
        }
    }

    public function render()
    {
        return view('livewire.likes');
    }
}
