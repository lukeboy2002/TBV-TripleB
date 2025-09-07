<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
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
            'color' => $this->color,
            'description' => $this->description,
        ]);

        $this->dispatch('category-created', id: $category->id);

        // Reset simple fields but keep color selection
        $this->reset(['name', 'description']);

        session()->flash('status', 'Category created successfully');
    }

    public function render()
    {
        return view('livewire.categories.create');
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
