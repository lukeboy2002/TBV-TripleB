<?php

namespace App\Livewire\Actions;

use App\Models\Agenda;
use Livewire\Component;

class AgendaActions extends Component
{
    public Agenda $agenda;

    public bool $showModal = false;

    public function mount(Agenda $agenda)
    {
        $this->showModal = false;
        $this->agenda = $agenda;
    }

    public function deleteAgenda()
    {
        $this->authorize('delete', $this->agenda);

        $this->showModal = true;
        $this->agenda->delete();

        session()->flash('success', 'The Agenda has been deleted');

        $this->redirect(route('agenda.index'));
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function render()
    {
        return view('livewire.actions.agenda-actions');
    }
}
