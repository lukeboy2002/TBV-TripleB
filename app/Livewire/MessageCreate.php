<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MessageCreate extends Component
{
    public bool $showModal = false;

    public User $recipient;

    #[Validate('required|min:3|max:500')]
    public string $messageContent = '';

    public function mount(User $user)
    {
        $this->recipient = $user;
    }

    public function sendMessage()
    {
        $this->validate();

        $sender = auth()->user();
        if (! $sender) {
            return $this->redirect('/login');
        }

        $message = Message::create([
            'user_id' => $sender->id,
            'recipient_id' => $this->recipient->id,
            'content' => $this->messageContent,
            'is_read' => false,
        ]);

        // Send notification to recipient
        $this->recipient->notify(new NewMessageNotification($message));

        // Reset form and close modal
        $this->reset('messageContent');
        $this->toggleModal();

        // Flash success message
        session()->flash('message', 'Message sent successfully!');
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;

        if ($this->showModal === false) {
            $this->reset('messageContent');
        }
    }

    public function render()
    {
        return view('livewire.message-create');
    }
}
