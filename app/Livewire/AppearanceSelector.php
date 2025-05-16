<?php

namespace App\Livewire;

use Livewire\Component;

class AppearanceSelector extends Component
{
    public string $appearance = 'system';

    public function mount()
    {
        $this->appearance = session('appearance', 'system');
    }

    public function updateAppearance($value)
    {
        $this->appearance = $value;
        session(['appearance' => $value]);
        $this->dispatch('appearance-changed', appearance: $value);
    }

    public function render()
    {
        return view('livewire.appearance-selector');
    }
}
