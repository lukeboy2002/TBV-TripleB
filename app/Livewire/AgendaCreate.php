<?php

namespace App\Livewire;

use App\Mail\NewEvent;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class AgendaCreate extends Component
{
    use WithFileUploads;

    public $name = '';

    public $description = '';

    public $date = '';

    public $image = null;

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable',
        'date' => 'required|date|after:now',
        'image' => 'nullable|image|max:1024',
    ];

    public function save()
    {
        $this->authorize('create', Agenda::class);

        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('agenda-images', 'public');
        }

        $agenda = Agenda::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'description' => $this->description,
            'date' => $this->date,
            'image_path' => $imagePath,
        ]);

        $this->reset(['name', 'description', 'date', 'image']);

        $this->dispatch('agenda-created', $agenda->id);

        // Send notification to all users with the 'member' role
        $members = User::role('member')->get();
        foreach ($members as $member) {
            Mail::to($member->email)->send(new NewEvent($agenda, Auth::user()->username));
        }

        session()->flash('message', 'Appointment created successfully!');

        return redirect()->route('agenda.index');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.agenda-create')->title('Create event');
    }
}
