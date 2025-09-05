<?php

namespace App\Livewire\Profile;

use App\Models\Profile;
use Auth;
use Livewire\Component;

class UpdateProfileBioForm extends Component
{
    public $city;

    public $biography;

    public function mount()
    {
        $profile = Auth::user()->profile;

        if ($profile) {
            $this->city = $profile->city;
            $this->biography = $profile->biography;
        } else {
            $this->biography = $this->biography ?? '';
        }

        // Ensure editor gets initial value
        $this->dispatch('refresh-biography', $this->biography);
    }

    public function updateProfileBio()
    {
        $this->validate([
            'city' => 'nullable|string|max:255',
            'biography' => 'nullable|min:10',
        ]);

        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'city' => $this->city,
                'biography' => $this->biography,
            ]
        );

        // Jetstream-style action message
        $this->dispatch('saved');
        // Update editor content if needed
        $this->dispatch('refresh-biography', $this->biography);
        session()->flash('message', 'Profielinformatie opgeslagen!');
    }

    public function render()
    {
        return view('profile.update-profile-bio-form');
    }
}
