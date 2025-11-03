<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $search = '';

    #[Url(history: true)]
    public $sortBy = 'username';

    #[Url(history: true)]
    public $sortDir = 'ASC';

    public $user;

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';

            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function toggleBan(int $userId): void
    {
        $user = User::findOrFail($userId);
        $user->is_banned = ! $user->is_banned;
        $user->save();

        // Notify other components (like UsersBanned) to refresh
        $this->dispatch('userBannedToggled')->to(UsersBanned::class);
    }

    #[On('userBannedToggled')]
    public function refreshUsers(): void
    {
        // No-op: Livewire will re-render after this method.
    }

    public function render()
    {
        $users = User::search($this->search)
            ->with('roles', 'permissions')
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate(10);

        return view('livewire.users.users-index', [
            'users' => $users,
        ]);
    }
}
