<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class PlayerStats extends Component
{
    use WithPagination;

    public $sortField = 'total_points';

    public $sortDirection = 'desc';

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $players = User::role('member')
            ->withCount(['gamePlayers as total_games_played'])
            ->withSum('gamePlayers as total_points', 'points')
            ->withCount(['gamePlayers as total_games_won' => function ($query) {
                $query->where('is_winner', true);
            }])
            ->withCount(['gamePlayers as total_cups_won' => function ($query) {
                $query->where('position', 1);
            }])
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.player-stats', [
            'players' => $players,
        ]);
    }
}
