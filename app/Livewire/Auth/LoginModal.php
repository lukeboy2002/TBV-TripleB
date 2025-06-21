<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticationProvider;
use Livewire\Component;

class LoginModal extends Component
{
    public bool $showModal = false;

    public bool $showIcon = true;

    public bool $showLabel = false;

    public string $username = '';

    public string $password = '';

    public bool $remember = false;

    public bool $showingTwoFactorForm = false;

    public string $code = '';

    public bool $recovery = false;

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

    public function verifyTwoFactorCode()
    {
        if (! $this->showingTwoFactorForm) {
            return;
        }

        $this->validate([
            'code' => 'required|string',
        ]);

        $userId = session()->get('login.id');

        if (! $userId) {
            $this->addError('code', __('Invalid login session. Please try again.'));

            return;
        }

        $user = User::find($userId);

        if (! $user) {
            $this->addError('code', __('Invalid login session. Please try again.'));

            return;
        }

        $provider = app(TwoFactorAuthenticationProvider::class);

        if ($this->recovery) {
            // Verify recovery code
            if (! $provider->validRecoveryCode($user, $this->code)) {
                $this->addError('code', __('The provided recovery code is invalid.'));

                return;
            }

            $provider->invalidateRecoveryCode($user, $this->code);
        } else {
            // Verify authentication code
            if (! $provider->verify(decrypt($user->two_factor_secret), $this->code)) {
                $this->addError('code', __('The provided two-factor authentication code is invalid.'));

                return;
            }
        }

        // Clear the session
        session()->forget('login.id');

        // Log the user in
        Auth::login($user, session()->pull('login.remember', false));

        // Close the modal and redirect
        $this->toggleModal();

        return redirect()->intended();
    }

    public function login()
    {
        $this->validate();

        // Reset the 2FA form state
        $this->showingTwoFactorForm = false;
        $this->code = '';
        $this->recovery = false;

        // Check if the credentials are valid
        if (Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            // Check if the user has 2FA enabled
            $user = Auth::user();

            if ($user && $user->two_factor_secret) {
                // User has 2FA enabled, show the 2FA form
                Auth::logout();

                // Store the credentials in the session for later use
                session()->put([
                    'login.id' => $user->getKey(),
                    'login.remember' => $this->remember,
                ]);

                $this->showingTwoFactorForm = true;
            } else {
                // User doesn't have 2FA enabled, proceed with login
                $this->toggleModal();

                return redirect()->intended();
            }
        } else {
            $this->addError('login', __('auth.failed'));
        }
    }

    public function toggleModal()
    {
        $this->showModal = ! $this->showModal;
    }

    public function toggleRecoveryMode()
    {
        $this->recovery = ! $this->recovery;
        $this->code = '';
    }

    public function render()
    {
        return view('livewire.auth.login-modal');
    }
}
