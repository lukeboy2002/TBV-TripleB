<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Component;

class CategoryList extends Component
{
    public function render()
    {
        $categories = Category::withCount('posts')->get();

        return view('livewire.category-list', [
            'categories' => $categories,
        ]);
    }

    #[On('category-created')]
    public function refreshList(): void
    {
        // Simply re-render
    }
}
