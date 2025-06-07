<?php

namespace App\View\Components;

use App\Models\GamePlayer;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class latestCupWinnerImage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $winner = GamePlayer::where('cup_photo_path', '!=', null)->latest()->first();

        return view('components.latest-cup-winner-image', [
            'winner' => $winner,
        ]);
    }
}
