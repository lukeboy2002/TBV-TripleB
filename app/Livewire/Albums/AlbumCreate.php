<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use App\Support\ImageCompressor;
use ArrayAccess;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AlbumCreate extends Component
{
    use WithFileUploads;

    #[Rule('required|string|max:100')]
    public $title;

    #[Rule('required|max:100')]
    public string $slug;

    #[Rule('nullable|max:255')]
    public $body;

    #[Rule('nullable|image|max:2048')]
    public $image_path;

    #[Rule(['uploads' => 'required', 'uploads.*' => 'image|max:10240|mimes:jpg,jpeg,png,webp,heic,heif'])]
    public array $uploads = [];

    public $tags = [];

    public function updatedTitle(): void
    {
        $this->slug = SlugService::createSlug(Album::class, 'slug', $this->title);
    }

    public function save()
    {

        $path = $this->image_path
            ? $this->image_path->store('albums', 'public')
            : null;

        if ($path) {
            // Compress the stored cover image to <= 500KB
            $absolute = storage_path('app/public/'.$path);
            ImageCompressor::compressToMaxBytes($absolute, 512_000);
        }

        $album = Album::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'image_path' => $path,
            'user_id' => auth()->id(),
        ]);

        foreach ($this->uploads as $file) {
            // Spatie + Livewire integration
            // We don't have Media Library Pro's addMediaFromLivewire here.
            // Livewire's TemporaryUploadedFile is an instance of Symfony UploadedFile,
            // which Spatie's addMedia() supports directly.
            $album
                ->addMedia($file)
                ->usingFileName($file->getClientOriginalName())
                ->toMediaCollection('albums');
        }

        // Normalize tags input to an array for Spatie Tags
        $tags = $this->tags;
        if (is_string($tags)) {
            // Split by commas/semicolons/pipes, trim each, and remove empties
            $tags = array_filter(array_map(static fn ($t) => trim($t), preg_split('/[,;|]+/', $tags)));
        }
        if ($tags instanceof ArrayAccess) {
            $tags = (array) $tags;
        }
        if (! is_array($tags) && ! empty($tags)) {
            $tags = [$tags];
        }
        $tags = array_values(array_filter($tags, static fn ($t) => is_string($t) && $t !== ''));

        if (! empty($tags)) {
            $album->attachTags($tags);
        }

        flash()->success(__('The album is created'));

        $this->dispatch('album-created');

        return redirect()->route('albums.index');
    }

    public function render()
    {
        return view('livewire.albums.album-create');
    }
}
