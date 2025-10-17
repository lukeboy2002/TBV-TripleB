<div class="max-w-3xl mx-auto space-y-6">
    <h1 class="text-2xl font-bold">Blogbericht bewerken</h1>

    <form wire:submit.prevent="update" class="space-y-4">
        <div>
            <label>Titel</label>
            <input type="text" wire:model="title" class="w-full border rounded p-2">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Slug</label>
            <input type="text" wire:model="slug" class="w-full border rounded p-2">
        </div>

        <div>
            <label>Categorie</label>
            <select wire:model="category_id" class="w-full border rounded p-2">
                <option value="">-- kies categorie --</option>
                @foreach($allCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Tags</label>
            <input type="text"
                   wire:model.lazy="tags"
                   placeholder="Gebruik komma's om te scheiden (bijv. Laravel,PHP)"
                   class="w-full border rounded p-2">

            <small class="text-gray-500">Voeg meerdere tags toe door komma’s te gebruiken.</small>

            @if($tags)
                <div class="mt-2 flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-sm">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        <div>
            <label>Huidige afbeelding</label>
            @if($featured_image)
                <img src="{{ Storage::url($featured_image) }}" class="mt-2 w-40 rounded shadow">
            @else
                <p class="text-gray-500">Geen afbeelding</p>
            @endif
        </div>

        <div>
            <label>Nieuwe afbeelding</label>
            <input type="file" wire:model="new_featured_image" class="w-full border rounded p-2">
            @if ($new_featured_image)
                <img src="{{ $new_featured_image->temporaryUrl() }}" class="mt-2 w-40 rounded">
            @endif
        </div>

        <div>
            <label>Inhoud</label>
            <livewire:editor wire:model="content"/>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center space-x-2">
            <input type="checkbox" wire:model="is_featured" id="featured">
            <label for="featured">Uitgelicht</label>
        </div>

        <div>
            <label>Publicatiedatum</label>
            <input type="date" wire:model="published_at" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Wijzigingen opslaan
        </button>
    </form>
</div>
