<x-app-layout title="Edit Album">
    <x-slot name="header">
        <x-heading.main>Bewerk Foto Album</x-heading.main>
    </x-slot>

    <x-heading.sub>Album</x-heading.sub>
    <x-card.default>
        <form action="{{ route('album.update', $album) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @METHOD('PUT')
            <div class="lg:flex gap-8 w-full">
                <div class="flex-row space-y-6 w-full  lg:w-3/4 px-3">
                    <div>
                        <x-form.label for="name" value="{{ __('Album Naam') }}"/>
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
                        <x-heading.sub>Album Foto</x-heading.sub>
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
                    <div class="flex items-center gap-2">
                        <x-form.label for="images" value="Foto's"/>
                        <div class="text-xs text-primary mb-2">(uploaden van meerdere foto's mogelijk)</div>
                    </div>
                    <x-form.input type="file" id="images" name="images[]" multiple accept="image/*"/>
                    <x-form.error for="images" class="mt-2"/>
                    <div id="images-preview" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                </div>
                <div class="sm:col-span-6 pt-5">
                    <x-button.default>Upload</x-button.default>
                </div>
            </form>
            {{--            TODO CHECK DELETE IMAGE--}}
            <div class="my-6">
                <h5 class="font-medium text-primary">Images:</h5>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-x-4 gap-y-8 py-4">
                    @forelse ($photos as $photo)
                        <div class="mb-4">
                            <img class="h-full max-w-full rounded-lg object-cover"
                                 src="{{ $photo->getUrl('thumbnail') }}"
                                 alt="">
                            <div class="flex justify-end mt-2">
                                <livewire:albums.delete-image :album="$album" :image-id="$photo->id"/>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-error">Nog geen foto's in dit album</p>
                    @endforelse
                </div>
            </div>
            <div class="flex justify-end items-center">
                <x-link.button href="{{ route('albums.show', $album) }}">Klaar</x-link.button>
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
                        const imageContainer = document.querySelector('.relative.group');
                        if (imageContainer) {
                            const existingImg = imageContainer.querySelector('img');
                            if (existingImg) {
                                existingImg.src = e.target.result;
                            } else {
                                const newImg = document.createElement('img');
                                newImg.src = e.target.result;
                                newImg.alt = "Preview";
                                newImg.className = "w-full h-48 object-cover rounded-lg";
                                imageContainer.insertBefore(newImg, imageContainer.firstChild);
                            }
                        }
                    }
                    reader.readAsDataURL(file);
                }
            }

            // Multiple images preview for Add Images section
            document.addEventListener('DOMContentLoaded', function () {
                const input = document.getElementById('images');
                const preview = document.getElementById('images-preview');
                if (!input || !preview) return;

                const renderPreviews = (files) => {
                    preview.innerHTML = '';
                    if (!files || files.length === 0) return;

                    Array.from(files).forEach((file) => {
                        if (!file.type.startsWith('image/')) return;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const wrapper = document.createElement('div');
                            wrapper.className = 'relative';
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = file.name;
                            img.className = 'w-full h-36 object-cover rounded-lg shadow';
                            wrapper.appendChild(img);
                            preview.appendChild(wrapper);
                        };
                        reader.readAsDataURL(file);
                    });
                };

                input.addEventListener('change', (e) => {
                    renderPreviews(e.target.files);
                });
            });
        </script>
    @endpush
</x-app-layout>