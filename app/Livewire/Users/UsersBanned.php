<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UsersBanned extends Component
{
    public function unban(int $userId): void
    {
        $user = User::findOrFail($userId);
        if ($user->is_banned) {
            $user->is_banned = false;
            $user->save();
            // Notify other components to refresh their data
            $this->dispatch('userBannedToggled')->to(UsersIndex::class);
        }
    }

    #[On('userBannedToggled')]
    public function refreshSidebar(): void
    {
        // Trigger re-render
    }

    public function render()
    {
        $bannedUsers = User::banned()->orderBy('username')->get();

        return view('livewire.users.users-banned', [
            'bannedUsers' => $bannedUsers,
        ]);
    }
}
