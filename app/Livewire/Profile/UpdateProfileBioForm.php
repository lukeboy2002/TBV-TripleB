<?php

namespace App\Livewire\Profile;

use App\Models\Profile;
use Auth;
use Livewire\Component;

class UpdateProfileBioForm extends Component
{
    public $city;

    public $body;

    public function mount()
    {
        $profile = Auth::user()->profile;

        if ($profile) {
            $this->city = $profile->city;
            $this->body = $profile->body;
        } else {
            $this->body = $this->body ?? '';
        }

        // Ensure editor gets initial value
        $this->dispatch('refresh-biography', $this->body);
    }

    public function updateProfileBio()
    {
        $this->validate([
            'city' => 'nullable|string|max:255',
            'body' => 'nullable|min:10',
        ]);

        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'city' => $this->city,
                'body' => $this->body,
            ]
        );

        // Jetstream-style action message
        $this->dispatch('saved');
        // Update editor content if needed
        $this->dispatch('refresh-biography', $this->body);
        session()->flash('message', __('Profile information saved'));
    }

    public function render()
    {
        return view('profile.update-profile-bio-form');
    }
}
