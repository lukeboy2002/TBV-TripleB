<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;

    #[Url(history: true)]
    public $sortBy = 'name';

    #[Url(history: true)]
    public $sortDir = 'DESC';

    public $category;

    protected $listeners = [
        'category-created' => 'refreshCategories',
    ];

    public function setSortBy($sortByField)
    {

        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';

            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        $categories = Category::withCount('posts')
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate(5);

        return view('livewire.category.category-index', [
            'categories' => $categories,
        ]);
    }
}
