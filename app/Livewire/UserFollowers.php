<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserFollowers extends Component
{
    public User $user;

    public int $limit = 6;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $followers = $this->user->followers()->take($this->limit)->get();
        $totalFollowers = $this->user->followers()->count();

        return view('livewire.user-followers', [
            'followers' => $followers,
            'totalFollowers' => $totalFollowers,
        ]);
    }
}
