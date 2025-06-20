<?php

namespace App\Livewire;

use Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileEdit extends Component
{
    use WithFileUploads;

    public $state = [];

    public $cover;

    public function mount()
    {
        $profile = Auth::user()->profile;

        if ($profile) {
            $this->state = $profile->toArray();
        }
    }

    /**
     * Methode om het profiel bij te werken.
     */
    public function updateProfile()
    {
        $this->validate();

        $profile = Auth::user()->profile;

        if ($profile) {
            // Handle cover image upload if present
            if ($this->cover) {
                $this->state['cover_path'] = $this->cover->store('covers', 'public');
            }

            $profile->update($this->state);
        }

        // Succesboodschap aan de gebruiker
        session()->flash('status', 'Profiel bijgewerkt!');

        // Emit saved event for action message
        $this->dispatch('saved');
    }

    /**
     * Method to delete the cover photo.
     */
    public function deleteCoverPhoto()
    {
        $profile = Auth::user()->profile;

        if ($profile && $profile->cover_path && $profile->cover_path != 'covers/default.png') {
            // Delete the file from storage
            if (Storage::disk('public')->exists($profile->cover_path)) {
                Storage::disk('public')->delete($profile->cover_path);
            }

            // Update the profile with the default cover
            $profile->update(['cover_path' => 'covers/default.png']);
            $this->state['cover_path'] = 'covers/default.png';
        }

        session()->flash('status', 'Cover photo removed!');

        // Emit saved event for action message
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('profile.profile-edit');
    }

    /**
     * Validatie regels voor profielvelden.
     */
    protected function rules(): array
    {
        return [
            'state.city' => 'nullable|string|max:255',
            'state.biography' => 'nullable|string',
            'state.birthday' => 'nullable|date',
            'state.phone_number' => 'nullable|string|max:20',
            'cover' => 'nullable|image|max:2048',
        ];
    }
}
