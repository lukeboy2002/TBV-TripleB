<?php

namespace App\Policies;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class LikePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Like $like): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Model $likeable): bool
    {
        // Check if the user has already liked the item
        $alreadyLiked = $likeable->likes()
            ->where('user_id', $user->id)
            ->exists();

        // Check if the user is the creator of the likeable item
        $isCreator = false;

        // For posts, check if the user is the author
        if (method_exists($likeable, 'author') && $likeable->author) {
            $isCreator = $likeable->author->id === $user->id;
        }

        // For comments, check if the user is the commenter
        if (method_exists($likeable, 'user') && $likeable->user) {
            $isCreator = $likeable->user->id === $user->id;
        }

        // User can like if they haven't already liked it and they're not the creator
        return ! $alreadyLiked && ! $isCreator;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Like $like): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Model $likeable): bool
    {
        return $likeable->likes()
            ->where('user_id', $user->id)
            ->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Like $like): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Like $like): bool
    {
        return false;
    }
}
