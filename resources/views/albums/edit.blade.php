<x-app-layout title="Edit Album">
    <x-tbv-heading_h3>Edit Album</x-tbv-heading_h3>

    <div class="bg-background/80 items-center justify-between max-w-7xl mx-auto p-4 rounded-lg w-full">

        <form action="{{ route('admin.albums.update', $album->id) }}" method="POST" enctype="multipart/form-data"
              class="block md:flex justify-between w-full gap-6">
            @csrf
            @method('PUT')
            <div class="relative group mt-4">
                @if($album->image)
                    <img src="{{ asset($album->image) }}"
                         alt="{{ $album->name }}"
                         class="w-full h-48 object-cover rounded-lg"
                    />
                @endif

                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <label for="image"
                           class="cursor-pointer bg-background/80 text-primary hover:bg-secondary hover:text-white px-4 py-2 rounded-lg">
                        <span>change</span>
                        <input type="file"
                               id="image"
                               name="image"
                               class="hidden"
                               accept="image/*"
                               onchange="previewImage(event)"
                        />
                    </label>
                </div>
            </div>
            <div class="w-full">
                <div class="mt-4">
                    <x-tbv-label for="name" value="{{ __('Name') }}"/>
                    <x-tbv-input id="name" class="w-full" type="text" name="name"
                                 value="{{ old('name', $album->name) }}"
                                 required autocomplete="name"/>
                    <x-tbv-input-error for="name" class="mt-2"/>
                </div>
                <div class="mt-4">
                    <x-tbv-label for="description" value="{{ __('Description') }}"/>
                    <x-tbv-input id="description" class="w-full" type="text" name="description"
                                 value="{{ $album->description }}"/>
                    <x-tbv-input-error for="description" class="mt-2"/>
                </div>
                <div class="flex justify-end mt-4">
                    <x-tbv-button type="submit">
                        <x-lucide-image class="h-4 w-4 mr-2"/>
                        Update Album
                    </x-tbv-button>
                </div>
            </div>

        </form>
    </div>
</x-app-layout>