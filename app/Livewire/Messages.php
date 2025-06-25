<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Messages extends Component
{
    use WithPagination;

    public $activeTab = 'inbox';

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function markAsRead(Message $message)
    {
        if ($message->recipient_id === auth()->id()) {
            $message->markAsRead();
            $this->dispatch('messageRead');
        }
    }

    #[On('messageRead')]
    public function refreshMessages()
    {
        // This method will be called when a message is read
        // The component will be refreshed automatically
    }

    public function render()
    {
        $user = auth()->user();

        $messages = [];

        if ($this->activeTab === 'inbox') {
            $messages = $user->receivedMessages()
                ->with('sender')
                ->latest()
                ->paginate(10);
        } else {
            $messages = $user->sentMessages()
                ->with('recipient')
                ->latest()
                ->paginate(10);
        }

        return view('livewire.messages', [
            'messages' => $messages,
        ]);
    }
}
