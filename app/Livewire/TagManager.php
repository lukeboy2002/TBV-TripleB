<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class TagManager extends Component
{
    public Model $model;

    public string $newTag = '';

    public array $tags = [];

    public function mount(Model $model)
    {
        $this->model = $model;
        $this->refreshTags();
    }

    public function refreshTags()
    {
        $this->tags = $this->model->tags->pluck('name')->toArray();
    }

    public function addTag()
    {
        $tagName = trim($this->newTag);

        if (! $this->model->exists) {
            $this->dispatch('notify', [
                'message' => 'Post moet eerst worden opgeslagen voordat tags kunnen worden toegevoegd.',
                'type' => 'warning',
            ]);

            return;
        }

        if ($tagName && ! in_array($tagName, $this->tags)) {
            $this->model->attachTag($tagName);
            $this->newTag = '';
            $this->refreshTags();
        }
    }

    public function removeTag($tagName)
    {
        $this->model->detachTag($tagName);
        $this->refreshTags();
    }

    public function render()
    {
        return view('livewire.tag-manager');
    }
}
