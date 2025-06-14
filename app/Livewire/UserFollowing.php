<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserFollowing extends Component
{
    public User $user;

    public int $limit = 6;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $following = $this->user->following()->take($this->limit)->get();
        $totalFollowing = $this->user->following()->count();

        return view('livewire.user-following', [
            'following' => $following,
            'totalFollowing' => $totalFollowing,
        ]);
    }
}
