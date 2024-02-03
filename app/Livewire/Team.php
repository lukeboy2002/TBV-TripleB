<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Team extends Component
{
    use WithPagination;

    #[Layout('layouts.app')]
    public function render(): View
    {
        $user = User::role('member')
            ->simplePaginate(1);

        return view('livewire.team', [
            'users' => $user
        ]);
    }
}
