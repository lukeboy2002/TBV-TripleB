<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginModal extends Component
{
    public bool $showModal = false;

    public bool $showIcon = true;

    public bool $showLabel = false;

    public string $username = '';

    public string $password = '';

    public bool $remember = false;

    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    public function mount($type = 'icon')
    {
        match ($type) {
            'icon' => $this->setIconOnly(),
            'text' => $this->setTextOnly(),
            'both' => $this->setBoth(),
            default => $this->setIconOnly(),
        };
    }

    private function setIconOnly(): void
    {
        $this->showIcon = true;
        $this->showLabel = false;
    }

    private function setTextOnly(): void
    {
        $this->showIcon = false;
        $this->showLabel = true;
    }

    private function setBoth(): void
    {
        $this->showIcon = true;
        $this->showLabel = true;
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

    public function render()
    {
        return view('livewire.auth.login-modal');
    }
}
