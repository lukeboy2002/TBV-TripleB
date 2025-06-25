<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class UnreadMessageCount extends Component
{
    #[On('messageRead')]
    public function refresh()
    {
        // This method will be called when a message is read
        // The component will be refreshed automatically
    }

    public function render()
    {
        $count = auth()->check() ? auth()->user()->unreadMessagesCount() : 0;

        return view('livewire.unread-message-count', [
            'count' => $count,
        ]);
    }
}
