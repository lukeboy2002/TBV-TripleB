<?php

namespace App\Livewire\Games;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class PlayerStats extends Component
{
    #[Url(history: true)]
    public $sortBy = 'username';

    #[Url(history: true)]
    public $sortDir = 'ASC';

    // Mapping between view column names and database column aliases
    protected $columnMap = [
        'played' => 'total_games_played',
        'points' => 'total_points',
        'avg' => 'average_points',
        'won' => 'total_games_won',
        'cup' => 'total_cups_won',
        'username' => 'username',
    ];

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';

            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'ASC';
    }

    //    #[On('game-completed')]
    //    public function refreshStats()
    //    {
    //        // This method will be called when a game is completed
    //        // The component will automatically refresh and reload the player statistics
    //    }

    #[On('game-completed')]
    public function render()
    {
        // Map the sort field to the correct database column
        $sortField = $this->columnMap[$this->sortBy] ?? $this->sortBy;

        $players = User::role('member')
            ->with('profile')
            ->withCount(['gamePlayers as total_games_played'])
            ->withSum('gamePlayers as total_points', 'points')
            ->withAvg('gamePlayers as average_points', 'points')
            ->withCount(['gamePlayers as total_games_won' => function ($query) {
                $query->where('is_winner', true);
            }])
            ->withCount(['gamePlayers as total_cups_won' => function ($query) {
                $query->where('position', 1);
            }])
            ->orderBy($sortField, $this->sortDir)
            ->get();

        return view('livewire.games.player-stats', [
            'players' => $players,
        ]);
    }
}
