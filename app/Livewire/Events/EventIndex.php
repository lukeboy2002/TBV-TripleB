<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class EventIndex extends Component
{
    use WithPagination;

    public Event $event;

    public bool $showModal = false;

    protected $listeners = [
        'event-created' => 'refreshEvents',
        'event-deleted' => 'refreshEvents',
    ];

    public function mount(Event $event)
    {
        $this->showModal = false;
        $this->event = $event;
    }

    #[Computed]
    public function events()
    {
        return Event::with('user')
            ->where('date', '>=', now()->startOfDay())
            ->orderBy('date')
            ->paginate(6);
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function render()
    {
        return view('livewire.events.event-index');
    }
}
