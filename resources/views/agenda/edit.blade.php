<x-app-layout title="Edit Event">
    <x-slot name="header">
        <x-heading.main>Edit Event</x-heading.main>
    </x-slot>

    <x-card.default>
        <form action="{{ route('agenda.update', $agenda) }}" method="POST" enctype="multipart/form-data">
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
                                      :value="old('name', $agenda->name)"
                                      required
                        />
                        <x-form.error for="name"/>
                    </div>
                    <div>
                        <x-form.label for="date" value="{{ __('Date & Time') }}"/>
                        <x-form.input id="date"
                                      name="date"
                                      type="datetime-local"
                                      class="block w-full"
                                      :value="old('date', $agenda->date)"
                                      required
                                      autofocus
                        />
                        <x-form.error for="name"/>
                    </div>
                    <div>
                        <x-form.label for="description" value="{{ __('Content') }}"/>
                        <textarea id="description" name="description"
                                  class="w-full text-primary-muted bg-transparent rounded-lg border-secondary/30 focus:border-secondary focus:ring-0"
                                  rows="10"
                                  placeholder="Event...">{{ $agenda->description }}</textarea>
                    </div>

                    <div>
                        <label class="relative inline-flex items-center mr-5 cursor-pointer">
                            <input name="private"
                                   id="private"
                                   value="1" {{ ($agenda->private == 1 ? ' checked' : '') }}
                                   aria-describedby="private"
                                   type="checkbox"
                                   class="sr-only peer"
                            >
                            <div class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-orange-300 dark:peer-focus:ring-orange-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500 dark:peer-checked:bg-orange-500"></div>
                            <span class="ml-3 text-sm font-medium text-primary">Private</span>
                        </label>
                    </div>
                </div>
                <aside class="w-full space-y-4 lg:w-1/4 flex-col pt-4 px-3 gap-4">
                    <div>
                        <x-heading.sub>Image</x-heading.sub>
                        <div class="relative group">
                            @if($agenda->image)
                                <img src="{{ asset($agenda->image) }}"
                                     alt="{{ $agenda->name }}"
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
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

        <script>
            //CKEDITOR
            ClassicEditor
                .create(document.querySelector('#description'), {
                    ckfinder: {
                        uploadUrl: '{{ route('agenda.upload', ['_token' => csrf_token()]) }}'
                    }
                })
                .catch(error => {
                    console.error(error);
                });

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