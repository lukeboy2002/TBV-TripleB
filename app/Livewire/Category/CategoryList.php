<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryList extends Component
{
    protected $listeners = [
        'category-created' => 'refreshCategories',
    ];

    public function render()
    {
        $categories = Category::withCount('posts')->get();

        return view('livewire.category.category-list', [
            'categories' => $categories,
        ]);
    }
}
