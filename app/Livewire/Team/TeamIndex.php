<?php

namespace App\Livewire\Team;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class TeamIndex extends Component
{
    use WithPagination;

    #[Computed]
    public function users()
    {
        return User::role('member')
            ->with('profile')
            ->simplePaginate(1);
    }

    public function render()
    {
        return view('livewire.team.team-index');
    }
}
