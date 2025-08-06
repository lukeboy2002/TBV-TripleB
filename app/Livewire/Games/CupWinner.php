<?php

namespace App\Livewire\Games;

use App\Models\GamePlayer;
use Livewire\Component;

class CupWinner extends Component
{
    // Listen for the cup-photo-uploaded event from GamesManager
    protected $listeners = ['cup-photo-uploaded' => '$refresh'];

    public function render()
    {
        $winner = GamePlayer::where('cup_photo_path', '!=', null)
            ->latest()
            ->first();

        return view('livewire.games.cup-winner', [
            'winner' => $winner,
        ]);
    }
}
