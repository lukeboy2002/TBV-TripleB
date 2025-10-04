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

    #[Computed]
    public function currentUser(): ?User
    {
        // current page returns a paginator with 1 item
        return $this->users->first();
    }

    public function mount(): void
    {
        if ($this->currentUser) {
            $this->dispatch('userChanged', id: $this->currentUser->id);
        }
    }

    public function updatedPage(): void
    {
        if ($this->currentUser) {
            $this->dispatch('userChanged', id: $this->currentUser->id);
        }
    }

    public function render()
    {
        return view('livewire.team.team-index');
    }
}
