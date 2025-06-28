<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\User;
use Livewire\Component;

class Chat extends Component
{
    public $users;

    public $selectedUser;

    public $newMessage;

    public $messages;

    public $loginID;

    public function mount()
    {
        $this->users = User::whereNotIn('id', [auth()->id(), 1])->get();
        $this->selectedUser = $this->users->first();
        $this->loadMessages();
        $this->loginID = auth()->id();
    }

    public function LoadMessages()
    {
        $this->messages = ChatMessage::query()
            ->where(function ($q) {
                $q->where('sender_id', auth()->id())
                    ->where('receiver_id', $this->selectedUser->id);
            })
            ->orWhere(function ($q) {
                $q->where('sender_id', $this->selectedUser->id)
                    ->where('receiver_id', auth()->id());
            })
            ->get();
    }

    public function selectUser($id): void
    {
        $this->selectedUser = User::find($id);
        $this->loadMessages();
    }

    public function sentMessage()
    {
        if (! $this->newMessage) {
            return;
        }

        $message = ChatMessage::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $this->selectedUser->id,
            'message' => $this->newMessage,
        ]);

        $this->messages->push($message);

        $this->newMessage = '';

        broadcast(new MessageSent($message));
    }

    public function getListeners()
    {
        return [
            "echo-private:chat.{$this->loginID},MessageSent" => 'newChatMessageNotification',
        ];

    }

    public function newChatMessageNotification($message)
    {
        if ($message['sender_id'] == $this->selectedUser->id) {
            $messageObj = ChatMessage::find($message['id']);
            $this->messages->push($messageObj);
        }
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
