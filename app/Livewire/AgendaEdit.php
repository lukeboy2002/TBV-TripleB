<?php

namespace App\Livewire;

use App\Models\Agenda;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class AgendaEdit extends Component
{
    use WithFileUploads;

    public Agenda $agenda;

    public $name = '';

    public $description = '';

    public $date = '';

    public $image = null;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable',
        'date' => 'required|date',
        'image' => 'nullable|image|max:1024',
    ];

    public function mount(Agenda $agenda)
    {
        $this->authorize('update', $agenda);

        $this->agenda = $agenda;
        $this->name = $agenda->name;
        $this->description = $agenda->description;
        $this->date = $agenda->date ? $agenda->date->format('Y-m-d\TH:i') : '';
    }

    public function update()
    {
        $this->authorize('update', $this->agenda);

        $this->validate();

        $imagePath = $this->agenda->image_path;
        if ($this->image) {
            $imagePath = $this->image->store('agenda-images', 'public');
        }

        $this->agenda->update([
            'name' => $this->name,
            'description' => $this->description,
            'date' => $this->date,
            'image_path' => $imagePath,
        ]);

        // Success message for the user
        session()->flash('message', 'Event updated successfully!');

        // Emit saved event for action message
        $this->dispatch('saved');

        return redirect()->route('agenda.index');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.agenda-edit')->title('Edit Event');
    }
}
