<?php

namespace App\Livewire;

use App\Models\Agenda;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class AgendaIndex extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    #[Layout('layouts.app')]
    public function render()
    {
        $agendas = Agenda::query()
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->orderBy('date')
            ->paginate(10);

        return view('livewire.agenda-index', [
            'agendas' => $agendas,
        ])->title('Events');
    }
}
