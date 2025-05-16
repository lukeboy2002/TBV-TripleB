<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginModal extends Component
{
    public bool $showModal = false;

    public string $username = '';

    public string $password = '';

    public bool $remember = false;

    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    public function mount()
    {
        $this->showModal = false;
    }

    public function login()
    {
        $this->validate();

        // Login logica hier
        if (Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            $this->toggleModal();

            return redirect()->intended();
        }

        $this->addError('login', __('auth.failed'));
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }
}
