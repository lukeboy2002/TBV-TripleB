<?php

namespace App\Livewire\Events;

use App\Mail\NewEvent;
use App\Models\Event;
use App\Models\User;
use App\Support\ImageCompressor;
use ArrayAccess;
use Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EventCreate extends Component
{
    use WithFileUploads;

    #[Rule('required|string|max:100')]
    public $title;

    #[Rule('required|max:100')]
    public string $slug;

    #[Rule('required|min:10|max:255')]
    public $description;

    #[Rule('required|min:10')]
    public $body;

    #[Rule('nullable|image|max:10240|mimes:jpg,jpeg,png,webp,heic,heif')]
    public $image_path;

    #[Rule('required|date')]
    public $date;

    #[Rule('nullable|date')]
    public $end_date;

    public $private = true;

    public $tags = [];

    public function updatedTitle(): void
    {
        $this->slug = SlugService::createSlug(Event::class, 'slug', $this->title);
    }

    public function save()
    {
        $path = $this->image_path
            ? $this->image_path->store('events', 'public')
            : null;

        if ($path) {
            // Compress to <= 1.1 megabytes (MB)
            $absolute = storage_path('app/public/'.$path);
            ImageCompressor::compressToMaxBytes($absolute, 1024_000);
        }

        $event = Event::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'body' => $this->body,
            'image_path' => $path,
            'private' => true,
            'date' => $this->date,
            'end_date' => $this->end_date,
            'user_id' => auth()->id(),
        ]);

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
            $event->attachTags($tags);
        }

        //        // Send notification to all users with the 'member' role
        $members = User::role('member')->get();
        foreach ($members as $member) {
            Mail::to($member->email)->send(new NewEvent($event, Auth::user()->username));
        }

        flash()->success('Event successfully created');
        $this->dispatch('event-created');

        return redirect()->route('events.index');
    }

    public function render()
    {
        return view('livewire.events.event-create');
    }
}
