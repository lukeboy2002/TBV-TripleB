<?php

namespace App\Livewire;

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
            ->withCount(['gamePlayers as total_games_played'])
            ->withSum('gamePlayers as total_points', 'points')
            ->withCount(['gamePlayers as total_games_won' => function ($query) {
                $query->where('is_winner', true);
            }])
            ->withCount(['gamePlayers as total_cups_won' => function ($query) {
                $query->where('position', 1);
            }])
            ->simplePaginate(1);
    }

    public function render()
    {
        return view('livewire.team-index');
    }
}
