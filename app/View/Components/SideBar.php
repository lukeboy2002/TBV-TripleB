<?php

namespace App\View\Components;

use App\Models\Contact;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBar extends Component
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

        $totalContacts = Contact::where('active' ,1)->get();

        return view('components.menus.admin-sidebar', [
            'totalContacts' => $totalContacts
        ]);
    }
}
