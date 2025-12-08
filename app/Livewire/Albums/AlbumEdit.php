<?php

namespace App\Livewire\Albums;

use App\Models\Album;
use ArrayAccess;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Storage;
use Throwable;

class AlbumEdit extends Component
{
    use WithFileUploads;

    public Album $album;

    public $title;

    public $slug;

    public $body;

    public $image_path;

    public $new_image_path;

    /**
     * Additional images for the album (Spatie media library collection "albums").
     * Bound to the multiple file input in the edit view.
     *
     * @var array<int, TemporaryUploadedFile>
     */
    public $uploads = [];

    public $tags = [];

    public function mount(Album $album): void
    {
        $this->album = $album;
        $this->title = $album->title;
        $this->slug = $album->slug;
        $this->body = $album->body;
        $this->image_path = $album->image_path;
        $this->tags = $album->tags->pluck('name')->toArray();
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            // Ensure we validate against the correct table name "albums"
            'slug' => 'required|unique:albums,slug,'.$this->album->id,
            'body' => 'nullable|max:255',
            'new_image_path' => 'nullable|image|max:2048',
            'uploads' => 'nullable|array',
            'uploads.*' => 'image|max:4096',
        ]);

        // Keep the current stored path so we can delete it later if replaced
        $oldPath = $this->album->image_path; // string or null

        // If a new image was uploaded, store it and update the property
        if ($this->new_image_path) {
            // Store uploads in the same directory as creation flow ("albums")
            $newPath = $this->new_image_path->store('albums', 'public');
            $this->image_path = $newPath; // will be written to DB below
        }

        $this->album->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'image_path' => $this->image_path,
        ]);

        // Attach any newly uploaded additional images to the media collection
        if (! empty($this->uploads)) {
            foreach ($this->uploads as $upload) {
                // Mirror creation flow: pass TemporaryUploadedFile directly
                $this->album
                    ->addMedia($upload)
                    ->usingFileName($upload->getClientOriginalName())
                    ->toMediaCollection('albums');
            }
            // Clear temporary uploads from state
            $this->reset('uploads');
        }

        // If a new file replaced an existing one, delete the old file from storage
        if ($this->new_image_path && $oldPath && $oldPath !== $this->image_path) {
            try {
                Storage::disk('public')->delete($oldPath);
            } catch (Throwable $e) {
                // Optional: log the failure instead of throwing
                // logger()->warning('Failed to delete old post image', ['path' => $oldPath, 'error' => $e->getMessage()]);
            }
        }

        // Tags synchroniseren
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

        $this->album->syncTags($tags);

        flash()->success(__('Album successfully updated!'));

        // Keep route name consistent with creation redirect
        return redirect()->route('albums.index');
    }

    public function render()
    {
        return view('livewire.albums.album-edit');
    }
}
