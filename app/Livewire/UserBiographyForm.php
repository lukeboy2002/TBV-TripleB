<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserBiographyForm extends Component
{
    use WithFileUploads;

    public User $user;

    #[Validate('required|min:5')]
    public string $biography = '';

    public function mount(User $user)
    {
        $this->biography = $user->biography;
    }

    public function render(): View
    {
        return view('profile.user-biography-form');
    }

    public function save(): void
    {
        $this->validate();

        $user = current_user();
        $user->biography = $this->biography;
        $user->save();

        session()->flash('success_small', 'User has been updated');
    }
}
