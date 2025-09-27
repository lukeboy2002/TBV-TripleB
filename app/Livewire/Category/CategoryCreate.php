<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CategoryCreate extends Component
{
    public string $name = '';

    public string $color = 'default';

    public string $description = '';

    public array $availableColors = [
        'default', 'blue', 'gray', 'red', 'green', 'yellow', 'indigo', 'pink',
    ];

    public function createCategory()
    {
        $this->validate();

        $category = Category::create([
            'name' => $this->name,
            'slug' => str($this->name)->slug(),
            'color' => $this->color,
            'description' => $this->description,
        ]);

        $this->dispatch('category-created', id: $category->id);

        $this->reset(['name', 'description']);

        flash()->success('Category created successfully');
    }

    public function render()
    {
        return view('livewire.category.category-create');
    }

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')],
            'color' => ['required', Rule::in($this->availableColors)],
            'description' => ['nullable', 'string'],
        ];
    }
}
