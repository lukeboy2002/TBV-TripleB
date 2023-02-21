<?php

namespace App\View\Components;

use App\Models\Sponsor;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sponsors extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sponsors = Sponsor::where('is_published', 1)->limit(5)->get();

        return view('components.sponsors', [
            'sponsors' => $sponsors,
        ]);

        return view('components.sponsors');
    }
}
