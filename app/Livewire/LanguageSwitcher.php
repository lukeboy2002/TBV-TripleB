<?php

namespace App\Livewire;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public string $locale;

    public function mount()
    {
        $this->locale = Session::get('locale', config('app.locale'));
    }

    public function switchLanguage(string $locale)
    {
        if (! in_array($locale, ['nl', 'en'])) {
            return;
        }

        $this->locale = $locale;
        Session::put('locale', $locale);
        App::setLocale($locale);

        // Dit zorgt ervoor dat de tekst in Livewire direct opnieuw gerenderd wordt
        $this->dispatch('language-changed', locale: $locale);
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
