<x-app-layout title="Edit Album">
    <x-heading.main>Album edit</x-heading.main>

    <x-heading.sub>Album</x-heading.sub>
    <x-card.default>
        <form action="{{ route('album.update', $album) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @METHOD('PUT')
            <div class="lg:flex gap-8 w-full">
                <div class="flex-row space-y-6 w-full  lg:w-3/4 px-3">
                    <div>
                        <x-form.label for="name" value="{{ __('Name') }}"/>
                        <x-form.input id="name"
                                      name="name"
                                      type="text"
                                      class="block w-full"
                                      :value="old('name') ?? $album->name"
                                      required
                                      autofocus
                        />
                        <x-form.error for="name"/>
                    </div>
                </div>
                <aside class="w-full space-y-4 lg:w-1/4 flex-col pt-4 px-3 gap-4">
                    <div>
                        <x-heading.sub>Album Image</x-heading.sub>
                        <div class="relative group">
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
                            <x-form.error for="image" class="mt-2"/>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="flex justify-end mt-4">
                <x-button.default>Save</x-button.default>
            </div>
        </form>
    </x-card.default>

    <div class="mt-6">
        <x-heading.sub>Add Images</x-heading.sub>
        <x-card.default>
            <form method="POST" action="{{ route('album.upload', $album->slug) }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <x-form.label for="image" value="Image"/>
                    <x-form.input type="file" id="image" name="image"/>
                    <x-form.error for="image" class="mt-2"/>
                </div>
                <div class="sm:col-span-6 pt-5">
                    <x-button.default>Upload</x-button.default>
                </div>
            </form>

            <div class="my-6">
                <h5 class="font-medium text-primary">Images:</h5>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-x-4 gap-y-8 py-4">
                    @forelse ($photos as $photo)
                        <div>
                            <img class="h-full max-w-full rounded-lg object-cover"
                                 src="{{ $photo->getUrl('thumbnail') }}"
                                 alt="">
                            <div class="flex justify-end mt-2">
                                <form method="POST"
                                      action="{{ route('album.image.destroy', [$album->id, $photo->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-button.default class="px-3 py-2 text-xs font-medium">Delete</x-button.default>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-error">No images yet.</p>
                    @endforelse
                </div>
            </div>
            <div class="flex justify-end items-center">
                <x-link.button href="{{ route('albums.show', $album) }}">Ready</x-link.button>
            </div>
        </x-card.default>
    </div>
    @push('scripts')

        <script>
            function previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        // Target the specific image container
                        const imageContainer = document.querySelector('.relative.group');
                        if (imageContainer) {
                            // Check if there's already an image
                            const existingImg = imageContainer.querySelector('img');
                            if (existingImg) {
                                // Update existing image
                                existingImg.src = e.target.result;
                            } else {
                                // Create new image if none exists
                                const newImg = document.createElement('img');
                                newImg.src = e.target.result;
                                newImg.alt = "Preview";
                                newImg.className = "w-full h-48 object-cover rounded-lg";
                                // Insert the new image at the beginning of the container
                                imageContainer.insertBefore(newImg, imageContainer.firstChild);
                            }
                        }
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>
    @endpush
</x-app-layout>